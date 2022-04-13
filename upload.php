<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php 
/* INSTANCIATION DES PARAMETRES DB */
$servername = "localhost";
$user = "root";
$password = "";
$db = "my_shop";

/* CONNECTION A LA BASE DE DONNES */
$mysqli = new mysqli($servername, $user, $password, $db);

$statusMsg ='';
/*VERIFICATION DU SUBMIT POUR INITIER UPLOAD*/
if(isset($_POST["submit"])){ 
    echo "test1";
    if(!empty($_FILES["image"]["name"])) { 
        /*RECUP INFOS DU FICHIER*/
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        echo $fileType;
         
           /*VERIF TYPE DE FICHIER TRANSMIS*/
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
         
            /*INSERTION DANS LA DB*/
            $insert = $mysqli->query("INSERT into products (image) VALUES ('$imgContent')"); 
             
            if($insert){ 
                $statusMsg = "File uploaded successfully."; 
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload."; 
        } 
    }else{ 
        $statusMsg = "Please select an image file to upload."; 
        echo "why?";
    } 
    echo "test2";
} 

/*AFFICHACHE DU STATUS*/
echo $statusMsg; 
?>
<a href="new_product.php"> Try again? </a>
<form action="upload.php" method="post" enctype="multipart/form-data">
        <label>See the image you just updated :</label> <br>
        <input type="submit" name="display" value="display"> <br>
    </form>
<?php 
// Get image data from database 
    if(isset($_POST["display"])) {
        $result = $mysqli->query("SELECT image FROM products ORDER BY id DESC limit 1"); 
        if($result->num_rows > 0){ ?> 
        <div class="gallery"> 
            <?php while($row = $result->fetch_assoc()){ ?> 
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" /> 
            <?php }
        } ?> 
        </div> <?php 
    } else {
        echo "Something went wrong, image not found.";
    } ?>

    

</body>
</html>