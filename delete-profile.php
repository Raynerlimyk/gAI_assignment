<?php
// delete-profile.php

// Check if user is logged in
session_start();
if(!isset($_SESSION['user_id'])) {
    die('You must be logged in to delete your profile.');
}

// Connect to the database
include 'db_connection.php';
$user_id = $_SESSION['user_id'];

// Check for confirmation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // If confirmed, proceed to delete
    $delete_query = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param('i', $user_id);
    if ($stmt->execute()) {
        // Cleanup associated data
        $cleanup_query = "DELETE FROM user_data WHERE user_id = ?";
        $stmt_cleanup = $conn->prepare($cleanup_query);
        $stmt_cleanup->bind_param('i', $user_id);
        $stmt_cleanup->execute();

        // Destroy session and redirect to goodbye page
        session_destroy();
        header('Location: goodbye.php');
        exit();
    } else {
        echo 'Error deleting profile. Please try again.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Profile</title>
</head>
<body>
    <h1>Delete Your Profile</h1>
    <form method="POST">
        <p>Are you sure you want to delete your profile? This action cannot be undone.</p>
        <button type="submit">Delete Profile</button>
    </form>
    <a href="dashboard.php">Cancel</a>
</body>
</html>