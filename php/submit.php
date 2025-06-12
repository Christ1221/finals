<?php

include 'connect.php';

class SubmitUser {

    private $pdo;
    private $data;
   
    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->data = $_POST;
    }

    public function sanitize($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    public function insertUser() {
        $username = $this->sanitize($this->data['username']);
        $passwd = password_hash($this->sanitize($this->data['password']), PASSWORD_DEFAULT);
        $fullname = $this->sanitize($this->data['fullname']);
        $email = $this->sanitize($this->data['email']);

        try {

            $stmt = $this->pdo->prepare("INSERT INTO user (username, passwd, fname, email) 
            VALUES (:username, :passwd, :fname, :email)");

            $stmt->execute([
                ':username' => $username,
                ':passwd' => $passwd,
                ':fname' => $fullname,
                ':email' => $email
            ]);

            if ($stmt) {
                echo 'Submitted Successfully';
            } else {
                echo 'Error';
            }

        } catch (PDOExeption $e) {
            echo "username already exist";
        }

    }

}

$manager = new SubmitUser($pdo);

$manager->insertUser();

?>