<?php 
include "DatabaseConnection.php";



// Parameter for Database Connection

$servername = "localhost";
$username_sql = "root";
$password_sql = "";
$dbname = "ticket_db";

// DatabaseConnection object
$dbconnection = new DatabaseConnection($servername, $username_sql, $password_sql, $dbname);
$enumValues = $dbconnection->fetchEnumValues('tickets', 'category');
foreach ($enumValues as $value) {
    echo $value . "<br>";
}
$enumValues = $dbconnection->fetchEnumValues('tickets', 'status');
foreach ($enumValues as $value) {
    echo $value . "<br>";
}
?>