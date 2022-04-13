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
    <h1>RESET YOUR PASSWORD</h1>
  </div>
  <div class="form">
    <form action="" method="post">
      <div>
        <label for="email"><b>Email</b></label>
        <input type="email" id="email" name="email" required class="input">
      </div>
      <br>
      <input type="button" class="btn" id="sender" value="SEND A NEW ONE" onClick="document.location.href='confirm_reset.php'">
    </form>

    <div class="footer">
      <p id="return"> Want to get back as guest? </p>
      <input type="button" class="btn" value="CLICK HERE" onClick="document.location.href='index.php'">
    </div>
  </div>

</body>
</html>

