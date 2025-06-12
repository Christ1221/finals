<?php
session_start();

include 'php/server.php';

if(!isset($_SESSION['username'])) {
    header('Location: log.php');
    exit;
}

$stmt = $pdo->prepare('
    SELECT COUNT(*) FROM user_tbl
');

$stmt->execute();
$count = $stmt->fetchColumn();

$books_count = $pdo->prepare('
    SELECT COUNT(*) FROM books_tbl
');

$books_count->execute();
$count_books = $books_count->fetchColumn();

$books_available = $pdo->prepare("
    SELECT COUNT(*) FROM books_tbl WHERE books_status = 'Available'
");

$books_available->execute();
$books_available_result = $books_available->fetchColumn();

$books_borrow = $pdo->prepare("
    SELECT COUNT(*) FROM books_tbl WHERE books_status = 'Borrowed'
");

$books_borrow->execute();
$books_borrow_result = $books_borrow->fetchColumn();



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
  <img src="assets/logo.png" alt=" Logo" />
  <span>CATHOLIC MINGYUAN COLLEGE </span>
</div>

<?php
include 'components/navbar.php';
?>  
    </aside>

    <main class="main">
      <header class="topbar">
        <div class="welcome">Welcome to Library Dashboard
        <?php echo $_SESSION['username'];?>
        </div>
       <div class="user">
  <a href="/php/logout.php" class="user-button">
    <span>Log Out</span>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="dashboard.js"></script>
</body>

  </a>
</div>

      </header>

      <section class="stats">
        <div class="card yellow">Logged in user<br><strong><?php echo $count;?></strong></div>
        <div class="card red">Total Books<br><strong><?php echo $count_books;?></strong></div>
      </section>

      <section class="report">
        <h3>Reports</h3>
        <div class="chart-placeholder"><canvas id="dashboardChart" width="400" height="200"></canvas></div>
        
      </section>

      <section class="data-tables">
        <div class="table-box">
          <h4>Available Books</h4>
          <table>
          <thead>
            <tr>
              <th>Book Title</th>
              <th>Book ID</th>
              <th>Author</th>
              <th>Category</th>
              <th>Status</th>
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
                  </tr>
                  
                  ';
                  
              }
              
              
              ?>
            
            
          </tbody>
        </table>
        </div>

        
      </section>
    </main>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('dashboardChart').getContext('2d');
  const dashboardChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Borrows Books', 'Available Books'],
      datasets: [{
        label: 'Books Issued',
        data: [<?php echo $books_borrow_result;?>, <?php echo $books_available_result;?>],
        backgroundColor: 'rgba(54, 162, 235, 0.5)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1,
        borderRadius: 5
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 20
          }
        }
      }
    }
  });
</script>


</body>
</html>
