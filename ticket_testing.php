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

$ticket_id = $_GET['tid'];
$ticket = new Ticket($conn);
$singleTicket = $ticket->getSingleTicket($ticket_id);
$sessionhandler->getSessionValue("rolle");
$sessionhandler->getSessionValue("user_id");
// echo "Rolle: " . $_SESSION['rolle'];
// echo "User ID " . $_SESSION['user_id'];

?>
<div class="ticket-info">
    <div class="ticket-container">
<a href="ticket_support.php" class="ticket-status">Zurück</a>
</div>
</div>
<div class="ticket-info">
    <div class="ticket-container">

    
      <div class="ticket-header">
        <p class="ticket-id"><?php echo $singleTicket['Ticket ID']; ?></p>
        <p class="ticket-status"><?php echo $singleTicket['Status']; ?></p>
      </div>
      <div class="ticket-title">
        <p><<?php echo $singleTicket['Titel']; ?></p>
      </div>
      <div class="ticket-description">
        <p><strong>Beschreibung:</strong><?php echo $singleTicket['Beschreibung']; ?></p>
      </div>
      <div class="ticket-details">
        <div class="ticket-detail-left">
          <p><strong>Kategorie:</strong><?php echo $singleTicket['Kategorie']; ?></p>
          <p><strong>Priorität:</strong><?php echo $singleTicket['Priorität']; ?></p>
          <p><strong>Erstellt von:</strong><?php echo $singleTicket['Erstellt von']; ?></p>
        </div>
        <div class="ticket-detail-right">
          <p><strong>Erstellt am:</strong><?php echo $singleTicket['Erstellt am']; ?></p>
        </div>
      </div>
     
      <div class="support-notes">
        <p><strong>Support Notizen:</strong></p>
        <!-- Placeholder for existing support notes -->
      </div>
      
      <div class="new-support-note">
      <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <textarea placeholder="Neue Support-Notiz" style="width: 70%;"></textarea>
      </div>
      <div class="change-status">
      <select id="status" name="status">
        <option value="" disabled selected>Change the Status</option>
            <option value="niedrig">neu</option>
            <option value="mittel">In Bearbeitung</option>
            <option value="hoch">Fertig</option>
        </select>
      </div>
      <button type="submit">Speichern</button>
</form>
    </div>
</div>



<?php


// $sessionhandler->unsetSessionValue("username");
// $sessionhandler->destroySession();



// close db connection when finished
$dbconnection->closeConnection();
include "footer.php";
?>