<?php
session_start();

// Autoload für Klassen
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
});

// Datenbankverbindung
$db = new PDO('mysql:host=localhost;dbname=bfw_ticket_system;charset=utf8mb4', 'root');

// Nutzer-Authentifizierung und Rollenmanagement
function checkUserRole($role) {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === $role;
}

// Routing und Controller
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticketController = new TicketController($db);

    switch ($_POST['action']) {
        case 'create_ticket':
            if (checkUserRole('user') || checkUserRole('admin')) {
                $ticketController->createTicket($_POST['title'], $_POST['description'], $_POST['priority']);
            }
            break;
        case 'edit_ticket':
            if (checkUserRole('support') || checkUserRole('admin')) {
                $ticketController->editTicket($_POST['ticket_id'], $_POST['status']);
            }
            break;
        case 'assign_role':
            if (checkUserRole('admin')) {
                $userController = new UserController($db);
                $userController->assignRole($_POST['user_id'], $_POST['role']);
            }
            break;
    }
}

// Ticket-Controller-Klasse
class TicketController {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createTicket($title, $description, $priority) {
        $stmt = $this->db->prepare("INSERT INTO tickets (title, description, priority, status) VALUES (:title, :description, :priority, 'offen')");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':priority', $priority);
        $stmt->execute();
    }

    public function editTicket($ticket_id, $status) {
        $stmt = $this->db->prepare("UPDATE tickets SET status = :status WHERE id = :ticket_id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':ticket_id', $ticket_id);
        $stmt->execute();
    }

    public function listTicketsByPriority() {
        if (checkUserRole('support') || checkUserRole('admin')) {
            return $this->db->query("SELECT * FROM tickets ORDER BY FIELD(priority, 'hoch', 'mittel', 'niedrig')");
        }
        return null;
    }
}

// Benutzer-Controller-Klasse
class UserController {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function assignRole($user_id, $role) {
        $stmt = $this->db->prepare("UPDATE users SET role = :role WHERE id = :user_id");
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }
}

?>

<!-- HTML-Frontend zum Erstellen und Verwalten von Tickets und Benutzerrollen -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ticket System - BFW</title>
</head>
<body>
    <h1>Ticket-Management</h1>
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

    <h2>Rollen zuweisen</h2>
    <form method="post">
        <input type="hidden" name="action" value="assign_role">
        <div>
            <label for="user_id">Benutzer ID:</label>
            <input type="text" id="user_id" name="user_id" required>
        </div>
        <div>
            <label for="role">Rolle:</label>
            <select id="role" name="role">
                <option value="user">Benutzer</option>
                <option value="support">Support</option>
                <option value="admin">Administrator</option>
            </select>
        </div>
        <button type="submit">Rolle zuweisen</button>
    </form>
</body>
</html>
