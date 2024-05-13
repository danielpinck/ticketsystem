<?php 
// sets the css file to be used
$css_file = "dashboard.css";

// include the header
include "header.php";
// Database Connection class
include "DatabaseConnection.php";
include "user.php";
include "SessionHandler.php";


// parameter for Database Connection

$servername = "localhost";
$username_sql = "root";
$password_sql = "";
$dbname = "ticket_db";

// DatabaseConnection object
$dbconnection = new DatabaseConnection($servername, $username_sql, $password_sql, $dbname);

// mysqli connection object
$conn = $dbconnection->getConnection();




// if session is empty show login, if session is set (user is logged in) show logout option
if (empty($_SESSION["username"]) || !isset($_SESSION["username"])) { 
    $sessionhandler = new SessionHandling();
    // If user is not logged in or session is not set
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Process form data
        $user = new User($conn);
        if (isset($_POST["username"]) && !empty($_POST["username"]) && 
            isset($_POST["password"]) && !empty($_POST["password"])) {
            $user->setUsername($_POST["username"]);
            $user->setPassword($_POST["password"]);
            $user->getUser();
            
            // Redirect after successful login
            header("Location: dashboard.php");
            exit; // Ensure to stop further execution after redirection
        }
    } else {
        // If not logged in and it's not a POST request, include the login form
        include_once "login.php";
    }
} else {
    // If session values are set, include the dashboard
    include_once "dashboard.php";
}



// close db connection when finished
$dbconnection->closeConnection();
include "footer.php";

// if (empty($_SESSION["username"]) or !isset($_SESSION["username"])) { 
//   echo '<a href="?cat=login">Login</a><br>';
//   echo '<a href="?cat=register">Register</a><br>';
//     if (isset($_GET["cat"])) {
//       $cat = $_GET["cat"];
    
//       switch($cat) {
//         case "register":
//           include "register.php";
    
//           $user = new User($conn);
    
//           if (isset($_POST["username"]) and !empty($_POST["username"]) and 
//               isset($_POST["password"]) and !empty($_POST["password"]) ) {
    
//                 $user->setUsername($_POST["username"]);
//                 $user->setPassword($_POST["password"]);
//                 $user->createUser();
//                 $sessionhandler->setSessionValue("username", $_POST["username"]);
//                 $sessionhandler->setSessionValue("password", $_POST["password"]);
//           }
//           break;
    
//         case "login":
//           include "login.php";
          
    
//           $user = new User($conn);
    
//           if (isset($_POST["username"]) and !empty($_POST["username"]) and 
//               isset($_POST["password"]) and !empty($_POST["password"]) ) {
    
//                 $user->setUsername($_POST["username"]);
//                 $user->setPassword($_POST["password"]);
//                 $user->getUser();
    
//           }
//           break;
    
//         default:
//           echo "Choose what to do<br>";
//           break;
//       }
//     } else {
//       echo "Main Page Placeholder<br>";
//       include "main_test.php";
//     }
//  } else {
//     echo '<a href="?cat=logout">Logout</a><br>';
//     if (isset($_GET['cat']) && $_GET['cat'] === 'logout') {
//         $sessionhandler->destroySession();
//         echo "You have been logged out";
//     }
        
  

  

//  }



