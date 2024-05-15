Alle Benutzer sollen sich mit eigenem Passwort einloggen können


<?php
session_start();

// Datenbankverbindung
$db = new PDO('mysql:host=localhost;dbname=bfw_ticket_system;charset=utf8mb4', 'root');

// Funktion zum Überprüfen der Anmeldedaten und Einloggen eines Benutzers
function loginUser($db, $username, $password) {
    $stmt = $db->prepare("SELECT id, password FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Überprüfen, ob das Passwort korrekt ist
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id']; // Setzt die Benutzer-ID in der Session
        return true;
    }
    return false;
}

// Verarbeitung der Login-Anfrage
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (loginUser($db, $username, $password)) {
        echo "Login erfolgreich!";
    } else {
        echo "Falscher Benutzername oder Passwort.";
    }
}

?>

<!-- HTML-Formular für Benutzerlogin -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post">
        <input type="hidden" name="login" value="1">
        <div>
            <label for="username">Benutzername:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Passwort:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Einloggen</button>
    </form>
</body>
</html>
