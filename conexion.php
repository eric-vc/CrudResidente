<?php
    $servername = "localhost";
    $database = "EscuelaV1";
    $username = "root";
    $password = "";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . $conn->error());
    }
?>