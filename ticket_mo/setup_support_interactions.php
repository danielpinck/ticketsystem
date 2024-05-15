Ein Ticket kann nacheinander von mehreren Supportern bearbeitet werden, sofern es noch
nicht abgeschlossen ist. Alle entsprechenden Supporter sollen pro Ticket gespeichert werden,
inklusiver der einzelnen Notizen, die jeder hinterlassen hat.


<?php
// Erweiterung für die Handhabung von mehreren Supportern pro Ticket

// Datenbankverbindung
$db = new PDO('mysql:host=localhost;dbname=bfw_ticket_system;charset=utf8mb4', 'root');

// SQL zum Erstellen einer neuen Tabelle für Ticket-Support-Interaktionen
$createInteractionTable = "
CREATE TABLE IF NOT EXISTS ticket_support_interactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    supporter_id INT NOT NULL,
    note TEXT,
    interaction_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE,
    FOREIGN KEY (supporter_id) REFERENCES users(id) ON DELETE SET NULL
)";

// Tabelle erstellen
$db->exec($createInteractionTable);

// Funktion zum Hinzufügen einer Interaktion
function addSupportInteraction($db, $ticketId, $supporterId, $note) {
    $stmt = $db->prepare("INSERT INTO ticket_support_interactions (ticket_id, supporter_id, note) VALUES (:ticket_id, :supporter_id, :note)");
    $stmt->bindParam(':ticket_id', $ticketId);
    $stmt->bindParam(':supporter_id', $supporterId);
    $stmt->bindParam(':note', $note);
    $stmt->execute();
}

// Beispiel: Mehrere Supporter fügen Notizen zu einem Ticket hinzu
addSupportInteraction($db, 1, 2, 'Erste Überprüfung des Problems.'); // Supporter ID 2
addSupportInteraction($db, 1, 3, 'Zweite Überprüfung und Anpassung.'); // Supporter ID 3

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ticket Support Interaktionen</title>
</head>
<body>
    <h1>Erweiterung für Support-Interaktionen</h1>
    <p>Die neue Tabelle ticket_support_interactions wurde erstellt und dient dazu, Interaktionen der Supporter mit den Tickets zu speichern.</p>
</body>
</html>
