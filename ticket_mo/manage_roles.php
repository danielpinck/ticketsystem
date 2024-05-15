- Administratoren sollen Rollen vergeben und wegnehmen können. Wenn Benutzer Supporter
sind, soll die erweiterte Funktionalität angezeigt werden.

<?php
session_start();

// Datenbankverbindung
$db = new PDO('mysql:host=localhost;dbname=bfw_ticket_system;charset=utf8mb4', 'root');

// Funktion zur Änderung der Benutzerrolle durch einen Administrator
function changeUserRole($db, $userId, $newRole) {
    $stmt = $db->prepare("UPDATE users SET role = :role WHERE id = :id");
    $stmt->bindParam(':role', $newRole);
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
}

// Funktion zur Überprüfung der Rolle des Benutzers
function checkUserRole($db, $userId) {
    $stmt = $db->prepare("SELECT role FROM users WHERE id = :id");
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['role'];
}

// Verarbeitung von Administratoranfragen zur Rollenänderung
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id']) && checkUserRole($db, $_SESSION['user_id']) === 'admin') {
    if (isset($_POST['change_role'])) {
        changeUserRole($db, $_POST['user_id'], $_POST['new_role']);
        echo "Die Rolle wurde erfolgreich geändert.";
    }
}

// Prüfen, ob der Benutzer ein Supporter ist
$isSupporter = false;
if (isset($_SESSION['user_id']) && checkUserRole($db, $_SESSION['user_id']) === 'support') {
    $isSupporter = true;
}

?>

<!-- HTML-Formular für Administratoren zur Rollenänderung -->
<?php if (isset($_SESSION['user_id']) && checkUserRole($db, $_SESSION['user_id']) === 'admin'): ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Rollenverwaltung</title>
</head>
<body>
    <h1>Rollenverwaltung durch Administrator</h1>
    <form method="post">
        <input type="hidden" name="change_role" value="1">
        <div>
            <label for="user_id">Benutzer-ID:</label>
            <input type="text" id="user_id" name="user_id" required>
        </div>
        <div>
            <label for="new_role">Neue Rolle:</label>
            <select id="new_role" name="new_role">
                <option value="user">Benutzer</option>
                <option value="support">Support</option>
                <option value="admin">Administrator</option>
            </select>
        </div>
        <button type="submit">Rolle ändern</button>
    </form>
</body>
</html>
<?php endif; ?>

<!-- Erweiterte Funktionalitäten für Supporter anzeigen -->
<?php if ($isSupporter): ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Supporter Dashboard</title>
</head>
<body>
    <h1>Willkommen im Supporter Dashboard</h1>
    <p>Hier können Sie erweiterte Funktionalitäten einsehen und verwalten.</p>
</body>
</html>
<?php endif; ?>
