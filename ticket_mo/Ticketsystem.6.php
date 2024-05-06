- Benutzer sollen Tickets aufgeben können und den Status der eigenen Tickets einsehen
können. Fremde Tickets sollen für sie verborgen sein.


<?php
session_start();

// Datenbankverbindung
$db = new PDO('mysql:host=localhost;dbname=bfw_ticket_system;charset=utf8mb4', 'root');

// Funktion zum Erstellen eines Tickets durch einen Benutzer
function createTicket($db, $title, $description, $priority, $userId) {
    $stmt = $db->prepare("INSERT INTO tickets (title, description, priority, created_by) VALUES (:title, :description, :priority, :created_by)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':priority', $priority);
    $stmt->bindParam(':created_by', $userId);
    $stmt->execute();
    return $db->lastInsertId(); // Gibt die ID des erstellten Tickets zurück
}

// Funktion zum Anzeigen von Tickets eines spezifischen Benutzers
function getUserTickets($db, $userId) {
    $stmt = $db->prepare("SELECT * FROM tickets WHERE created_by = :created_by ORDER BY created_at DESC");
    $stmt->bindParam(':created_by', $userId);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Gibt alle Tickets des Benutzers zurück
}

// Verarbeitung von Benutzeranfragen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    switch ($_POST['action']) {
        case 'create_ticket':
            $ticketId = createTicket($db, $_POST['title'], $_POST['description'], $_POST['priority'], $_SESSION['user_id']);
            echo "Ticket erfolgreich erstellt. Ticket-ID: $ticketId";
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION['user_id'])) {
    if (isset($_GET['view']) && $_GET['view'] === 'my_tickets') {
        $tickets = getUserTickets($db, $_SESSION['user_id']);
        // Ausgabe der eigenen Tickets (beispielhaft)
        foreach ($tickets as $ticket) {
            echo "Ticket ID: {$ticket['id']}, Titel: {$ticket['title']}, Status: {$ticket['status']}<br>";
        }
    }
}

?>

<!-- HTML-Formular für die Erstellung eines Tickets -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ticket Erstellung und Ansicht</title>
</head>
<body>
    <h1>Erstelle ein neues Ticket</h1>
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
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>
        <button type="submit">Ticket erstellen</button>
    </form>

    <h2>Meine Tickets anzeigen</h2>
    <form method="get">
        <input type="hidden" name="view" value="my_tickets">
        <button type="submit">Meine Tickets ansehen</button>
    </form>
</body>
</html>
