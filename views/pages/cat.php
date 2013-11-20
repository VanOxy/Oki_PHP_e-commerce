<!-- Middle block-->
<div class="container">

    <br>
    <ul class="thumbnails">
        <?php
        foreach ($products as $row) {
            ?>
            <li class="span4">
                <div class="thumbnail">
                    <img src="<?= $row['img'] ?>" id="thumbnail_img">
                    <br>
                    <div style="margin-left: 5px;">
                    <h4><?=$row['title']?></h4>
                    <h5>Prix : € <?=$row['price']?></h5>
                    </div>
                    <div>
                        <!--href="index.php?view=add_to_cart&id="--> <?/*=$row['id_prod']*/ ?>
                        <a href="#" class="btn btn-warning" style="margin-left:23px; background:#235E87;margin-bottom: 3px;">
                            Ajouter au panier
                        </a>
                        <a href="index.php?view=product&id=<?= $row['id_prod'] ?>" class="btn btn-warning" style="margin-left:35px; margin-bottom: 3px;">
                            Details
                        </a>
                    </div>
                </div>
            </li>
<?php } ?>
    </ul>

    <!-- pagination -->
    <div class="pagination pagination-centered">
        <ul>
            <li class="active">
                <a href="#"></a>
            </li>
            <li>
                <a href=""></a>
            </li>
        </ul>
    </div>
</div>