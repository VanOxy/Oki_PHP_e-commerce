<!-- Middle block-->
<div class="container">
    <br>
    <ul class="thumbnails">
        <?php
        foreach ($products as $row) {
            ?>
            <li class="span4">
                <!--CARRE-->
                <div class="thumbnail">
                    <!--IMAGE-->
                    <img src="<?= $row['img'] ?>" id="thumbnail_img">
                    <br>
                    <div style="margin-left: 5px;">
                        <h4><?= $row['title'] ?></h4>
                        <h5>Prix : € <?= $row['price'] ?></h5>
                    </div>
                    <!--BUTTONS-->
                    <div>
                        <a href="index.php?view=add_to_cart&id=<?= $row['id_prod'] ?>&page=<?=$currentPage?>&location=cat&cat=<?=$row['categorie']?>" class="btn btn-warning" id="thumbnail_btn">
                            Ajouter au panier
                        </a>
                        <a href="index.php?view=product&id=<?= $row['id_prod'] ?>" class="btn btn-warning" id="thumbnail_btn_details">
                            Details
                        </a>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>

    <!-- PAGINATION -->
    <div class="pagination pagination-centered">
        <ul>
            <?php
            //on recupere la categorie dans laquelle on est
            $cat = $products[0]['categorie'];
            for ($i = 1; $i <= $nbrPages; $i++) {
                //faire le truc pour class="active"
                if ($i == $currentPage) {
                    ?>
                    <li class="active">
                        <a href="#"><?php echo $i ?></a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li>
                        <a href="<?php echo "index.php?page=$i&view=cat&id=$cat" ?>">
                            <?php echo $i ?>
                        </a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</div>