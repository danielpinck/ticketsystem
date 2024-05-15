
<div class="ticket-info">
    <div class="ticket-container">
      <?php 
    if (isset($_SESSION['rolle'])) {
      $rolle = $_SESSION['rolle'];
      if ($rolle === 'user') {
        echo '<a href="dashboard.php?page=tickets" class="ticket-status">Zurück</a>';
      }

      } elseif ($rolle === 'support') {
        echo '<a href="ticket_support.php?get=tickets" class="ticket-status">Zurück</a>';
      }
        ?>

</div>
</div>
<div class="ticket-info">
  <div class="ticket-container">
    <div class="ticket-header">
      <p class="ticket-id"><?php echo $singleTicket['Ticket ID']; ?></p>
      <p class="ticket-status"><?php echo $singleTicket['Status']; ?></p>
    </div>
    <div class="ticket-title">
      <p><?php echo $singleTicket['Titel']; ?></p>
    </div>
    <div class="ticket-description">
      <p><strong>Beschreibung:</strong> <?php echo $singleTicket['Beschreibung']; ?></p>
    </div>
    <div class="ticket-details">
      <div class="ticket-detail-left">
        <p><strong>Kategorie:</strong> <?php echo $singleTicket['Kategorie']; ?></p>
        <p><strong>Priorität:</strong> <?php echo $singleTicket['Priorität']; ?></p>
        <p><strong>Erstellt von:</strong> <?php echo $singleTicket['Erstellt von']; ?></p>
      </div>
      <div class="ticket-detail-right">
        <p><strong>Erstellt am:</strong> <?php echo $singleTicket['Erstellt am']; ?></p>
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
    </div>
  </div>
</div>

