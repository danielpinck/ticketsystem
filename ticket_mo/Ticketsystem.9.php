 Admins sollen das Passwort zurücksetzen können, ohne es einsehen zu können.

<?php
session_start();

// Datenbankverbindung
$db = new PDO('mysql:host=localhost;dbname=bfw_ticket_system;charset=utf8mb4', 'root');

// Funktion zum Zurücksetzen des Passworts durch einen Administrator
function resetPassword($db, $userId, $newPassword) {
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Neues Passwort hashen
    $stmt = $db->prepare("UPDATE users SET password = :password WHERE id = :id");
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
}

// Überprüfung der Rolle des Benutzers (nur Admins dürfen Passwörter zurücksetzen)
function isAdmin($db, $userId) {
    $stmt = $db->prepare("SELECT role FROM users WHERE id = :id");
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    $role = $stmt->fetch(PDO::FETCH_ASSOC)['role'];
    return $role === 'admin';
}

// Verarbeitung der Passwort-Reset-Anfrage
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_password'])) {
    $userId = $_POST['user_id'];
    $newPassword = $_POST['new_password'];
    
    if (isset($_SESSION['user_id']) && isAdmin($db, $_SESSION['user_id'])) {
        resetPassword($db, $userId, $newPassword);
        echo "Das Passwort wurde erfolgreich zurückgesetzt.";
    } else {
        echo "Sie haben keine Berechtigung, Passwörter zurückzusetzen.";
    }
}

?>

<!-- HTML-Formular für Administratoren zum Zurücksetzen von Passwörtern -->
<?php if (isset($_SESSION['user_id']) && isAdmin($db, $_SESSION['user_id'])): ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Passwort zurücksetzen</title>
</head>
<body>
    <h1>Passwort zurücksetzen</h1>
    <form method="post">
        <input type="hidden" name="reset_password" value="1">
        <div>
            <label for="user_id">Benutzer-ID:</label>
            <input type="text" id="user_id" name="user_id" required>
        </div>
        <div>
            <label for="new_password">Neues Passwort:</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <button type="submit">Passwort zurücksetzen</button>
    </form>
</body>
</html>
<?php endif; ?>
