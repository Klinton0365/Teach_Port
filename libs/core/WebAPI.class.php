<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class WebAPI
{
  public function __construct()
  {
    Database::getConnection();
  }
  
  public function initiate_Session()
  {
    Session::start();
    if (Session::isset("session_token")) {
      try {
        $session = UserSession::authorize(Session::get('session_token'));
        if (!$session->isValid()) {
          Session::destroy();
          header("Location: login.php"); // Redirect to login page after session expiration
          exit();
        }
        Session::$usersession = $session;
    // if (Session::isset("session_token")) {
    //   try {
    //     Session::$usersession = UserSession::authorize(Session::get('session_token'));
      } catch (Exception $e) {
        error_log('Error authorizing user session: ' . $e->getMessage());
        // Handle the exception or rethrow it for further debugging
          throw $e->getMessage();

        // Redirect to the root directory
        header("Location: /"); // Adjust the location if needed
        //exit();
        throw $e;
      }
    }
  }
}
