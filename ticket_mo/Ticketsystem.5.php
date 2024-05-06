- Wenn Tickets mindestens eine Woche lang nicht gelöst wurden, sollen sie in eine höhere
Prioritätskategorie rutschen.



<?php
// Automatische Prioritätserhöhung für Tickets, die seit mindestens einer Woche nicht gelöst wurden

// Datenbankverbindung
$db = new PDO('mysql:host=localhost;dbname=bfw_ticket_system;charset=utf8mb4', 'root');

// SQL zum Aktualisieren der Priorität für alte Tickets
$updatePriorityQuery = "
UPDATE tickets
SET priority = CASE
    WHEN priority = '1' THEN '2'
    WHEN priority = '2' THEN '3'
    ELSE '3'
END
WHERE DATEDIFF(NOW(), created_at) >= 7 AND status != 'fertig'
";

// Priorität aktualisieren
$db->exec($updatePriorityQuery);

// Planen dieses Skripts zur täglichen Ausführung durch einen Cron-Job oder ähnliche Planungsmechanismen
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Automatische Prioritätserhöhung</title>
</head>
<body>
    <h1>Automatische Prioritätserhöhung für alte Tickets</h1>
    <p>Die Priorität von Tickets, die seit mindestens einer Woche nicht gelöst wurden, wurde automatisch erhöht.</p>
</body>
</html>
