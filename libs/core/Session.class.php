<?php  //These are the TOP Three SESSION Function 
class Session
{
    public static $isError = false;
    public static $user = null;
    public static $usersession = null;

    public static function start()
    {
        session_start();
    }
    public static function unset_all()
    {
        session_unset();
    }
    public static function destroy()
    {
        session_destroy();
    }
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value; //$_SESSION['Session_token'] = $value;  //$value == $token
    }
    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public static function isset($key)
    {
        //var_dump($_SESSION[$key]);
        return isset($_SESSION[$key]);
    }

    public static function get($key, $default = false)
    {
        if (Session::isset($key)) {
            return $_SESSION[$key];
        } else {
            return $default;
        }
    }

    public static function getUserSession()
    {
        //return Session::get('user_session'); //$_SESSION[user_session]
        return Session::$usersession;
    }

    public static function getUser()
    {
        return Session::$user;
    }


    public static function loadTemplate($name)
    {
        $script = "_template/$name.php";
        if (!is_file($script)) {
            include $script;
        } else {
            Session::loadTemplate('404');
        }
    }

    public static function renderPage()
    {
        Session::loadTemplate('_master'); // wrapper Method
    }

    public static function currentScript()
    {
        return basename($_SERVER['SCRIPT_NAME'], '.php');
    }

}