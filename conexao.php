<?php
$conn = new mysqli("localhost", "root", "", "academia");

if ($conn->connect_error) {
    die("<p>❌ Falha na conexão: " . $conn->connect_error . "</p>");
}
?>