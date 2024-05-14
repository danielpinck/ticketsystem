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


$ticket = new Ticket($conn);
$sessionhandler->getSessionValue("rolle");
$sessionhandler->getSessionValue("user_id");
// echo "Rolle: " . $_SESSION['rolle'];
// echo "User ID " . $_SESSION['user_id'];
$status = isset($_GET['status']) ? $_GET['status'] : null;
$category = isset($_GET['category']) ? $_GET['category'] : null;
$ticket_id = isset($_GET['tid']) ? $_GET['tid'] : null;
?>




<div class="ticket-info">
<div class="ticket-container">
<a href="?status=neu" class="ticket-status">Neu</a>
<a href="?category=E-Mail" class="ticket-status">E-Mail</a>
<a href="?category=Hardware" class="ticket-status">Hardware</a>
<a href="?category=Citrix" class="ticket-status">Citrix</a>
<a href="?" class="ticket-status">Alle</a>
</div>
  <?php foreach ($ticket->getAllTickets($status, $category, $ticket_id) as $row) { ?>
    <a href="ticket_testing.php?tid=<?php echo $row['Ticket ID']; ?>">
    <div class="ticket-container">
      <div class="ticket-header">
        <p class="ticket-id"><?php echo $row['Ticket ID']; ?></p>
        <p class="ticket-status"><?php echo $row['Status']; ?></p>
      </div>
      <div class="ticket-title">
        <p><?php echo $row['Titel']; ?></p>
      </div>
      <div class="ticket-description">
        <p><strong>Beschreibung:</strong> <?php echo $row['Beschreibung']; ?></p>
      </div>
      <div class="ticket-details">
        <div class="ticket-detail-left">
          <p><strong>Kategorie:</strong> <?php echo $row['Kategorie']; ?></p>
          <p><strong>Priorität:</strong> <?php echo $row['Priorität']; ?></p>
          <p><strong>Erstellt von:</strong> <?php echo $row['Erstellt von']; ?></p>
        </div>
        <div class="ticket-detail-right">
          <p><strong>Erstellt am:</strong> <?php echo $row['Erstellt am']; ?></p>
        </div>
      </div>
     
      <div class="support-notes">
        <p><strong>Support Notizen:</strong></p>
        <!-- Placeholder for existing support notes -->
      </div>
      
    </div>
  </a>
  <?php } ?>
</div>



<?php


// $sessionhandler->unsetSessionValue("username");
// $sessionhandler->destroySession();



// close db connection when finished
$dbconnection->closeConnection();
include "footer.php";
?>