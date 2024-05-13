<div class="ticket-info">
  <h1>Ihr Ticket wurde erstellt</h1>
  <?php foreach ($singleTicket as $key => $value) { ?>
    <div class="ticket-data">
    <p><strong><?php echo $key; ?>:</strong> <?php echo $value; ?></p>
    </div>
  <?php } ?>
</div>