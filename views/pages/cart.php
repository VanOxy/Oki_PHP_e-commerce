<br>
<div class="container">
    <?php
    if ($_SESSION['cart']) {
        ?>
        <form method="post" action="index.php?view=update_cart">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Article</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   /* var_dump($_SESSION);
                    print_r('<br>');
                    print_r('<br>');
                    var_dump($_SESSION['cart']);
                    */
                    //$_SESSION['cart'] --> tableau avec les id's des produits qui ont été ajoutés au panier
                    foreach ($_SESSION['cart'] as $id_prod => $quantity) {
                        //on recupere la ligne du produit concernée
                        $product = get_product_cart($id_prod,$connection);
                        ?>
                        <tr>
                            <td><?= $product['title'] ?> </td>
                            <td> <?= number_format($product['price'], 2) ?>  € </td>
                            <!--
                                remarque:
                                $product['price']   -> string
                                $id_prod            -> int
                                tt les deux la meme valeur
                            -->
                            <td><input type="text" name="<?= $product['id_prod'] ?>" value="<?= $quantity ?>"/></td>
                            <td><?= number_format($product['price'] * $quantity, 2) ?> €</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <div class="row">
                <!-- SUBMIT -->
                <div class="span1">
                    <input type='submit' value='Refresh' class="btn" id="cart_refresh">
                </div>
                <div class="span3">
                    <a href="index.php?view=clearCart" class="btn btn-danger" id="cart_clear">Vider la corbeille</a>
                </div>
                <div class="span2 offset6" id="cart_total_price_lbl">
                    <h4>Total : <?= number_format($_SESSION['total_price'], 2) ?> €</h3>
                </div>
            </div>
            <div class="row">
                <div class="span1 offset5">
                    <a href="index.php?view=order" class="btn btn-success" id="cart_commander">Commander</a>
                </div>
            </div>
        </form>
        <?php
    } else {
        ?>
        <div class="row">
            <h3>Votre panier est vide :(</h3>
        </div>
        <?php
    }
    ?>
</div>