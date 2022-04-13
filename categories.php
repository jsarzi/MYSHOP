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


    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "my_shop";
    $errors = array();

    try {
        $conn = new PDO("mysql:host=localhost;dbname=my_shop", $username, $password);
        // set the PDO error mode to exception
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
        $sql = "SELECT id, name, parent_id FROM categories";

        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage() . "\n";
        }
       ?>

<div id="container">
            <h1 class="title">Categories</h1>
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Parent ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
      
                        <tr>
                            <td class="category_table"><?php echo htmlspecialchars($row['id']) ?></td>
                            <td class="category_table"><?php echo htmlspecialchars($row['name']); ?></td>
                            <td class="category_table"><?php echo htmlspecialchars($row['parent_id']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            </div>

            <div class="bouton_container">
                <div class="add">
                    <a href="add_category.php" class="bouton">ADD CATEGORY</a>
                </div>

                <div class="delete">
                    <a href="modify_category.php" class="bouton">MODIFY CATEGORY</a>
                </div>

                <div class="modify">
                    <a href="delete_category.php" class="bouton">DELETE CATEGORY</a>
                </div>
            </div>

</article>

</body>
</html>