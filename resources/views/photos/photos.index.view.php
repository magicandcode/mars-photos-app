<?php
    // Prevent direct access
    \debug_backtrace() || die('No.');

    $photos = isset($_POST['photos']) ? $_POST['photos'] : [];
    $photosCount = \count($photos);

    // Prepare for pagination
    $pageNum = 1;
    $photosPerPage = $photosCount; // Show all... todo: pagination!
    $max = ($photosPerPage * $pageNum) - 1;
    $min = $max - $photosPerPage + 1;
?>
    <section class="photos">
        <h2><?=_("Found <mark>$photosCount</mark> Photos")?></h2>
    <?php
        if ($photosCount > 0) {
            // No pagination =(
            ?>
            <ul>
            <?php
            foreach ($photos as $index => $photo) {
                if ($index > $max) {
                    break;
                }
                ?>

                <li class="photo">
                    <a
                        href="<?=$photo->img_src?>"
                        target="_blank"
                    ><img
                        src="<?=$photo->img_src?>"
                        alt="<?=_("Photo {$photo->id} on mission day {$photo->sol}")?>"
                        id="photo-<?=$photo->id?>"
                        ></a>
                    <p><i class="far fa-calendar"></i> <?=$photo->earth_date?></p>
                    <p><i class="fas fa-camera"></i> <?=$photo->camera->name?></p>
                </li>
                <?php
                if ($index < $min) {
                    break;
                }
            }
            ?>
            </ul>
            <?php
// todo: Some kind of pagination or choice to view all photos
            if ($photosCount > $photosPerPage) {
                $remainingPhotos = $photosCount - $photosPerPage;
                ?>
                <p><?=_("Found <mark>{$remainingPhotos}</mark> more photos...")?></p>
                <?php
            }

        } else {
            ?>
            <p><?=_('No photos with the specified search criteria could be found.')?></p>
        <?php
        }
    ?>
    </section>