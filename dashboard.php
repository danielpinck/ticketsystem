<?php 
// sets the css file to be used
$css_file = "dashboard.css";

// Start the session
include "SessionHandler.php";
$sessionhandler = new SessionHandling();


// Check if the user is logged in
if (empty($_SESSION["username"]) || !isset($_SESSION["username"])) { 
    // If not logged in, redirect to the login page
    header("Location: index_testing2.php");
    exit; // Ensure to stop further execution after redirection
}

// Include the header
include "header.php";

// Display the user's dashboard content here
include "dashboard_template.php";

// Include the footer
include "footer.php";
?>
