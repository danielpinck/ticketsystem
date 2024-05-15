<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php 
  if (isset($_GET['page']) && $_GET['page'] == 'create_ticket') {
    echo '<link rel="stylesheet" href="ticket.css">';
  } elseif (isset($_GET['page']) && $_GET['page'] == 'tickets') {
    echo '<link rel="stylesheet" href="ticket_support.css">';
  } elseif (isset($_GET['page']) && $_GET['page'] == 'login') {
    echo '<link rel="stylesheet" href="login.css">';
  }

  ?>
  
  <?php if (isset($css_file)) { ?>
    <link rel="stylesheet" href="<?php echo $css_file; ?>">
  <?php } ?>
</head>
<body>

  
  
  
