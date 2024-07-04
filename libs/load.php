<?php
include 'core/Session.class.php';
include 'core/User.class.php';
include 'core/Database.class.php';
include 'core/UserSession.class.php';
include 'core/WebAPI.class.php';

$wapi = new WebAPI();
$wapi->initiate_Session();
?>