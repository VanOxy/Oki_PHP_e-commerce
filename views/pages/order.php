<br>
<div class="container">
    <?php
    if (isset($_SESSION['user'])) {
        //si on est logué...
        ?>
        <div class="row">
            <div class="span1">
                <h3>Commander</h3>
            </div>
        </div>
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
                    $product = get_product_cart($id_prod, $connection);
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
        <?php
        //***************** La config d'access au PayPal **********************
        require 'paypal.php';
        $paypal = new Paypal();

        $params = array(
            'RETURNURL' => 'http://localhost/okiStore/index.php?view=paypalSuccess',
            'CANCELURL' => 'http://localhost/okiStore/index.php?viewpaypalCancel',
            'PAYMENTREQUEST_0_AMT' => $_SESSION['total_price'],
            'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR'
        );
        //gérer plusieurs articles
        $i = 0;
        foreach ($_SESSION['cart'] as $id_prod => $quantity) {
            $product = get_product_cart($id_prod, $connection);

            $params["L_PAYMENTREQUEST_0_NAME$i"] = $product['title'];
            $params["L_PAYMENTREQUEST_0_DESC$i"] = '';
            $params["L_PAYMENTREQUEST_0_AMT$i"] = $product['price'];
            $params["L_PAYMENTREQUEST_0_QTY$i"] = $quantity;
            $i++;
        }
        $response = $paypal->request('SetExpressCheckout', $params);
        if ($response) {
            $paypal = "https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&useraction=commit&token="
                    . $response['TOKEN'];
        } else {
            var_dump($paypal->errors);
            die("Error!!!");
        }
        ?>
        <div class="row">
            <div class="span1">
                <a href="<?= $paypal ?>" class="btn btn-danger" id="cart_commander">Commander</a>
            </div>
        </div>
        <br>
        <div class="row alert alert-info span6 offset3">
            Vous allez poursuivre le payement avec votre compte PayPal.
        </div>
        <?php
    } else {
        //si on n'est pas logué
        ?>
        <div class="row">
            <div class="span8">
                <h3>Veuillez vous authoriser d'abord...</h3>
            </div>
        </div>
    <?php } ?>
</div>