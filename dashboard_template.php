<div class="container">
  <div class="column left-column">
    <?php 
    
    echo "<h1>".$_SESSION['username']."</h1>";
    echo '<a href="#">My Tickets</a><br>';
    echo '<a href="#">User Info</a><br>';
    echo '<a href="destroy_session.php">Logout</a><br>';
    ?>
    <button class="new-ticket-button">New Ticket</button>
  </div>
  <div class="column right-column">Right Column</div>
</div>
