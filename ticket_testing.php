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
$uid = $singleTicket['User ID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $notiz = $_POST['notiz'];
  $status = $_POST['status'];


  // if (isset($_POST["notiz"]) and !empty($_POST["notiz"]) and 
  // isset($_POST["status"]) and !empty($_POST["status"])) {

      $createNotiz = $ticket->createNotiz($ticket_id, $uid, $notiz);
      $ticket->changeStatus($ticket_id, $status);
      
      
  if ($createNotiz) {

      
      $singleTicket = $ticket->getSingleTicket($ticket_id);
      
      
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
// }

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
        
        <?php 
        $getNotiz = $ticket->getNotiz($singleTicket['Ticket ID']);

        if ($getNotiz) {
          // var_dump($getNotiz);
          foreach ($getNotiz as $row) {
            echo "<div class='notiz-box'>" . $row['Notiz'] . $row['User ID'] . "</div><br>";
          }

        }
        ?>
        
        <!-- Placeholder for existing support notes -->
      </div>
      
      <div class="new-support-note">
      <form action="ticket_testing.php?tid=<?php echo $ticket_id?>" method="post">
        <textarea id="notiz" name="notiz"  placeholder="Neue Support-Notiz" style="width: 70%;"></textarea>
      </div>
      <div class="change-status">
      <select id="status" name="status">
        <option value="" disabled>Change the Status</option>
            <option value="Neu"<?php if ($singleTicket['Status'] == "Neu") echo " selected"?>>neu</option>
            <option value="In Bearbeitung"<?php if ($singleTicket['Status'] == "In Bearbeitung") echo " selected"?>>In Bearbeitung</option>
            <option value="Fertig"<?php if ($singleTicket['Status'] == "Fertig") echo " selected"?>>Fertig</option>
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