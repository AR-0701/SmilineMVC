<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "chatbot"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
