<?php
    /* SESSION START */
    session_start();
    if(null !==(session_id())) {
        $id_session = session_id();
    }
    if(null !==($_COOKIE['PHPSESSID'])) {
        $id_session = $_COOKIE['PHPSESSID'];
    }
    $_SESSION['id'] = $id_session;
    echo $_SESSION['id'];
?>

<!DOCTYPE php>
<php>
    <head>
        <link rel="icon" type="image/png" sizes="16x16" href="/img/Logo.png">
        <title>My Shop</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1", user-scalable="0">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
       
        <header>

            <!-- NAVIGATION / MENU PRINCIPAL -->
            <nav id="topbar">
                <div id="topbar_left">
            
                    <!-- NAVIGATION / MENU PRINCIPAL EN HAUT A GAUCHE AVEC LOGO-->
                    <ul id="menu">
                        <li class="menu"><a href="/index2.php"><img src="img/Logo.png" id="logo"></a></li>
                        <li class="menu"><a href="/index2.php"><p class="spinner" id="first_spinner">HOME</p></a></li>
                        <li class="menu"><a href="/index2.php"><p class="spinner">SHOP</p></a></li>
                        <li class="menu"><a href="/index2.php"><p class="spinner">MAGAZINE</p></a></li>
                    </ul>
                </div>

                <!-- NAVIGATION / MENU PRINCIPAL EN HAUT A DROITE AVEC LOGIN & CART-->
                <div id="topbar_right">
                  <?php 
                      $hide;
                      if (isset($_SESSION['username'])) { 
                            $hide = 1;?>
                          <b>Welcome <?php echo $_SESSION['username'] ?>!</b>
                          <a href="signout.php" id="logout"><p>LOGOUT</p></a>
                <?php }
                      if(!isset($hide)) { ?>
                          <a href="signin.php" id="login"><p>LOGIN</p></a>
                <?php }?> 
                  <button id="cart"><img src="../img/cart.png" id="cart_img"></button>
                </div>
            </nav>

              <!-- SEARCH BAR ET ORDER BY -->
            <div id="search_nav">
                <button id="search_button"><img src="img/Search.png" id="search_logo"></button>
                <input type="search" value="living room" onfocus="this.value=''" id="searchbar">
                <select id="sorter">
                    <option selected>Best match</option>
                    <option>Newest</option>
                    <option>Price : low to high</option>
                    <option>Price : high to low</option>
                    <option>Top sellers</option>
                </select>
            </div>

        </header>

        <!-- MAIN CONTENT - GRID WITH FILTER & PRODUCTS -->
        <section>
            <div id="grid_container">

                <!-- FILTER BY  -->
                <nav class="card" id="sidebar">
                    <p id="filter_title">FILTER BY</p>
                    <ul id="filters">
                        <li class="filter">
                            <select class="filter" >
                                <option selected>Collection</option>
                                <option>Printemps / Ete 2022</option>
                                <option>Automne / Hiver 2021</option>
                                <option>Printemps / Ete 2021</option>
                                <option>Autome / Hiver 2020</option>
                                <option>Previous collections</option>
                            </select>
                        </li>
                        <li class="filter">
                            <select class="filter">
                                <option selected>Color</option>
                                <option>Black</option>
                                <option>White</option>
                                <option>Grey</option>
                                <option>Red</option>
                                <option>Purple</option>
                            </select>
                        </li>
                        <li class="filter">
                            <select class="filter">
                                <option selected>Category</option>
                                <option>Tables</option>
                                <option>Chairs</option>
                                <option>Desk</option>
                                <option>Shelves</option>
                                <option>Purple</option>
                            </select>
                        </li>
                        <li class="filter">
                            <p id="price">Price Range</p>
                            <span class="double_range">
                                <div slider id="slider-distance">
                                    <div>
                                      <div inverse-left style="width:70%;"></div>
                                      <div inverse-right style="width:70%;"></div>
                                      <div range style="left:30%;right:40%;"></div>
                                      <span thumb style="left:30%;"></span>
                                      <span thumb style="left:60%;"></span>
                                      <div sign style="left:30%;">
                                        <span id="value">30</span>
                                      </div>
                                      <div sign style="left:60%;">
                                        <span id="value">60</span>
                                      </div>
                                    </div>
                                    <input type="range" tabindex="0" value="30" max="100" min="0" step="1" oninput="
                                    this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
                                    var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
                                    var children = this.parentNode.childNodes[1].childNodes;
                                    children[1].style.width=value+'%';
                                    children[5].style.left=value+'%';
                                    children[7].style.left=value+'%';children[11].style.left=value+'%';
                                    children[11].childNodes[1].innerHTML=this.value;" />
                                  
                                    <input type="range" tabindex="0" value="60" max="100" min="0" step="1" oninput="
                                    this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
                                    var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
                                    var children = this.parentNode.childNodes[1].childNodes;
                                    children[3].style.width=(100-value)+'%';
                                    children[5].style.right=(100-value)+'%';
                                    children[9].style.left=value+'%';children[13].style.left=value+'%';
                                    children[13].childNodes[1].innerHTML=this.value;" />
                                  </div>
                            </span>
                             
                        </li>
                    </ul>
                </nav>

                <?php
                    $username = "root";
                    $password = "";
                    $db = "my_shop.sql";
                    
                    try {
                        $conn = new PDO("mysql:host=localhost;dbname=my_shop", $username, $password);
                        #echo "Connection à la base de données établie";
                    
                                $requete = "SELECT id,name,price,category_id from products order by id limit 6;";
                                $result = $conn->query($requete);
                                $result->setFetchMode(PDO::FETCH_ASSOC);
                            
                            } catch(PDOException $e) {
                            echo "Problème de connexion serveur: " . $e->getMessage() . "/n";
                            }
                 while ($grid = $result->fetch()):?> <!-- PRODUCT 1  -->
                <div class="card">
                    <img src="img/coombes1.jpg" class="card_image" id="coombes1">
                    <div class="card_content">
                        <div class="card_left">
                            <h1><?php echo htmlspecialchars($grid['name']); ?></h1>
                            <img src="img/stars.png" class="stars">
                        </div>
                        <div class="card_right">
                            <p><?php echo htmlspecialchars($grid['price']); ?></p> 
                            <img src="img/cart.png" class="cart">
                       </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </section>

        <footer>
            <!-- LISTE DES PAGES SUIVANTES -->
            <ul id="pages">
                <li class="pages"><a href="#" class="pages" id="page1">1</a></li>
                <li class="pages"><a href="#" class="pages">2</a></li>
                <li class="pages"><a href="#" class="pages">3</a></li>
                <li class="pages"><a href="#" class="pages">4</a></li>
                <li class="pages"><a href="#" class="pages">5</a></li>
                <li class="pages"><a href="#" class="pages">6</a></li>
                <li class="pages"><a href="#" class="pages">7</a></li>
                <li class="pages"><a href="#" class="pages">8</a></li>
                <li class="pages"><a href="#" class="pages">9</a></li>
                <li class="pages"><a href="#" class="pages">10</a></li>
                <li class="pages"><a href="#" class="pages">></a></li>
            </ul>
        </footer>
    </body>
</php>
