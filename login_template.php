

    <div class="signin-box">
    <h1>Helpdesk BFW</h1>
    <p>
      <?php 
      $logoutMessage = $sessionhandler->getLoggedOutMessage();

      // Check if the custom logout message exists and display it
      if (empty($_SESSION["logged_out_message"]) || !isset($_SESSION["logged_out_message"])) { 
          echo $logoutMessage;
      }
      ?></p>
    <h2>Sign In</h2>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Sign In">
    </form>
    
    <p class="forgot-password">Forgot your password? <a href="#">Reset here</a></p>
  </div>

