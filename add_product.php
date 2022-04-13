<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/Logo.png">
    <title>My Shop</title>
    <link rel="stylesheet" type="text/css" href="form.css">
</head>
<body>

<div class="header">
        <h1>CREATE A NEW PRODUCT</h1>
    </div>
    <form action="" method="post" id="add_product"  enctype="multipart/form-data">
        <label for="name"><b>Name</b></label>
        <input type="text" id="name" name="name" value="" class="input2">
        <br>
        <label for="price"><b>Price</b></label>
        <input type="text" id="price" name="price" value="" class="input2">
        <br>
        <label for="category"><b>Category</b></label> 
        <input type="text" name="category_id" class="input2"> <br>
        <br>
        <label for="description"><b>Description</b></label> 
        <input type="text" name="description" class="input2"> <br>
        <br>
        <input type="submit" name="submit" value="CREATE A NEW PRODUCT" class="btn" id="sender2" >
        <br>  
    </form>
    <div class="footer2">
                <p id="return"> Get back ? </p>
                <input type="button" class="btn" value="CLICK HERE" onClick="document.location.href='products.php'">
    </div>

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

    /*VERIFICATION DU SUBMIT POUR INITIER UPLOAD*/
    if(isset($_POST['name']) && isset($_POST['price']) && isset($_POST['category_id']) && !empty($_POST['description'])){

        /*CREATION DE VARIABLES */
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category_id'];
        $description = $_POST['description'];

        if(!empty($_FILES["image"]["name"])) {
            $fileName = basename($_FILES["image"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
            echo $fileType;
            
            /*VERIF TYPE DE FICHIER TRANSMIS*/
            $allowTypes = array('jpg','png','jpeg','gif'); 
            if(in_array($fileType, $allowTypes)){ 
                $image = $_FILES['image']['tmp_name']; 
                $imgContent = addslashes(file_get_contents($image)); 
         
                /*REQUETE AVEC IMAGE*/
                $sql = "insert into products (name, price, category_id, image, description) values(:name, :price, :category, :image, :description)";
            
                $insertion = $conn->prepare($sql);
                $insertion->bindValue(':name', $name);
                $insertion->bindValue(':price', $price);
                $insertion->bindValue(':category', $category);
                $insertion->bindValue(':image', $imgContent);
                $insertion->bindValue(':description', $description);
                $verification=$insertion->execute();
                if($verification){
                    $statusMsg = "<br>"."Product created (with image)";
                    header( "refresh:2; add_product.php" ); 
                } else {
                    $statusMsg = "<br>"."Something went wrong : upload failed, please try again."; 
                }
            }else{ 
                $statusMsg = "<br>"."Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload."; 
            } 
        } else {
            $statusMsg = "<br>"."Please select an image file to upload."; 

            /*REQUETE SANS IMAGE*/
            $sql = "insert into products (name, price, category_id, description) values(:name, :price, :category, :description)";
        
            $insertion = $conn->prepare($sql);
            $insertion->bindValue(':name', $name);
            $insertion->bindValue(':price', $price);
            $insertion->bindValue(':category', $category);
            $insertion->bindValue(':description', $description);
            $verification=$insertion->execute();
            if($verification){
                echo "<br>"."Product created";
                header( "refresh:2; add_product.php" ); 
            } else {
                echo "Something went wrong. Check your input.";
            }
        }
    } elseif (isset($_POST['submit'])) {
        echo "<br>"."Please fill in this form carefully.";
    }   
    /*AFFICHACHE DU STATUS*/
    echo $statusMsg; 
?>

</body>
</html>