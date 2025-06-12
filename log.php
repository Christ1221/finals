<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DigiBook</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <div class="left-section">
                <div class="logo-group">
                   
                    <img src="assets/LOGO.png" alt="LCC-B Logo" class="logo">
                </div>
                <h2>Hello, <br> welcome!</h2>
                <form method="POST">
    <input type="text" placeholder="Username" name="username" required>
    <input type="password" placeholder="Password" name="password" required>
    <button type="submit">Login</button>
</form>

                    <div class="register-link">
                        <p>Don't have an account? <a href="register.html">Register Now</a></p>
                    </div>
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

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare('
    SELECT * FROM user_tbl
    WHERE username = :username
    LIMIT 1
');

$stmt->execute([
    ':username' => $username
]);

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {

$hashpassword = $result['passwd'];

if (password_verify($password, $hashpassword)) {
       session_start();
       $_SESSION['username'] = $username;
       header('Location: /dashboard.php');
   } else {
       echo '<script>alert("Password Wrong")</script>';
   }
    
} else {
    echo '<script>alert("User Not Exist")</script>';
}





?>
