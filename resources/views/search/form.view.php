<?php
    use MarsPhotos\PhotoSearch\Form\SearchForm as Form;
?>
    <section class="container search-form">
        <header class="header search-form">
            <h1><?=_('Search Photos')?></h1>
            <p><?=_('Search photos taken by the Mars rover Curiosity selecting sol (mission day) and camera.')?></p>
        </header>
        <form id="search-form" action="." method="<?=Form::getMethod()?>" class="pure-form pure-form-stacked">
            <fieldset>
                <label for="sol"><i class="far fa-sun"></i> <?=_('Sol')?></label>
                <input
                        name="sol"
                        value="0"
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