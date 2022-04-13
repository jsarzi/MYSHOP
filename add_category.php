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


<article class="add">

<form method="post" action="">
    <div class="bouton_container">
        <div class="categories">
            <label for="categories">Category</label>
            <input type="text" id="name" name="name" value="">
        </div>    
    
        <div class="parentid">
            <label for="parentid">Parent ID</label>
            <input type="text" id="parent" name="parent" value="">
        </div> 
        <div class="submit">
            <button type="submit" class="bouton" name="Bouton">CREATE NEW CATEGORY</button>
        </div>
    </div>
</form>
<?php 

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "my_shop";
    $errors = array();

    try {
        $conn = new PDO("mysql:host=localhost;dbname=my_shop", $username, $password);
        // set the PDO error mode to exception
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
                            <td><?php echo htmlspecialchars($row['id']) ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['parent_id']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            </div>

<?php 
if(isset($_POST['name']) && isset($_POST['parent'])){
    $name = $_POST['name'];
    $parent = $_POST['parent'];

    $sql = "INSERT INTO categories (name, parent_id) VALUES(:name, :parent)";
  

    $insertion = $conn->prepare($sql);
    $insertion->bindValue(':name', $_POST['name']);
    $insertion->bindValue(':parent', $_POST['parent']);
    $verification=$insertion->execute();
    if($verification){

        echo "Category registered";
        header( "refresh:2; add_category.php" ); 
    } 
}
?>
</article>

</body>
</html>