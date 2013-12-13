<!-- Middle block-->
<div class="container">

    <header>
        <h2> Nouveautés :  </h2>
    </header>

    <ul class="thumbnails">
        <?php
        //$products --> dans switch($view): case('index')
        //liste de tous le produits qu'il a dans la DB
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
                        <h5>Prix : € <?= number_format($row['price'], 2) ?></h5>
                    </div>
                    <!--BUTTONS-->
                    <div>
                        <!-- on envoie des info supplementaires dans le get pour gerer à la reception dans "add_to_cart" 
                        d'ou a été fait la demande pour en suite pouvoir rediriger vers cette meme page-->
                        <a href="index.php?view=add_to_cart&id=<?= $row['id_prod'] ?>&page=<?=$currentPage?>&location=index" class="btn btn-warning" id="thumbnail_btn">
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
                        <a href="<?php echo "index.php?page=$i" ?>">
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