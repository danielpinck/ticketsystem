1. db.php

<?php
$db = new PDO('mysql:host=localhost;dbname=bfw_ticket_system;charset=utf8mb4', 'root');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Fehlermodus aktivieren

// SQL-Befehle zum Anlegen der Tabellen einfügen
