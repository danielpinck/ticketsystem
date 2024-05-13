<?php 
// sets the css file to be used
$css_file = "dashboard.css";

// Start the session
include "SessionHandler.php";
$sessionhandler = new SessionHandling();


// Check if the user is logged in
if (empty($_SESSION["username"]) || !isset($_SESSION["username"])) { 
    // If not logged in, redirect to the login page
    header("Location: index_testing.php");
    exit; // Ensure to stop further execution after redirection
}

// Include the header
include "header.php";

// Display the user's dashboard content here
echo "<h1>Welcome, ".$_SESSION['username']."!</h1>";
echo "<p>This is your dashboard.</p>";


echo '<a href="destroy_session.php">Logout</a><br>';
echo '<a href="index_testing.php">Login</a><br>';

// Include the footer
include "footer.php";
?>
