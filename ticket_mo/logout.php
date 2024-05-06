5. logout.php
<?php
session_start();
session_destroy();  // Zerstört die Session
header("Location: index.php");  // Weiterleitung zum Login
exit();
