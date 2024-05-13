<?php 
include "SessionHandler.php";
$sessionhandler = new SessionHandling();
$sessionhandler->destroySession();

if (session_id()) {
  echo session_id();
} else {
  echo "You have been logged out";
  echo '<a href="index_testing.php">Back to main</a>';
}