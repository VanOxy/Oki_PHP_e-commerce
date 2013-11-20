<?php

include ('db_functions.php');
include ('cart_fns.php');

session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
    $_SESSION['total_items'] = 0;
    $_SESSION['total_price'] = 0;
}

$view = empty($_GET['view']) ? 'index' : $_GET['view'];
switch ($view) {
    case('index'):
        //on recupere la liste de tous les produits
        $products = get_products_as_array();
        break;
    case('cat'):
        //on recupere les produits selon la categorie
        $products = get_cat($_GET['id']);
        break;
    case('product'):
        //on recupere le produit selon son id
        $product = get_product($_GET['id']);
        //recuperer la description et la separer
        $rows_desc = split(';', $product['desc']);
        //supprimer le dernier element qui apparait et qui est vide et qui crée un * vide
        //ma faute, qd j'ai rempli la bd --> pas envie de tt changer à la main
        $i = count($rows_desc) - 1;
        unset($rows_desc[$i]);
        break;
    case('cart'):
        // o_O
        break;
    case('add_to_cart'):
        //on n'appele pas une autre page!!!!!
        //on recupere l'id du l'elem, suite à l'appuie du brn "Ajouter au panier"
        //et grace à cet id on ajoute l'element dans le panier --> fct: add_to_cart()
        $id_prod = $_GET['id'];
        add_to_cart($id_prod);
        $_SESSION['total_items'] = total_items($_SESSION['cart']);
        //readresser la page là ou on a été. -->à retravailler pour les pages cat/index/prod + les num pages 
        header('Location: index.php?view=product&id=' . $id_prod);
        break;
    case('update_cart'):
        update_cart();
        $_SESSION['total_items'] = total_items($_SESSION['cart']);
        header('Location: index.php?view=cart');
        break;
}

$arr = array('index','cat', 'product','cart', 'add_to_cart', 'update_cart');
if(!in_array($view, $arr)) die ("ERROR 404<br>Cette adrese n'existe pas...!!! o_O");

//ici on charge la carcasse 
include ($_SERVER['DOCUMENT_ROOT'] . '/okiStore/views/layouts/main.php');
?>