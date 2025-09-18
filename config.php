<?php
$host = "localhost"; 
$user = "root";      
$pass = "Mysql";         
$db   = "universe_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}
?>
