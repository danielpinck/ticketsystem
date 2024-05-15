<div class="container">
  <div class="column left-column">
  <?php 
    echo "<h1>".$_SESSION['username']."</h1>";
    if (isset($_SESSION['rolle'])) {
      $rolle = $_SESSION['rolle'];
      if ($rolle === 'user') {
        echo '<a href="?page=tickets">My Tickets</a><br>';
        

      } elseif ($rolle === 'support') {
        echo '<a href="#">My Tickets</a><br>';
        echo '<a href="#">Show Tickets</a><br>';
      } elseif ($rolle === 'admin') {
        echo '<a href="#">Show Tickets</a><br>';
        echo '<a href="#">Show Users</a><br>';
        
      }
      echo '<a href="destroy_session.php">Logout</a><br>';
      
  }
    // echo "<h1>".$_SESSION['username']."</h1>";
    
    // echo '<a href="#">My Tickets</a><br>';
    // echo '<a href="#">User Info</a><br>';
    // echo '<a href="destroy_session.php">Logout</a><br>';

    // if (isset($_SESSION['rolle'])) {
    //   $rolle = $_SESSION['rolle'];
    //   if ($rolle === 'user') {
    //     echo '<a href="#" class="new-ticket-link">New Ticket</a></div>';

    //   } elseif ($rolle === 'support') {

    //     echo '<a href="#" class="new-ticket-link">New Ticket</a></div>';
    //   } elseif ($rolle === 'support') {

    //     echo '<a href="#" class="new-ticket-link">New Ticket</a></div>';
      
    //   } elseif ($rolle === 'admin') {

    //     echo '<a href="#" class="new-ticket-link">New Ticket</a>';
    //   }
    // }
        ?>
  <form method="get" class="new-ticket-form">
    <button type="submit" name="page" value="create_ticket" class="new-ticket-button">New Ticket</button>
  </form>
  </div>
  <div class="column right-column">
  <?php
    if (isset($_GET['page']) && $_GET['page'] == 'create_ticket') {
      include 'create_ticket.php';
    } elseif (isset($_GET['page']) && $_GET['page'] == 'tickets') {
      include 'ticket_support.php';
    
    } elseif (isset($_GET['page']) && $_GET['page'] == 'ticket_edit') {
      include 'ticket_edit.php';
    }
    ?>

  </div>
</div>
<?php 
    
  //   echo "<h1>".$_SESSION['username']."</h1>";
  //   if (isset($_SESSION['rolle'])) {
  //     $rolle = $_SESSION['rolle'];
  //     if ($rolle === 'user') {
  //       echo '<a href="#">My Tickets</a><br>';
  //       echo '<a href="destroy_session.php">Logout</a><br>';
  //       echo '<a href="" class="new-ticket-link">New Ticket</a><br>';
  //     } elseif ($rolle === 'support') {
  //       echo '<a href="#">My Tickets</a><br>';
  //       echo '<a href="#">Show Tickets</a><br>';
  //     } elseif ($rolle === 'admin') {
  //       echo '<a href="#">Show Tickets</a><br>';
  //       echo '<a href="#">Show Users</a><br>';
        
  //     }
      
  // }
  ?>

