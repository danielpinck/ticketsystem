Tickets und Benutzer sollen in einer Datenbank gespeichert werden.

<?php
// Datenbankstruktur-Erstellung für Tickets und Benutzer

// Verbindung herstellen
$db = new PDO('mysql:host=localhost;dbname=bfw_ticket_system;charset=utf8mb4', 'root');

// SQL für das Erstellen der Tabellen
$queries = [
    "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('user', 'support', 'admin') NOT NULL DEFAULT 'user'
    )",
    "CREATE TABLE IF NOT EXISTS tickets (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        priority ENUM('niedrig', 'mittel', 'hoch') NOT NULL,
        status ENUM('offen', 'in Bearbeitung', 'geschlossen') NOT NULL DEFAULT 'offen',
        user_id INT,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
    )"
];

// Ausführen der SQL-Anweisungen
foreach ($queries as $query) {
    $db->exec($query);
}

// Beispiel Benutzer und Tickets hinzufügen
$addUsers = $db->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
$addUsers->execute([
    ':username' => 'admin',
    ':password' => password_hash('adminpass', PASSWORD_DEFAULT), // Passwort sollte gehasht gespeichert werden
    ':role' => 'admin'
]);

$addUsers->execute([
    ':username' => 'support',
    ':password' => password_hash('supportpass', PASSWORD_DEFAULT),
    ':role' => 'support'
]);

$addTicket = $db->prepare("INSERT INTO tickets (title, description, priority, user_id) VALUES (:title, :description, :priority, :user_id)");
$addTicket->execute([
    ':title' => 'Beispiel Ticket',
    ':description' => 'Beispiel Beschreibung für ein Ticket',
    ':priority' => 'mittel',
    ':user_id' => 1 // Referenziert den Admin-Benutzer
]);

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Setup Database - Ticket System</title>
</head>
<body>
    <h1>Datenbank Setup abgeschlossen</h1>
    <p>Benutzer und Tickets Tabellen wurden erfolgreich erstellt und initial befüllt.</p>
</body>
</html>

