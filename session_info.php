<?php 
include "SessionHandler.php";
$sessionhandler = new SessionHandling();


echo "<h1>Welcome, ".$sessionhandler->getSessionValue('username')."!</h1>";
echo "<h1>Welcome, ".$sessionhandler->getLoggedOutMessage('logged_out_message')."!</h1>";
