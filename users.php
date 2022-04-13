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


    try {
        $conn = new PDO("mysql:host=localhost;dbname=my_shop", $username, $password);
        // set the PDO error mode to exception
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
        $sql = "SELECT id, username, password, email, admin FROM users";

        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage() . "\n";
        }
       ?>

<div id="container">
            <h1 class="title">Users</h1>
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
      
                        <tr>
                            <td class="user_table"><?php echo htmlspecialchars($row['id']) ?></td>
                            <td class="user_table"><?php echo htmlspecialchars($row['username']); ?></td>
                            <td class="user_table"><?php echo htmlspecialchars($row['password']); ?></td>
                            <td class="user_table"><?php echo htmlspecialchars($row['email']); ?></td>
                            <td class="user_table"><?php 
                                if (is_null($row['admin'])) {
                                    echo "User";
                                } elseif ($row['admin'] >= 0) {
                                    echo "Admin";
                                } else {
                                    echo "Undefined";
                                }  ?></td>
                           
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            </div>

        <form method="post" action="">
        <div class="bouton_container">
            <div class="categories">
                <input type="text" id="name" name="userid" onfocus="this.value=''" value="User ID">
            </div>        
            <div class="submit">
                <button type="submit" class="bouton" name="button">CHANGE USER TO ADMIN</button>
            </div>
        </form>
    </div>

</article>

<?php 
      
        
if(isset($_POST['button']) && isset($_POST['userid'])){
    $user = $_POST['userid'];
 
        $query = "SELECT id FROM users where id=:userid";
        $statement = $conn ->prepare($query);
       
        $statement->bindValue(':userid', $user);
       
        $statement ->execute();

        
        
    

    $sql = "UPDATE users SET admin=1 where id='$user'";

  $insertion = $conn->prepare($sql);
 
    $verification=$insertion->execute();
   
    if($verification){
    echo $user. " is now admin!";
    }
}
?>
</body>
</html>