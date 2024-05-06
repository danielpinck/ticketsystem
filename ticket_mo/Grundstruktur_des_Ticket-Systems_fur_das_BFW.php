<?php

// Autoload für Klassen
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
});

// Datenbankverbindung
$db = new PDO('mysql:host=localhost;dbname=bfw_ticket_system;charset=utf8mb4', 'root');

// Routing und Controller
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'create_ticket') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        $status = 'offen'; // Standardstatus für neue Tickets

        $ticketController = new TicketController($db);
        $ticketController->createTicket($title, $description, $priority, $status);
    }
}

// Ticket-Controller-Klasse
class TicketController {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createTicket($title, $description, $priority, $status) {
        $stmt = $this->db->prepare("INSERT INTO tickets (title, description, priority, status) VALUES (:title, :description, :priority, :status)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':priority', $priority);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
    }
}

?>

<!-- Einfaches HTML-Formular für die Erstellung eines neuen Tickets -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ticket System - BFW</title>
</head>
<body>
    <h1>Ticket erstellen</h1>
    <form method="post">
        <input type="hidden" name="action" value="create_ticket">
        <div>
            <label for="title">Titel:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="description">Beschreibung:</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div>
            <label for="priority">Priorität:</label>
            <select id="priority" name="priority">
                <option value="niedrig">Niedrig</option>
                <option value="mittel">Mittel</option>
                <option value="hoch">Hoch</option>
            </select>
        </div>
        <button type="submit">Ticket erstellen</button>
    </form>
</body>
</html>
