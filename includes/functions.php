<?php

// Database connection
function getDatabaseConnection() {
    $host = 'localhost';
    $db = 'your_database';
    $user = 'your_username';
    $pass = 'your_password';
    return new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
}

// User management functions
function createUser($username, $password) {
    $conn = getDatabaseConnection();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->execute([':username' => $username, ':password' => $hashedPassword]);
}

function getUser($username) {
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Pet management functions
function addPet($userId, $petName, $petType) {
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("INSERT INTO pets (user_id, name, type) VALUES (:userId, :name, :type)");
    $stmt->execute([':userId' => $userId, ':name' => $petName, ':type' => $petType]);
}

function getPetsByUserId($userId) {
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("SELECT * FROM pets WHERE user_id = :userId");
    $stmt->execute([':userId' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>