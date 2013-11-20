<!DOCTYPE html>
<html>
    <!-- head -->
    <head>
        <meta charset="utf-8">
        <title>OkiStore</title>
        <!-- Include Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/myCss.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>

    <body>
        <!-- header with search-->
        <div class="navbar navbar-static-top">
            <div class="navbar-inner row" style="background:white;border:0px;">
                <!-- LOGO -->
                <div class="nav pull-left span3">
                    <a href="index.php?view=index">
                        <img class="topSpace" src='images/logo.png'>
                    </a>
                </div>
                <div class="span8 offset2">
                    <form class="navbar-search" action="/search">
                        <div class="input-append" style="margin-top:10px">
                            <input class="span7" type="text"  placeholder="Search...">
                            <button type="submit" class="btn" style="background:#235E87;border-radius:0px;">
                                <font color="white" style="text-shadow:0 0 0;">Search</font>
                            </button>
                        </div>
                    </form>
                </div>
                <ul class="nav pull-right">
                    <li class="topSpace"><a href="#" id="reg_sign">Register</a></li>
                    <li class="topSpace"><a href="sign.php" id="reg_sign">Sign In</a></li>
                </ul>
            </div>
        </div>

        <!-- NAVIGATION -->
        <div class ="navbar navbar-static-top navbar-inverse">
            <div class="navbar-inner"> 
                <div class="container">
                    <nav class="row">
                        <ul class="nav nav-pills" id="nav">
                            <?php
                            $categories = get_categories();
                            foreach ($categories as $row) {
                                ?>
                                <li><a href = "index.php?view=cat&id=<?= $row['cat_id'] ?>"><?= $row['name'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
                <!-- PANIER -->
                <a href="index.php?view=cart">
                    <div class="pull-right" id="cart_div">
                        <span id="cart_text">Panier (<?= $_SESSION['total_items'] ?>)  -  <?= number_format($_SESSION['total_price'],2)?> €</span>
                        <img src="images/basket2.png" id="cart_img">
                    </div>
                </a>
            </div>
        </div>

        <?php
        // afficher le contenu shouaité en fonction de ce qui a été choisi par l'utilisateur
        // ceci donne un aspect modulaire 
        // càd la carcasse reste tjs la meme, et on ne charge que le "body" --> les modules
        // comme les cartridges :)))
        //contenu dans $view = $_GET['view'], voir index.php(ln13)
        include ($_SERVER['DOCUMENT_ROOT'] . '/okiStore/views/pages/' . $view . '.php');
        ?>

        <!-- footer -->
        <hr>
        <div class="container">
            <p class="muted">Example courtesy <a href="#">Martin Bean</a> and <a href="#">Ryan Fait</a>.</p>
        </div>
    </body>
</html>
<?php
exit();
?>
