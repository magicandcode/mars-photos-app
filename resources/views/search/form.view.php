<?php

use MarsPhotos\App;
use MarsPhotos\PhotoSearch\Form\SearchForm as Form;

    $rover = App::get('rover');
?>
    <section class="container search-form">
        <header class="header search-form">
            <h1><?=_('Search Photos')?></h1>
            <p><?=_(
                    "Search among {$rover->totalPhotos()} photos taken by the Mars rover {$rover->name()}.
                    Select a sol (mission day) between 0 and {$rover->maxSol()} and specify a camera if you wish."
            )?></p>
        </header>
        <form id="search-form" action="." method="<?=Form::getMethod()?>" class="pure-form pure-form-stacked">
            <fieldset>
                <input name="photos" type="hidden" value="find">
                <label for="sol"><i class="far fa-sun"></i> <?=_('Sol')?></label>
                <input
                        name="sol"
                        value="<?=Form::getValue('sol')?>"
                        type="number"
                        min="0"
                        max="<?=Form::getMaxSol()?>"
                        id="sol"
                />
                <label for="camera"><i class="fas fa-camera"></i> <?=_('Camera')?></label>
                <select name="camera" id="camera">
                    <?php
                        Form::getCameraOptions();
                    ?>
                </select>

                <button type="submit" class="pure-button"><i class="fas fa-search"></i> <?=_('Find Photos')?></button>
            </fieldset>
        </form>
    </section>