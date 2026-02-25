<?php
// login.php

// Start the session
session_start();

// Include database connection file
include('db_connection.php');

// Check if the user is already logged in
if(isset($_SESSION['user_id'])) {
    header('Location: dashboard.php'); // Redirect to dashboard
    exit();
}

// Initialize variables
$email = $password = '';
$errors = [];

// Process the form when submitted
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate input
    if(empty(trim($_POST['email']))) {
        $errors[] = "Email is required.";
    } else {
        $email = trim($_POST['email']);
    }

    if(empty(trim($_POST['password']))) {
        $errors[] = "Password is required.";
    } else {
        $password = trim($_POST['password']);
    }

    // Check for errors before querying the database
    if(empty($errors)) {
        // Prepare a select statement
        $sql = "SELECT id, email, password FROM users WHERE email = ?";

        if($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            // Check if the email exists and verify password
            if($stmt->num_rows == 1) {
                $stmt->bind_result($id, $email, $hashed_password);
                if($stmt->fetch()) {
                    if(password_verify($password, $hashed_password)) {
                        // Password is correct, start a new session
                        session_start();
                        $_SESSION['user_id'] = $id;
                        $_SESSION['email'] = $email;
                        header('Location: dashboard.php');
                        exit();
                    } else {
                        $errors[] = "Invalid password.";
                    }
                }
            } else {
                $errors[] = "No account found with that email.";
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
    <?php
    if(!empty($errors)) {
        foreach($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
    ?>
</body>
</html>