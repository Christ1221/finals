<?php
// This script hashes a password and inserts a new user into the database

$servername = "localhost";
$db_username = "admin";
$db_password = "admin";     
$dbname = "digibook";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hash the password
$hashed_password = password_hash("your_password", PASSWORD_DEFAULT);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed_password);

// Set parameters and execute
$username = "your_username";
$stmt->execute();

echo "New user created successfully";

$stmt->close();
$conn->close();
?>
