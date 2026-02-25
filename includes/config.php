<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = ''; // Your database password
$dbname = 'your_database_name';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// CSV file paths
$csv_path = '/path/to/your/csv/file.csv';
// Add additional CSV file paths as needed
?>