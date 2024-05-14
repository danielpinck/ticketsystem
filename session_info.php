<?php 
include "SessionHandler.php";
$sessionhandler = new SessionHandling();


echo "<h1>Welcome, ".$sessionhandler->getSessionValue('username')."!</h1>";
if ($sessionhandler->getSessionValue('rolle') == 'user') {
  echo "User Links";
}
elseif ($sessionhandler->getSessionValue("rolle") == "support") {
  echo "Support Links";
}
elseif ($sessionhandler->getSessionValue("rolle") == "admin") {
  echo "Admin Links";
}

echo "<h1>Welcome, ".$sessionhandler->getLoggedOutMessage()."!</h1>";
