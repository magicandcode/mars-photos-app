<?php
?>
    <section class="error">
        <h2><?=_('Oops! Something went wrong!')?></h2>
        <p>Unable to get photos from search options:</p>
        <ul>
            <li>Sol: <?=sanitized(isset($_GET['sol'])) && !empty(sanitized($_GET['sol'])) ? sanitized($_GET['sol']) : _('no value') ?></li>
            <li>Camera: <?=sanitized(isset($_GET['camera'])) && !empty(sanitized($_GET['camera'])) ? sanitized($_GET['camera']) : _('no value') ?></li>
        </ul>
    </section>