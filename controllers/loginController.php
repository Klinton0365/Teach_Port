<?php
include_once '../libs/core/Database.class.php';
include_once '../libs/core/Session.class.php';
include_once '../libs/core/User.class.php';
include_once '../libs/core/UserSession.class.php';

$email = $_POST['email'];
$password = $_POST['password'];

if ($token = UserSession::authenticate($email, $password)) {
    Session::start();
    Session::set('session_token', $token);
    header("Location: ../views/home.php");
} else {
    header("Location: ../views/login.php?error=Invalid credentials");
}
exit();
?>
