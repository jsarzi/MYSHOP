<?php
    session_start();
?>

<html>
<head>
  <link rel="icon" type="image/png" sizes="16x16" href="img/Logo.png">
  <title>My Shop</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1", user-scalable="0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="password.css">
</head>
<body>
  
  <div class = "message">
    <img src="img/smiley.png" id="smiley">
    <p><b>A new password has been sent. <br> 
    Please, check your email.</b></p>
    <br>
    <p> Meanwhile, you can still shop as a guest : </p>
    <input type="button" class="btn" value="Click here" onClick="document.location.href='index.php'"> 
  </div>

</html>
</body>