<?php

session_start();

include 'php/server.php';

if(!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<?php
include 'components/header.php';
?>
<body>
  <div class="container">
    <aside class="sidebar">
      <div class="logo">
        <img src="assets/logo.png" alt="Logo" />
        <span>CATHOLIC MINGYUAN COLLEGE</span>
      </div>
      <?php
        include 'components/navbar.php';
      ?>  
    </aside>

    <main class="main">
      <header class="topbar">
        <h1>Add New Book</h1>
      </header>

      <section class="form-box">
        <h2>Book Information</h2>
        <form method="POST">
          <div class="form-group">
            <label for="bookTitle">Book Title</label>
            <input type="text" id="bookTitle" name="bookTitle" required>
          </div>

          <div class="form-group">
            <label for="author">Author</label>
            <input type="text" id="author" name="author" required>
          </div>

          <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category" required>
              <option value="">Select Category</option>
              <option value="Science">Science</option>
              <option value="Mathematics">Mathematics</option>
              <option value="History">History</option>
              <option value="Literature">Literature</option>
              <option value="Technology">Technology</option>
            </select>
          </div>

          <div class="form-group">
            <label for="issueDate">Issue Date</label>
            <input type="date" id="issueDate" name="issueDate" required>
          </div>

          <div class="form-group">
            <label for="expiryDate">Expiry Date</label>
            <input type="date" id="expiryDate" name="expiryDate" required>
          </div>

          <button type="submit">Add Book</button>
        </form>
      </section>
    </main>
  </div>

  <script src="addbook.js"></script>

</body>
</html>

<?php

include 'php/server.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") return;

$bookTitle = $_POST['bookTitle'];
$author = $_POST['author'];
$category = $_POST['category'];
$issueDate = $_POST['issueDate'];
$expiryDate = $_POST['expiryDate'];
$books_status = 'Available';

$stmt = $pdo->prepare('
    INSERT INTO books_tbl
    (book_title, author, category, issueDate, expiryDate, books_status)
    VALUES 
    (:book_title, :author, :category, :issueDate, :expiryDate, :books_status)');
    
    $stmt->execute([
        ':book_title' => $bookTitle,
        ':author' => $author,
        ':category' => $category,
        ':issueDate' => $issueDate,
        ':expiryDate' => $expiryDate,
        ':books_status' => $books_status
    ]);
    
    if ($stmt) {
        echo '<script>alert("Submitted successfully!")</script>';
    } else {
        echo '<script>alert("An error occurred")</script>';
    }



?>
