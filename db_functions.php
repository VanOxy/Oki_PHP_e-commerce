<?php

function db_connect() {
    //connection à la base de données
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'e-commerce';

    try {
        $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        //repmettre la gestion d'exeption
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOExeption $e) {
        echo 'Erreur de connecion!!! : ' . $e->getMessage() . '<br>';
        exit();
    }
    return $connection;
}

function get_products_as_array() {
    // selectionner tt les produits de la bd produits
    // et retourner sous la forme d'un tableau
    $connection = db_connect();
    $query = 'SELECT id_prod, title, price, img FROM products';
    try {
        $result = $connection->query($query); //obj PDO
        $res_array = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res_array;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        exit();
    }
}

function get_cat($cat) {
    // on recupere la categoie qui a été selectioné dans la barre de navigation par l'utilisateur
    $connection = db_connect();
    $query = "SELECT id_prod, title, price, img FROM products WHERE categorie='$cat'";
    try {
        $result = $connection->query($query); //obj PDO
        $res_array = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res_array;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        exit();
    }
}

function get_categories() {
    //on selectionne les categories de la base de données pour crées la navigation
    $connection = db_connect();
    $query = 'SELECT * FROM categories';
    try {
        $result = $connection->query($query); //obj PDO
        $res_array = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res_array;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        exit();
    }
}

function get_product($id_prod) {
    $connection = db_connect();
    $query = "SELECT * FROM products WHERE id_prod = '$id_prod'";
    try {
        $result = $connection->query($query);
        $row = $result->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        exit();
    }
    return $row;
}
?>
