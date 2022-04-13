<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="form.css">
</head>
<body>

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

<!-- TABLEAU DES PRODUITS -->   
<div id="container">
    <h1>YOUR PRODUCTS</h1>
    <table class="table table-bordered table-condensed">
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
<div class="delete_box">
<div class="header">
        <h1 id="titre">DELETE A PRODUCT</h1>
    </div>
    <!-- FORMULAIRE POUR DETRUIRE LE PRODUIT -->
    <form action="" method="post" id="delete_product"  enctype="multipart/form-data">
        <label for="name"><b class="delete_label">Name</b></label><label for="id"><b>Product ID</b></label>
        <br>
        <input type="text" id="name" name="name" value="" class="delete_input">
        <input type="text" id="product_id" name="product_id" value="">
        <br>
        <br>
        <input type="submit" name="submit" value="DELETE THIS PRODUCT" class="btn" id="sender2">    
    </form>
        </div>
<?php 
    /*DESTRUCTION SELON L'INPUT*/
    if(!empty($_POST['name'])){

        /*CREATION DE VARIABLES */
        $name = $_POST['name'];
        
        /*REQUETE BY NAME*/
        $sql = "delete from products where name =:name";
        
        $insertion = $conn->prepare($sql);
        $insertion->bindValue(':name', $name);
        $verification=$insertion->execute();
        if($verification){
            if($insertion->rowCount() > 0){
                echo "<br>"."Product destroyed";
                header( "refresh:2; delete_product.php" ); 
            } else {
                echo "<br>"."Product not found. Check your input.";
            } 
        } else {
            echo "Something went wrong. Check your input.";
        }
    } elseif(!empty($_POST['product_id'])){

        /*CREATION DE VARIABLES */
        $product_id = $_POST['product_id'];
        
        /*REQUETE BY NAME*/
        $sql = "delete from products where id =:product_id";
        
        $insertion = $conn->prepare($sql);
        $insertion->bindValue(':product_id', $product_id);
        $verification=$insertion->execute();
        if($verification){
            if($insertion->rowCount() > 0){
                echo "<br>"."Product destroyed";
                header( "refresh:2; delete_product.php" ); 
            } else {
                echo "<br>"."Product not found. Check your input.";
            }
        } else {
            echo "Something went wrong. Check your input.";
        }
    }
?>

<div class="footer2">
                <p id="return"> Get back ? </p>
                <input type="button" class="btn" value="CLICK HERE" onClick="document.location.href='products.php'">
    </div>
</body>
</html>