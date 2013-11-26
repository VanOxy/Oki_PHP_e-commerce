<br>
<div class="container">
    <div class="row">
        <div class="span1">
            <h3>Commander</h3>
        </div>
    </div>
    <?php
    if ($_SESSION['cart'] && !isset($_POST['order'])) {
        ?>
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
                //$_SESSION['cart'] --> tableau avec les id's des produits qui ont été ajoutés au panier
                foreach ($_SESSION['cart'] as $id_prod => $quantity) {
                    //on recupere la ligne du produit concernée
                    $product = get_product_cart($id_prod,$connection);
                    ?>
                    <tr>
                        <td><?= $product['title'] ?> </td>
                        <td> <?= number_format($product['price'], 2) ?>  € </td>
                        <td><?= $quantity ?></td>
                        <td><?= number_format($product['price'] * $quantity, 2) ?> €</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <div class="row">
            <div class="span2 offset10" id="cart_total_price_lbl">
                <h4>Total : <?= number_format($_SESSION['total_price'], 2) ?> €</h3>
            </div>
        </div>
        <hr>
        <form method="post" action="index.php?view=order">
            <table>
                <tr>
                    <td>Nom : </td>
                    <td> </td>
                    <td><input type="text" name="surname"></td>
                </tr>
                <tr>
                    <td>Prenom : </td>
                    <td> </td>
                    <td> <input type="text" name="name"></td>
                </tr>
                <tr>
                    <td>Adresse : </td>
                    <td> </td>
                    <td><input type="text" name="address"></td>
                </tr>
                <tr>
                    <td>Code postal : </td>
                    <td> </td>
                    <td><input type="text" name="post_index"></td>
                </tr>
                <tr>
                    <td>E-mail : </td>
                    <td> </td>
                    <td><input type="text" name="email"></td>
                </tr>
            </table>
            <br>
            <div class="row">
                <div class="span1">
                    <input type='submit' value='Commander' class="btn btn-danger" id="cart_commander">
                </div>
            </div>
        </form>
        <?php
    }
    if ($_SESSION['cart'] && isset($_POST['order'])) {
        foreach ($_POST as $arrKey => $arrStr) {
            $arrKey = $_POST[$arrKey];
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');

        foreach ($_SESSION['cart'] as $id_prod => $quantity) {
            $product = get_product_cart($id_prod,$connection);
        }
        ?>

        <?php
    }
    ?>
</div>