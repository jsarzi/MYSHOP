<?php
    session_start();
?>

<html>
<head>
    <link rel="icon" type="image/png" sizes="16x16" href="img/Logo.png">
    <title>My Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1", user-scalable="0">
    <link rel="stylesheet" type="text/css" href="form.css">
</head>
<body>
        <div class="first">
            <img src="img/Logo.png" id="logo">
        </div>
    <div class="header">
        <h1>MY ACCOUNT</h1>
    </div>
    <div class="form">
            <form action="<?php $db ?>" method="post">
                <div>
                    <label for="email"><b>Email</b></label>
                    <input type="email" id="email" name="email" required class="input">
                </div>
                <br>
                <div>
                    <label for="passworduser"><b>Password</b></label>
                    <input type="password" id="passworduser" name="passworduser" required class="input">
                    <br>
                    <a href = "reset_password.php" > Password forgotten ?</a></button>
                </div>
                <br>
                <div>
                    <input type="submit" value="SIGN IN" class="btn">
                </div>
                <br>
                <div class="container signup">
                     <p id="switch2">Don't have an account yet? <a href="signup.php">Sign up</a>.</p>
                 </div>
            </form>

            <div class="footer">
                <p id="return"> Want to get back as guest? </p>
                <input type="button" class="btn" value="CLICK HERE" onClick="document.location.href='index.php'">
            </div>
    </div>
    
    </body>     
</html>
<?php

    $username = "root";
    $password = "";
    $db = "my_shop.sql";

    try {
        $conn = new PDO("mysql:host=localhost;dbname=my_shop", $username, $password);

    } catch(PDOException $e) {
        echo "Problème de connexion serveur: " . $e->getMessage() . "/n";
    }
    if(empty($_POST["email"]) || empty($_POST["passworduser"]))  
    {  
         $message = '<label>All fields are required</label>';  
    }  
        else  
        {  
         $query = "SELECT email, password, username FROM users WHERE email = :email AND password = :passworduser";  
         $statement = $conn->prepare($query);  
         $statement->execute(  
              array(  
                   'email'     =>     $_POST["email"],  
                   'passworduser'     =>     $_POST["passworduser"]
                )
         );

         $count = $statement->rowCount();  
        if($count > 0)  
        {       
            $_SESSION["email"] = $_POST["email"];

            $getUsername = "select username from users where email = :email";
            $stmt = $conn->prepare($getUsername);
            $stmt->bindValue(':email', $_POST['email']);  
            $stmt->execute();

            $row = $stmt -> fetch(); 
            if (isset($row[0])) {
                $_SESSION['username'] = $row[0];
              }


            $checkadmin = "SELECT admin from users where email = :email";
            $stmt = $conn->prepare($checkadmin);
            $stmt->bindValue(':email', $_POST['email']);  
            $stmt->execute();
 
            while ($row = $stmt-> fetch()) 
            {
                if($row[0]>=1){
                    session_regenerate_id();
                    header( "refresh:0; admin.php"); 
                }else{
                    session_regenerate_id();
                    header("Refresh:0; index.php");
                }  
            }
        } else {  
            echo "<br>"."The email and password don't match. Please try again";
        }  
    }    
?> 
   
   