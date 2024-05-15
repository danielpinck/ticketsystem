Bearbeitete Tickets sollen in einer eigenen Tabelle gespeichert werden (Performance)


<?php
// Erweiterung der Datenbankstruktur um eine Tabelle für bearbeitete Tickets

// Datenbankverbindung
$db = new PDO('mysql:host=localhost;dbname=bfw_ticket_system;charset=utf8mb4', 'root');

// SQL zum Erstellen der Tabelle für bearbeitete Tickets
$createQuery = "
CREATE TABLE IF NOT EXISTS edited_tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    edited_by INT NOT NULL,
    edit_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE,
    FOREIGN KEY (edited_by) REFERENCES users(id) ON DELETE SET NULL
)";

// Tabelle erstellen
$db->exec($createQuery);

// Funktion zum Speichern eines bearbeiteten Tickets
function logTicketEdit($db, $ticketId, $userId) {
    $stmt = $db->prepare("INSERT INTO edited_tickets (ticket_id, edited_by) VALUES (:ticket_id, :edited_by)");
    $stmt->bindParam(':ticket_id', $ticketId);
    $stmt->bindParam(':edited_by', $userId);
    $stmt->execute();
}

// Beispiel: Bearbeitung eines Tickets loggen
logTicketEdit($db, 1, 2); // Annahme: Ticket mit ID 1 wurde von Benutzer mit ID 2 bearbeitet

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Erweitertes Datenbank Setup - Ticket System</title>
</head>
<body>
    <h1>Datenbankerweiterung für bearbeitete Tickets</h1>
    <p>Die Tabelle für bearbeitete Tickets wurde erfolgreich erstellt und ein Testeintrag hinzugefügt.</p>
</body>
</html>
