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
        <!-- HEADER + LOGO + SEARCH-->
        <div class="navbar navbar-static-top">
            <div class="navbar-inner row" style="background:white;border:0px;">
                <!-- LOGO -->
                <div class="nav pull-left span3">
                    <a href="index.php?view=index">
                        <img class="topSpace" src='images/logo.png'>
                    </a>
                </div>
                <!-- SEARCH -->
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
                <!-- LOGIN -->
                <ul class="nav pull-right">
                    <?php
                    if (isset($_SESSION['user'])) {
                        ?>    
                        <li class="topSpace">
                            <a href="#" id="reg_sign">Hello, <?= $_SESSION['user'] ?></a>
                        </li>
                        <li class="topSpace">
                            <a href="index.php?view=logout" id="reg_sign">Logout</a>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li class="topSpace">
                            <!-- pour s'addresser à la fenetre modale, dans l'addr du lien -> id du div modal -->
                            <a href="#regModal" id="reg_sign" data-toggle="modal">
                                S'authentifier
                            </a>
                        </li>
                        <!-- MODAL LOGIN/REGISTRATION WINDOW HIDE-->
                        <form method="POST" action="index.php?view=login" accept-charset="UTF-8">
                            <?php if (!isset($_GET['login'])) { ?>
                                <div id="regModal" class="modal hide fade">
                                    <div class="modal-header">
                                        <button class="close" data-dismiss="modal">&times;</button>
                                        <h3> Authentification </h3>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" class="span4" placeholder="E-mail" name="login">
                                        <input type="password" class="span4" placeholder="Password" name="password">
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#" class="pull-left" id="login_newUser">New User</a>
                                        <button type="submit" name="submit" class="btn btn-success">Login</button>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <script>
                                    jQuery(document).ready(function($) {
                                        $('#regModal').modal();
                                    });
                                </script>
                                <div id="regModal" class="modal" >
                                    <div class="modal-header">
                                        <button class="close" data-dismiss="modal">&times;</button>
                                        <h3> Authentification </h3>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-error">
                                            <a class="close span4" href="#" data-dismiss="alert">x</a>Error! Wrong data..
                                        </div>
                                        <input type="text" class="span4" placeholder="E-mail" name="login"
                                               value="<?php if (isset($_GET['login'])) echo $_GET['login'] ?>">
                                        <input type="password" class="span4" placeholder="Password" name="password">
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#" class="pull-left" id="login_newUser">New User</a>
                                        <button type="submit" name="submit" class="btn btn-success">Login</button>
                                    </div>
                                </div>
                            <?php } ?>
                        </form>
                    <?php } ?>
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
                            $categories = get_categories($connection);
                            foreach ($categories as $row) {
                                ?>
                                <li><a href = "index.php?view=cat&id=<?= $row['cat_id'] ?>&page=1"><?= $row['name'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
                <!-- PANIER -->
                <a href="index.php?view=cart">
                    <div class="pull-right" id="cart_div">
                        <span id="cart_text">Panier (<?= $_SESSION['total_items'] ?>)  -  <?= number_format($_SESSION['total_price'], 2) ?> €</span>
                        <img src="images/basket.png" id="cart_img">
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

        <!-- FOOTER -->
        <hr>
        <div class="container">
            <p class="muted">Example courtesy <a href="#">Martin Bean</a> and <a href="#">Ryan Fait</a>.</p>
        </div>
    </body>
</html>
<?php
//fermer la connection
exit();
?>
