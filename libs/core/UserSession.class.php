<?php
class UserSession
{
    public $data;
    public $id;
    public $conn;
    public $token;
    public $uid;

    public function __construct($token)
    {
        $this->conn = Database::getConnection();
        $this->token = $token;
        $this->data = null;
        $sql = "SELECT * FROM `session` WHERE `token` = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $this->data = $row;
            $this->uid = $row['uid'];
        } else {
            throw new Exception("session invalid");
        }
    }

    public static function authenticate($email, $pass)
    {
        $fingerprint = null;
        $emailVerify = User::login($email, $pass);
        date_default_timezone_set('Asia/Kolkata');
        $currentDateTime = date('Y-m-d H:i:s');

        // if ($email === 'klinton.developer365@gmail.com') {
        //     Session::set('admin_email', $email);
        // } else {
        Session::set('user_email', $email);
        // }

        //if (isset($_SESSION['user_email']) || isset($_SESSION['admin_email'])) {
        $userEmail = $email; // Use the email directly instead of checking session variables
        //}

        if ($fingerprint == null) {
            $fingerprint = $_COOKIE['fingerprint'] ?? null;
        }

        if ($emailVerify && $fingerprint) {
            $user = new User($emailVerify);
            $conn = Database::getConnection();
            $ip = $_SERVER['REMOTE_ADDR'];
            $agent = $_SERVER['HTTP_USER_AGENT'];
            $token = md5(rand(0, 9999999) . $ip . $agent . time());

            $sql1 = "INSERT INTO `session` (`uid`, `user_email`, `token`, `login_time`, `ip`, `user_agent`, `active`, `fingerprint`) 
                    VALUES (?, ?, ?, ?, ?, ?, 1, ?)";

            $sql2 = "INSERT INTO `login_history` (`uid`, `user_email`, `token`, `login_time`, `ip`, `user_agent`, `active`, `fingerprint`) 
                    VALUES (?, ?, ?, ?, ?, ?, 1, ?)";

            $stmt1 = $conn->prepare($sql1);
            $stmt1->bind_param('issssss', $user->id, $userEmail, $token, $currentDateTime, $ip, $agent, $fingerprint);
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param('issssss', $user->id, $userEmail, $token, $currentDateTime, $ip, $agent, $fingerprint);

            if ($stmt1->execute() && $stmt2->execute()) {
                Session::set('session_token', $token);
                Session::set('session_email', $emailVerify);
                return $token;
            } else {
                error_log("Failed to insert session or login history: " . $stmt1->error . " / " . $stmt2->error);
                return false;
            }
        } else {
            return false;
        }
    }

    public static function authorize($token)
    {
        try {
            $session = new UserSession($token);

            if (
                $_SERVER['REMOTE_ADDR'] == $session->getIP() &&
                $_SERVER['HTTP_USER_AGENT'] == $session->getUserAgent() &&
                $session->getFingerPrint() == $_COOKIE['fingerprint']
            ) {
                if ($session->isValid() && $session->isActive()) {
                    Session::$user = $session->getUser();
                    return $session;
                } else {
                    throw new Exception("Session invalid or inactive");
                }
            } else {
                throw new Exception("IP, User Agent or Fingerprint doesn't match");
            }
        } catch (Exception $e) {
            error_log('Authorization error: ' . $e->getMessage());
            Session::destroy();
            header('Location: login.php');
            exit();
        }
    }

    public function isValid()
    {
        if (isset($this->data['login_time'])) {
            $login_time = DateTime::createFromFormat('Y-m-d H:i:s', $this->data['login_time']);
            $current_time = new DateTime();
            $time_diff = $current_time->getTimestamp() - $login_time->getTimestamp();
            return $time_diff <= 60; // Session valid for 1 hour
        } else {
            throw new Exception("Login time is null");
        }
    }

    public function isActive()
    {
        return isset($this->data['active']) && $this->data['active'] == 1;
    }

    public function getUser()
    {
        return new User($this->uid);
    }

    public function getIP()
    {
        return $this->data["ip"] ?? false;
    }

    public function getUserAgent()
    {
        return $this->data["user_agent"] ?? false;
    }

    public function getFingerPrint()
    {
        return $this->data["fingerprint"] ?? false;
    }

    // public function removeSession()
    // {
    //     // Get user email from session
    //     $userEmail = Session::get('user_email');

    //     if ($userEmail) {
    //         $stmt = $this->conn->prepare("DELETE FROM `session` WHERE `user_email` = ?");
    //         $stmt->bind_param('s', $userEmail);
    //         return $stmt->execute();
    //     }
    //     return false;
    // }

    public function removeSession()
    {
        if (isset($this->data['id'])) {
            $stmt = $this->conn->prepare("DELETE FROM `session` WHERE `id` = ?");
            $stmt->bind_param('i', $this->data['id']);
            return $stmt->execute();
        }
        return false;
    }
}
