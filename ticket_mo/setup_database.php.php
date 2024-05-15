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

