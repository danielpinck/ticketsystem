<?php
// Database Connection class
include "DatabaseConnection.php";
include "user.php";


// Parameter for Database Connection

$servername = "localhost";
$username_sql = "root";
$password_sql = "";
$dbname = "ticket_db";

// DatabaseConnection object
$dbconnection = new DatabaseConnection($servername, $username_sql, $password_sql, $dbname);

// mysqli connection object
$conn = $dbconnection->getConnection();

$user = new User($conn);

echo '<a href="?cat=login">Login</a><br>';
echo '<a href="?cat=register">Register</a><br>';

if (isset($_GET["cat"])) {
    $cat = $_GET["cat"];
  
    switch($cat) {
      case "register":
        include "register.php";
  
        $user = new User($conn);
  
        if (isset($_POST["username"]) and !empty($_POST["username"]) and 
            isset($_POST["password"]) and !empty($_POST["password"]) ) {
  
              $user->setUsername($_POST["username"]);
              $user->setPassword($_POST["password"]);
              $user->createUser();
        }
        break;
  
      case "login":
        include "login.php";
  
        $user = new User($conn);
  
        if (isset($_POST["username"]) and !empty($_POST["username"]) and 
            isset($_POST["password"]) and !empty($_POST["password"]) ) {
  
              $user->setUsername($_POST["username"]);
              $user->setPassword($_POST["password"]);
              $user->getUser();
  
        }
        break;
  
      default:
        echo "No such category<br>";
        break;
    }
  } else {
    echo "Main Page Placeholder<br>";
  }






?>
