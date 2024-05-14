<?php 
include "SessionHandler.php";
$sessionhandler = new SessionHandling();
$sessionhandler->destroySession();

$sessionhandler->setLoggedOutMessage("You are logged out");
header("Location: index_testing2.php");
exit;
  
