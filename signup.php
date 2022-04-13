<?php
    session_start();
?>

<html>
    <head>
        <link rel="icon" type="image/png" sizes="16x16" href="img/Logo.png">
        <title>My Shop</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1", user-scalable="0">
        <link href="form.css" type="text/css" rel="stylesheet">
    </head>
    <body>
    <div class="first">
            <img src="img/Logo.png" id="logo">
        </div>
    <div class="header2">
        <h1>CREATE A NEW ACCOUNT</h1>
    </div>
        <form action="<?php $db ?>" method="post" autocomplete="off">
            <div>
                <label for="name"><b>Name</b></label>
                <input type="text" id="name" name="name" class="input" required>
            </div>
            <div>
                <label for="email"><b>Email</b></label>
                <input type="email" id="email" name="email" class="input" required>
            </div>
            <div>
                <label for="passworduser"><b>Password</b></label>
                <input type="password" id="passworduser" name="passworduser" class="input" required>
            </div>
            <div>
                <label for="password_confirmation"><b>Confirm your Password</b></label>
                <input type="password" id="password_confirmation" name="password_confirmation" required class="input">
            </div>
            <div>
                <label for="terms" id="terms_label"><b>By clicking on this, you agree to our <a href="GTC.php" target="_blank"> Terms and Conditions</a> :</b></label>
                <input type="checkbox" id="terms" name="terms" required>
            </div>
            <br>
            <div>
                <input type="submit" value="SIGN UP" class ="btn" id="signup">
            </div>
            <p id="switch">Already have an account? <a href="signin.php">Log in</a>.</p> <br>
        </form>
    </body>     
</html>
<?php

$username = "root";
$password = "";
$db = "my_shop.sql";
$passworduser = isset($_POST['paswworduser']);
$passwordhash = password_hash($passworduser, PASSWORD_BCRYPT);

if (isset($_POST['name'])&& isset($_POST['email'])&& isset($_POST['passworduser'])&& isset($_POST['password_confirmation'])){
    try {
        $conn = new PDO("mysql:host=localhost;dbname=my_shop", $username, $password);
        #echo "Connection à la base de données établie";

    } catch(PDOException $e) {
        echo "Problème de connexion serveur: " . $e->getMessage() . "/n";
    }

        if(strlen($_POST["passworduser"]) < 8){
            echo "Votre mot de passe doit comporter 8 caractères minimum. ";
            }
            else{
                    $query = "SELECT email FROM users WHERE email = :email";  
                    $statement = $conn->prepare($query);  
                    $statement->execute(array('email'     =>     $_POST["email"],));
 
                    $count = $statement->rowCount();  
                        if($count > 0)  
                        {  
                            $_SESSION["email"] = $_POST["email"];
                            echo "This email already exist. Sign in or try with an another one."; 
                        }  
                        else  
                        { 
                            if ( $_POST['password_confirmation'] != $_POST['passworduser'] )
                            {
                                echo "The two passwords don't match. Please try again.";
                            }
                            else{

                                    $insertion = $conn->prepare('INSERT INTO users(username, email, password) VALUES(:name,:email,:passworduser)');
                                    $insertion->bindValue(':name', $_POST['name']);
                                    $insertion->bindValue(':email', $_POST['email']);
                                    $insertion->bindValue(':passworduser', $passwordhash);
                                    $verification=$insertion->execute();
                    
                                    if($verification){
                                        $_SESSION['username'] = $_POST['name'];
                                        session_regenerate_id();
                                        header("Refresh:0; index.php");
                                    }       
         
                                }
                        }
                }        
}else{
    echo "Please fill in the form";
    }     
?>