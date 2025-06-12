<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DigiBook</title>
    <link rel="stylesheet" href="css/register.css"> 
</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <div class="left-section">
                <div class="logo-group">
                    <img src="assets/LOGO.png" alt="LCC-B Logo" class="logo">
                </div>
                <h2>Join DigiBook</h2>
                <form method="POST">
                    <input type="text" placeholder="Full Name" name="fullname" required>
                    <input type="email" placeholder="Email" name="email" required>
                    <input type="text" placeholder="Username" name="username" required>
                    <input type="password" placeholder="Password" name="password" required>
                    <input type="password" placeholder="Confirm Password" name="confirm_password" required>
                    <button type="submit">Register</button>
                    <p>Already have an account? <a href="log.html">Login here</a>.</p>
                </form>
            </div>
            <div class="right-section">
                <img src="assets/books.jpg" alt="Blue Design">
                
            </div>
        </div>
    </div>

</body>
</html>

<?php

include 'php/server.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") return;

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password !== $confirm_password) {
    echo '<script>alert("Please confirm your password.")</script>';
    exit;
}

$hashpassword = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare('
        INSERT INTO user_tbl (username, email, passwd, fname)
        VALUES (:username, :email, :passwd, :fname)
    ');

    $stmt->execute([
        ':username' => $username,
        ':email' => $email,
        ':passwd' => $hashpassword,
        ':fname' => $fullname
    ]);

    echo '<script>alert("Submitted successfully!")</script>';

} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        echo '<script>alert("Username or Email already exists.")</script>';
    } else {
        echo '<script>alert("An error occurred: ' . $e->getMessage() . '")</script>';
    }
}

?>