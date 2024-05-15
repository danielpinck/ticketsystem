<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];

    // Ticket in die Datenbank einfügen
    $stmt = $db->prepare("INSERT INTO tickets (title, description, priority, created_by) VALUES (:title, :description, :priority, :created_by)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':priority', $priority);
    $stmt->bindParam(':created_by', $_SESSION['user_id']);
    $stmt->execute();

    echo "Ticket erfolgreich erstellt.";
} else {
    echo "Nur eingeloggte Benutzer können Tickets erstellen.";
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ticket Erstellen</title>
</head>
<body>
    <h1>Neues Ticket erstellen</h1>
    <form method="post" action="create_ticket.php">
        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" required>
        <label for="description">Beschreibung:</label>
        <textarea id="description" name="description" required></textarea>
        <label for="priority">Priorität:</label>
        <select id="priority" name="priority">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
        <button type="submit">Ticket erstellen</button>
    </form>
</body>
</html>