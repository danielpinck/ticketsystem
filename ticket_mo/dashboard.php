4. dashboard.php
<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");  // Nur Admins haben Zugang zum Dashboard
    exit();
}

echo "<h1>Admin-Dashboard</h1>";
echo "<a href='logout.php'>Ausloggen</a>";

// Hier könnte die Logik zur Verwaltung von Benutzern und Tickets implementiert werden
