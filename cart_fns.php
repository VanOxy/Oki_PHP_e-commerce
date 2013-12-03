<?php

function add_to_cart($id) {
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
}

function update_cart() {
    foreach ($_SESSION['cart'] as $id_prod => $qty) {
        if ($_POST[$id_prod] == '0') {
            unset($_SESSION['cart'][$id_prod]);
        } else {
            $_SESSION['cart'][$id_prod] = (int)$_POST[$id_prod];
        }
    }
}

function total_items($cart) {
    $num_items = 0;
    if (is_array($cart)) {
        foreach ($cart as $id => $qty) {
            $num_items += $qty;
        }
    }
    return $num_items;
}

function total_price($cart,$connection) {
    $total_price = 0.0;
    if (is_array($cart)) {
        foreach ($cart as $id => $qty) {
            try {
                $query = "SELECT price FROM products WHERE id_prod ='$id'";
                $result = $connection->query($query); //obj PDO
                $price = $result->fetch(PDO::FETCH_ASSOC);
                $price = $price['price'];
                $total_price += ($price * $qty);
            } catch (PDOException $ex) {
                echo $ex->getMessage();
                exit();
            }
        }
    }
    return $total_price;
}

?>
