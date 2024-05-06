Je Ticket sollen mindestens Problembeschreibung, Zeitstempel, Priorität (1-3), Ersteller,
Bearbeiter, Zustand (neu, in Bearbeitung, fertig,…) und Support-Notizen gespeichert werden.


1. <?php
$db = new PDO('mysql:host=localhost;dbname=bfw_ticket_system;charset=utf8mb4', 'root');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// SQL-Befehle zum Erstellen der Tabellen
$tables = [
    "CREATE TABLE IF NOT EXISTS tickets (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        priority ENUM('1', '2', '3') NOT NULL,
        status ENUM('neu', 'in Bearbeitung', 'fertig') NOT NULL DEFAULT 'neu',
        created_by INT NOT NULL,
        FOREIGN KEY (created_by) REFERENCES users(id)
    )",
    "CREATE TABLE IF NOT EXISTS ticket_updates (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ticket_id INT NOT NULL,
        updated_by INT NOT NULL,
        update_note TEXT NOT NULL,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (ticket_id) REFERENCES tickets(id),
        FOREIGN KEY (updated_by) REFERENCES users(id)
    )"
];

foreach ($tables as $sql) {
    $db->exec($sql);
}


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
