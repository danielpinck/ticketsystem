<?php
$css_file = "ticket_support.css";
include "header.php";
// Database Connection class
include "DatabaseConnection.php";
include "ticket.php";
include "SessionHandler.php";


// Parameter for Database Connection

$servername = "localhost";
$username_sql = "root";
$password_sql = "";
$dbname = "ticket_db";

// DatabaseConnection object
$dbconnection = new DatabaseConnection($servername, $username_sql, $password_sql, $dbname);

// mysqli connection object
$conn = $dbconnection->getConnection();
$sessionhandler = new SessionHandling();


?>


<?php 
$ticket = new Ticket($conn);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["title"]) and !empty($_POST["title"]) and 
    isset($_POST["description"]) and !empty($_POST["description"]) and 
    (isset($_POST["category"]) and !empty($_POST["category"]) and 
    isset($_POST["priority"]) and !empty($_POST["priority"]) )) {


    
        $ticket->setTicketTitle($_POST["title"]);
        $ticket->setTicketDescription($_POST["description"]);
        $ticket->setTicketCategory($_POST["category"]);
        $ticket->setTicketPriority($_POST["priority"]);
        $tid = $ticket->createTicket();
    if ($tid) {
        // echo $tid; for testing the createTicket return
        
        $singleTicket = $ticket->getSingleTicket($tid);
        
        if ($singleTicket) {
            include 'ticket_template.php';
        } else {
            echo "Error retrieving the ticket.";
        }
        exit;
    }
    } 
    else {
        echo "Fill in all fields.";
    }
}
 
include_once "new_ticket_form.php";
// close db connection when finished
$dbconnection->closeConnection();
include "footer.php";
?>
