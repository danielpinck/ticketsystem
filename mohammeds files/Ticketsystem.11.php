- Benutzer können beim Anlegen der Tickets schon aus Kategorien wählen, wo das Problem
einzuordnen ist.


<?php
session_start();

// Datenbankverbindung
$db = new PDO('mysql:host=localhost;dbname=bfw_ticket_system;charset=utf8mb4', 'root');

// Funktion zum Erstellen eines Tickets mit einer Kategorie
function createTicketWithCategory($db, $title, $description, $priority, $userId, $category) {
    $stmt = $db->prepare("INSERT INTO tickets (title, description, priority, created_by, category) VALUES (:title, :description, :priority, :created_by, :category)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':priority', $priority);
    $stmt->bindParam(':created_by', $userId);
    $stmt->bindParam(':category', $category);
    $stmt->execute();
    return $db->lastInsertId(); // Gibt die ID des erstellten Tickets zurück
}

// Verarbeitung von Benutzeranfragen zum Erstellen eines Tickets
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    if (isset($_POST['action']) && $_POST['action'] === 'create_ticket_with_category') {
        $ticketId = createTicketWithCategory($db, $_POST['title'], $_POST['description'], $_POST['priority'], $_SESSION['user_id'], $_POST['category']);
        echo "Ticket erfolgreich erstellt. Ticket-ID: $ticketId";
    }
}

// Funktion zum Abrufen von Kategorien
function getCategories($db) {
    $stmt = $db->prepare("SELECT * FROM categories");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Abrufen aller verfügbaren Kategorien für das Formular
$categories = getCategories($db);

?>

<!-- HTML-Formular für die Erstellung eines Tickets mit Kategorien -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ticket Erstellung mit Kategorien</title>
</head>
<body>
    <h1>Erstelle ein neues Ticket mit Kategorien</h1>
    <form method="post">
        <input type="hidden" name="action" value="create_ticket_with_category">
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
        <div>
            <label for="category">Kategorie:</label>
            <select id="category" name="category">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit">Ticket erstellen</button>
    </form>
</body>
</html>
