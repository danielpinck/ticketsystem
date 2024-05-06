2. index.php
<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Tickets des Benutzers abrufen
require 'get_user_tickets.php';

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
</head>
<body>
    <h1>Willkommen bei Ihrem Ticket-System</h1>
    <a href="create_ticket.php">Ticket erstellen</a>
    <a href="dashboard.php">Dashboard ansehen</a>
    <?php foreach ($tickets as $ticket): ?>
        <p><?= htmlspecialchars($ticket['title']) ?> - <?= htmlspecialchars($ticket['status']) ?></p>
    <?php endforeach; ?>
    <a href="logout.php">Ausloggen</a>
</body>
</html>
