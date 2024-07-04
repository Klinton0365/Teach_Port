<?php
class User
{
  private $conn;
  public $id;
  public $username;
  public $emailVerify;

  public function __call($name, $arguments)
  {
    //print($name);
    $property = preg_replace("/[^0-9a-zA-Z]/", "", substr($name, 3));
    $property = strtolower(preg_replace('/\B([A-Z])/', '_$1', $property));
    //echo $property; //ForChecking Purpose
    if (substr($name, 0, 3) == "get") {
      return $this->_get_data($property);
    } elseif (substr($name, 0, 3) == "set") {
      return $this->_set_data($property, $arguments[0]);
    } else {
      //This else part more heplfull for finding error When using __call function, because __call function just forward the msg Even if it's not available in the database.
      throw new Exception("User::__call -> $name,function unavailable.");
    }
    //print("User::__call -> $name");
  }

  //this function helps to retrieve data from the database
  private function _get_data($var)
  {
    if (!$this->conn) {
      $this->conn = Database::getConnection();
    }
    //$sql = "SELECT `$var` FROM `users` WHERE `id` = $this->id";
    $sql = "SELECT `$var` FROM `Auth` WHERE `id` = $this->id";
    $result = $this->conn->query($sql);
    if ($result and $result->num_rows == 1) {
      //print("Res: " . $result->fetch_assoc()["$var"]);
      return $result->fetch_assoc()["$var"];
    } else {
      return null;
    }
  }

  //this function helps to set the data from the database
  private function _set_data($var, $data)
  {
    if (!$this->conn) {
      $this->conn = Database::getConnection();
    }
    //$sql = "UPDATE `users` SET `$var`='$data' WHERE `id` = $this->id;";
    $sql = "SELECT `$var` FROM `Auth` WHERE `id` = $this->id";
    if ($this->conn->query($sql)) {
      return true;
    } else {
      return false;
    }
  }

  //private static $salt = "dsfhsefjpjdsfosd";
  public static function signup($user, $college, $email, $pass)
  {
    //Session::set('email', $email);
    $_SESSION['email'] = $email;
    //$pass = md5(strrev(md5($pass)) . User::$salt); // Security through obscurity
    $option = [
      'cost' => 8,
    ];
    $pass = password_hash($pass, PASSWORD_BCRYPT, $option);
    $conn = Database::getConnection();
    $sql = "INSERT INTO `user` (`name`, `college`, `email`, `password`)
    VALUES ('$user', '$college', '$email', '$pass');";
    // $error = false;
    $result = $conn->query($sql);
    if ($result) {
      $error = false;
    } else {
      // echo "Error:" . $sql . "<br>" . $conn->error;
      $error =  $conn->error;
    }
    //$conn->close();
    return $error;
  }

  public static function login($email, $pass)
  {
    $conn = Database::getConnection();

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE `email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      if (password_verify($pass, $row['password'])) {
        return $row['email']; // Return email if the password matches
      } else {
        // Incorrect password
        return false;
      }
    } else {
      // User not found
      return false;
    }

    // Close the statement
    $stmt->close();
  }

  //user object can be constructed with both UserID and Username.
  public function __construct($emailVerify)
  {
    $this->conn = Database::getConnection();
    $this->emailVerify = $emailVerify;
    $this->id = null;
    $sql = "SELECT `id` FROM `user` WHERE `email`='$emailVerify' OR `id`='$emailVerify' LIMIT 1"; //OR `id`='$username'
    $result = $this->conn->query($sql);
    if ($result->num_rows) {
      $row = $result->fetch_assoc();
      $this->id = $row['id']; //updating from the database
    } else {
      throw new Exception("Username doesn't exist");
    }
    //print($this->id);
  }


  public function getUsername()
  {
    return $this->username;
  }
}
