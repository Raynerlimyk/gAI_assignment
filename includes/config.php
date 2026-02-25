<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
dbname = 'your_database_name';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Helper function example
function getUser($id) {
    global $conn;
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}
?>