<?php 
// $css_file = "ticket_support.css";
// include "header.php";
// Database Connection class
include "DatabaseConnection.php";
include "ticket.php";
if (empty($_SESSION)) {
  include 'SessionHandler.php';
}


// Parameter for Database Connection

$servername = "localhost";
$username_sql = "root";
$password_sql = "";
$dbname = "ticket_db";

// DatabaseConnection object
$dbconnection = new DatabaseConnection($servername, $username_sql, $password_sql, $dbname);

// mysqli connection object
$conn = $dbconnection->getConnection();
if (empty($_SESSION)) {
  $sessionhandler = new SessionHandling();
}


$ticket = new Ticket($conn);
$rolle = $sessionhandler->getSessionValue("rolle");
$uid = $sessionhandler->getSessionValue("user_id");
// echo "Rolle: " . $_SESSION['rolle'];
// echo "User ID " . $_SESSION['user_id'];
$status = isset($_GET['status']) ? $_GET['status'] : null;
$category = isset($_GET['category']) ? $_GET['category'] : null;
$priority = isset($_GET['priority']) ? $_GET['priority'] : null;
$ticket_id = isset($_GET['tid']) ? $_GET['tid'] : null;
$uid = isset($_GET['uid']) ? $_GET['uid'] : null;

?>
<div class="right-column">
<div class="link-container">

<?php

// Get the current URL without any parameters
$currentUrl = strtok($_SERVER["REQUEST_URI"], '?');

// Construct the URL without the 'priority' parameter
$urlWithoutStatus = $currentUrl . '?' . http_build_query(array_diff_key($_GET, array('status' => '')));
$urlWithoutCategory = $currentUrl . '?' . http_build_query(array_diff_key($_GET, array('category' => '')));
$urlWithoutPriority = $currentUrl . '?' . http_build_query(array_diff_key($_GET, array('priority' => '')));

// Construct the link


$statusQueryParam = $status ? '&status=' . $status : '';
$categoryQueryParam = $category ? '&category=' . $category : '';
$priorityQueryParam = $priority ? '&priority=' . $priority : '';

$statusValues = $dbconnection->fetchEnumValues('tickets', 'status');
echo '<a href="' . $urlWithoutStatus . '" class="ticket-' . (!$status && $status != "status" ? 'active-stat' : 'status') . '">Alle</a> ';
foreach ($statusValues as $value) {
  echo '<a href="' . $urlWithoutStatus . '&status=' . $value . $categoryQueryParam . $priorityQueryParam . '" class="ticket-' . ($status && $status == $value ? 'active-stat' : 'status') . '">' . $value . '</a> ';
}

?>
<br>
<?php
echo '<a href="' . $urlWithoutCategory . '" class="ticket-' . (!$category && $category != 'category' ? 'active-cat' : 'category') . '">Alle</a> ';
$categoryValues = $dbconnection->fetchEnumValues('tickets', 'category');
foreach ($categoryValues as $value) {
  echo '<a href="' . $urlWithoutCategory . '&category=' . $value . $statusQueryParam . $priorityQueryParam . '" class="ticket-' . ($category && $category == $value ? 'active-cat' : 'category') . '">' . $value . '</a> ';
}
?>
<br>
<?php
echo '<a href="' . $urlWithoutPriority . '" class="ticket-' . (!$priority && $priority != 'priority' ? 'active-prio' : 'priority') . '">Alle</a> ';
$priorityValues = $dbconnection->fetchEnumValues('tickets', 'priority');
foreach ($priorityValues as $value) {
  echo '<a href="' . $urlWithoutPriority . '&priority=' . $value . $statusQueryParam . $categoryQueryParam . '" class="ticket-' . ($priority && $priority == $value ? 'active-prio' : 'priority') . '">' . $value . '</a> ';
}



?>

</div>
<br><br>
<div class="ticket-info">

<?php 

  if (!empty($ticket->getAllTickets($status, $category, $priority, $ticket_id, $uid))) {

    foreach ($ticket->getAllTickets($status, $category, $priority, $ticket_id, $uid) as $row) { ?>
    <a href="dashboard.php?page=ticket_edit&tid=<?php echo $row['Ticket ID']; ?>">
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
        
        <?php 
        $getNotiz = $ticket->getNotiz($row['Ticket ID']);

        if ($getNotiz) {
          echo '<p><strong>Support Notizen:</strong></p>';
          // var_dump($getNotiz);
          foreach ($getNotiz as $row) {
            echo "<div class='notiz-box'>" . $row['Notiz'] . $row['User ID'] . "</div><br>";
          }

        }
        ?>
      </div>
      
    </div>
  </a>
  <?php }
  } else {
    
    echo '<div class="ticket-container">No tickets found matching your criteria</div>';
  }
   ?>
</div>




<?php


// $sessionhandler->unsetSessionValue("username");
// $sessionhandler->destroySession();



// close db connection when finished
$dbconnection->closeConnection();
include "footer.php";
?>