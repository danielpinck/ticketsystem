<?php 
include "header.php";
// Database Connection class
include "DatabaseConnection.php";
include "ticketclass.php";
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


$ticket = new Ticket($conn);

foreach($ticket->getTicketInfo() as $row) {
  foreach($row as $key => $value) {
    echo "$key: $value <br>";
}
echo "<hr>";
}




// $sessionhandler->unsetSessionValue("username");
// $sessionhandler->destroySession();



// close db connection when finished
$dbconnection->closeConnection();
include "footer.php";
?>