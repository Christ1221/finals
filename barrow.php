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
        <h1>Borrow Books</h1>
      </header>

      <section class="table-box">
        <h2>Select a Book to Borrow</h2>
        <table>
          <thead>
            <tr>
              <th>Book Title</th>
              <th>Book ID</th>
              <th>Author</th>
              <th>Category</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              
              <?php
              
              $stmtBooks = $pdo->prepare('SELECT * FROM books_tbl');
              $stmtBooks->execute();
              
              $result_books = $stmtBooks->fetchAll(PDO::FETCH_ASSOC);
              
              
              foreach ($result_books as $rows) {
                  
                  $classSet = '';
                  
                  if ($rows['books_status'] === 'Available') {
                     $classSet = 'available';
                     
                  } else {
                      $classSet = 'available_yellow';
                      
                  }
                  
                  echo '
                  <tr>
                  <td>' . $rows['book_title'] . '</td>
                  <td>' . $rows['id'] . '</td>
                  <td>' . $rows['author'] . '</td>
                  <td>'. $rows['category'] . '</td>
                  <td><span class="' . $classSet . '">' . $rows['books_status'] . '</span></td>
                  
                  ';
                  
                  
                  if ($rows['books_status'] === 'Available') {
                      
                     echo '<td>
                      <form method="POST">
                          <input type="hidden" name="borrow" value="Borrowed">
                          <input type="hidden" name="booksId" value="' . $rows['id'] . '">
                          <button class="borrow-btn">borrow</button>
                      </form>
                   </td>' ;
                      
                  } else {
                      
                      
                      echo '<td>
                      <form method="POST">
                          <input type="hidden" name="borrow" value="Available">
                          <input type="hidden" name="booksId" value="' . $rows['id'] . '">
                          <button class="borrow-btn">return</button>
                      </form>
                      </td>
                      
                      ';
                      
                      
                  }
                  
                  
                  
                  echo '</tr>';
                  
                  
              }
              
              
              ?>
            
            </tr>
            
          </tbody>
        </table>
      </section>
    </main>
  </div>



<script src="js/borrow.js"></script>


</body>
</html>
<?php

include 'php/server.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") return;

$borrow = $_POST['borrow'];
$booksId = $_POST['booksId'];

try {
    $stmt = $pdo->prepare('
        UPDATE books_tbl SET books_status = :books_status WHERE id = :id
    ');

    $stmt->execute([
        ':books_status' => $borrow,
        ':id' => $booksId
    ]);
    
    if ($stmt) {
        header('Location: /barrow.php');
    }

    

} catch (PDOException $e) {
    
        echo '<script>alert("An error occurred: ' . $e->getMessage() . '")</script>';
    
}

?>