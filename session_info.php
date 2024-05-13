<?php 
include "SessionHandler.php";
$sessionhandler = new SessionHandling();


if (session_id()) {
  echo "<h1>Welcome, ".$_SESSION['username']."!</h1>";
} else {
  echo "You have been logged out";
  echo '<a href="index_testing.php">Back to main</a>';
}