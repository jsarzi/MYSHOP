<?php
    /* SESSION START */
    session_start();
    if(null !==(session_id())) {
        $id_session = session_id();
    }
    $_SESSION['id'] = $id_session;
?>

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
    <div class="news">
        <h1>Breaking News</h1>
        <div class="product">
            <img src="img/tropical.png" alt="tropical" id="tropical">
            <p><strong>New collection "Tropical"</strong> out the 10th of March online!<br> We are so happy to announce to the Group that we are launching the new collection "Tropical" on our Ecommerce platforme.<br> It is a collection that our client is waiting for a long time and we are so happy that we will offer this <em>HUGE</em> suprice to them. It is a really original collection that will offer furnitures from the bedroom to the bathroom, so it is going to be a large amount of choice.<br> We are counting on you to advertise well the collection and also do a brief to your team. </p>
        </div>

        <div class="member">
            <img src="img/manager.png" alt="manager" id="manager">
            <p class="info">Top manager of the month: Guillaume</p>
            <p>Guillaume started working at my_shop in 2014 as an inter in Sales.
                8years after, we are happy to see that he growed inside of our awesome company and that he is an awesome manager!!! 
                Thank you at his team also for the har word.</p>
        </div>
    </div>
</article>
    </body>
</html>
    


