<div class="container">
    <br>
    <div class="row">
        <!--entete-->
        <div class="page-header">
            <h3 class="text-info"><?= $product['title'] ?></h3>
        </div>
        <!--l'image-->
        <div class="span4">
            <img src="<?= $product['img'] ?>" style="height: 180;">
        </div>
        <!--descriptions-->
        <div class="span8">
            <ul>
                <?php
                foreach ($rows_desc as $row) {
                    ?>
                    <li><?= $row ?></li>
                <?php } ?>
            </ul>
            <br>
            <!--prix-->
            <div>
                <h5>Prix : <?= number_format($product['price'], 2) ?> €</h5>
            </div>
        </div>
    </div>
    <!--btn add-->
    <div class="row">
        <div class="offset9">
            <a href="index.php?view=add_to_cart&id=<?= $product['id_prod'] ?>" class="btn btn-danger"  style="background:#235E87">
                Ajouter au panier
            </a>
        </div>
    </div>
</div>