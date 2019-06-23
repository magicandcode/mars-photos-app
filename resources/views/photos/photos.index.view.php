<?php

use MarsPhotos\App;
        $photos = isset($_POST['photos']) ? $_POST['photos'] : [];
        $photosCount = \count($photos);
?>
    <section class="photos">
        <h2><?=_("Found <mark>$photosCount</mark> Photos")?></h2>
    <?php
        if ($photosCount > 0) { ?>
            <ul>
            <?php
            foreach ($photos as $index => $photo) {
                ?>
                <li class="photo">
                    <a href="<?=$photo->img_src?>" target="_blank"><img src="<?=$photo->img_src?>" id="photo-<?=$photo->id?>"></a>
                    <p><i class="far fa-calendar"></i> <?=$photo->earth_date?></p>
                    <p><i class="fas fa-camera"></i> <?=$photo->camera->name?></p>
                </li>
                <?php
                if ($index >= 9) {
                    break;
                }
            }?>
            </ul>
            <?php
        } else {
            ?>
            <p><?=_('No photos with the specified search criteria could be found.')?></p>
        <?php
        }
    ?>
    </section>