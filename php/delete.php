<?php

$servername = "sql211.infinityfree.com";
$username = "if0_37557160";
$password = "CO5eJugDjKuV";
$dbname = "if0_37557160_books_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $deleteId = $_POST["delete"];

    $sql = $conn->prepare("DELETE FROM book WHERE id = ?");
    $sql->bind_param("i", $deleteId);
    $sql->execute();
    $sql->close();

    header('Location: https://cordy001.great-site.net/indexmain.php');
}


$conn->close();


?>