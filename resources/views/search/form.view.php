<?php
    // todo: Query class to keep track of input values
?>
    <form id="search-form">
        <input name="query_sol" type="number" min="0" max="<?=Rover::getMaxSol()?>" />
        <select name="query_camera">
            <?php // todo: Rover cameras method to generate camera options ?>
            <option value="any">Any Camera</option>
            <option value="mast">Mast Camera</option>
        </select>
        <button type="submit"><?=_('Find Photos')?></button>
    </form>