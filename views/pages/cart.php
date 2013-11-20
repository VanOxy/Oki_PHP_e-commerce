<br>
<div class="container">
    <form method='post' action='index.php?view=update_cart' >
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
                //*****************DEBUG************************
                print_r('session<br>');
                var_dump($_SESSION['cart']);
                print_r('<br>');
                print_r('post<br>');
                var_dump($_POST);
                //************************************************
                //$_SESSION['cart'] --> tableau avec les id's des produits qui ont été ajoutés au panier
                foreach ($_SESSION['cart'] as $id_prod => $quantity) {
                    //on recupere la ligne du produit concernée
                    $product = get_product($id_prod);
                    ?>
                    <tr>
                        <td><?= $product['title'] ?> </td>
                        <td> <?= number_format($product['price'], 2) ?>  € </td>
                        <td><input type="name" name="<?= $id_prod ?> " maxlength="2" value="<?= $quantity ?>"/></td>
                        <td><?= number_format($product['price'] * $quantity, 2) ?> €</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <div class="row">
             <div class="span1 offset8">
                <input type='submit' value='Refresh' class="btn btn-warning">
            </div>
            <div class="span2 offset1" id="cart_total_price_lbl">
                <h4>Total : <?=  number_format($_SESSION['total_price'],2) ?> €</h3>
            </div>
        </div>
    </form>
</div>