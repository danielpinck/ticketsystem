- Volltextsuche in allen Tickets nach einzelnen Wörtern (nur jeweils in allen für die Benutzer
sichtbaren Tickets).

<?php
session_start();

// Datenbankverbindung
$db = new PDO('mysql:host=localhost;dbname=bfw_ticket_system;charset=utf8mb4', 'root');

// Funktion zur Durchführung einer Volltextsuche in Tickets, die für den Benutzer sichtbar sind
function searchTickets($db, $userId, $searchTerm) {
    $stmt = $db->prepare("
        SELECT * FROM tickets 
        WHERE MATCH(title, description) AGAINST (:searchTerm IN NATURAL LANGUAGE MODE) 
        AND (created_by = :userId OR id IN (SELECT ticket_id FROM ticket_support_interactions WHERE supporter_id = :userId))
    ");
    $stmt->bindParam(':searchTerm', $searchTerm);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Verarbeitung der Suchanfrage
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION['user_id']) && isset($_GET['search'])) {
    $tickets = searchTickets($db, $_SESSION['user_id'], $_GET['search_term']);
    // Ausgabe der Suchergebnisse (beispielhaft)
    foreach ($tickets as $ticket) {
        echo "Ticket ID: {$ticket['id']}, Titel: {$ticket['title']}, Beschreibung: {$ticket['description']}<br>";
    }
}

?>

<!-- HTML-Formular für die Ticketsuche -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ticket-Suche</title>
</head>
<body>
    <h1>Ticketsuche</h1>
    <form method="get">
        <input type="hidden" name="search" value="1">
        <div>
            <label for="search_term">Suchbegriff:</label>
            <input type="text" id="search_term" name="search_term" required>
        </div>
        <button type="submit">Suchen</button>
    </form>
</body>
</html>
