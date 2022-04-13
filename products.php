<!DOCTYPE html>
<html lang="en">
<head>  
    <link rel="icon" type="image/png" sizes="16x16" href="/img/Logo.png">
    <title>My Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1", user-scalable="0">
    <link href="admin.css" type="text/css" rel="stylesheet" >
</head>

<header>
    <img src="img/Logo.png" alt="logo">
    <a href="signout.php" id="logout">LOGOUT</a>
</header>

<body>
    <nav>
       <div class= "nav">
            <img src="img/avatar.png" id="avatar">
            <p class="nom">Guillaume</p>
            <ul class= "menu"> 
                <li><a href="admin.php">HOME</a></li>
                <li><a href="profile.php">PROFILE</a></li>
                <li><a href="users.php">USERS</a></li>
                <li><a href="categories.php">CATEGORIES</a></li>
                <li><a href="products.php">PRODUCTS</a></li>
                <li><a href="404.php">ANALYSIS</a></li>
            </ul>
        </div>
    </nav>

<article>

<?php 

    /* INSTANCIATION DES PARAMETRES DB */
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "my_shop";
    $errors = array();
    $statusMsg ='';

    /* CONNECTION A LA BASE DE DONNES */
    try {
        $conn = new PDO("mysql:host=localhost;dbname=my_shop", $username, $password);
        // set the PDO error mode to exception
        $sql = "SELECT id, name, price, category_id, description FROM PRODUCTS";

        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
           
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage() . "\n";
        }
?>

<div id="container">
    <h1 class="title">YOUR PRODUCTS</h1>
    <table class="table table-bordered table-condensed" style="overflow-y:scroll">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category ID</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $q->fetch()): ?>
            <tr>
                <td class="product_table"><?php echo htmlspecialchars($row['id']) ?></td>
                <td class="product_table"><?php echo htmlspecialchars($row['name']); ?></td>
                <td class="product_table"><?php echo htmlspecialchars($row['price']); ?></td>
                <td class="product_table"><?php echo htmlspecialchars($row['category_id']); ?></td>
                <td class="product_table"><?php echo htmlspecialchars($row['description']); ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
    <div class="bouton_container">
        <div class="add">
           <a href="add_product.php" class="bouton">ADD A NEW PRODUCT</a>
        </div>

        <div class="delete">
            <a href="delete_product.php" class="bouton">DELETE A PRODUCT</a>
        </div>
    </div>
</article>

</body>
</html>