<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Books Reporting</title>

    <!-- CSS links -->

    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <div class="container">
        <div class="tables">
            <h1>BOOK's Library</h1>

            <div class="search_box">
                <form method="POST" action="">
                    <input type="number" id="search" name="search" placeholder="Search Books I.D.">
                    <button type="submit">Search</button>
                </form>
            </div>
           
            <table>
                <thead>
                    <th width="70">Books ID</th>
                    <th width="120">Title</th>
                    <th width="120">Author</th>
                    <th>Genre</th>
                    <th>Publisher</th>
                    <th>Publisher Address</th>
                    <th width="80">Stock Quantity</th>
                    <th>Action</th>
                </thead>
                <tbody>
                <?php
                $servername = "sql211.infinityfree.com";
                $username = "if0_37557160";
                $password = "CO5eJugDjKuV";
                $dbname = "if0_37557160_books_db";

                $conn = new mysqli($servername, $username, $password, $dbname);


                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    $search = $_POST["search"];

                    $sql = $conn->prepare("SELECT * FROM book WHERE id = ?");
                    $sql->bind_param("i", $search);
                    $sql->execute();
    
                    $result = $sql->get_result();
    
                    if($result->num_rows > 0) {
    
                        while($row = $result->fetch_assoc()) {
    
                            echo '
                            
                            <tr>
                            <td>' . $row["id"] . '</td>
                            <td>' . $row["title"] . '</td>
                            <td>' . $row["author"] . '</td>
                            <td>' . $row["genre"] . '</td>
                            <td>' . $row["publisher"] . '</td>
                            <td>' . $row["publisherAddress"] . '</td>
                            <td>' . $row["stock"] . '</td>
                            <td>
                                <form method="POST" action="php/delete.php">
                                    <button type="submit">Delete</button>
                                    <input type="hidden" name="delete" value="' . $row["id"] . '"> 
                                </form>
                                <form method="POST" action="">
                                    <button type="submit">Update</button>
                                    <input type="hidden" name="delete" value="' . $row["id"] . '"> 
                                </form>
                                
                            </td>
                        </tr>
                            
                            
                            ';
    
                        }

                        
    
                    } else{
                        echo '
                            <h2>No Books are Existing with this ID</h2>
                        ';
                    }
                    $sql->close();
                }

               
                $conn->close();
                
                
                ?>
                    
                    </tbody>
                
            </table>
           
        </div>
    </div>
</body>

<!-- JS links -->

<script src="script/script.js"></script>

</html>
