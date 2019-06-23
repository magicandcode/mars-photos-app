<?php
// todo: DEBUG only!
ini_set("xdebug.var_display_max_children", -1);
ini_set("xdebug.var_display_max_data", -1);
ini_set("xdebug.var_display_max_depth", -1);

include_once 'bootstrap.php';
use MarsPhotos\App;
use MarsPhotos\PhotoSearch\Form\SearchForm as Form;
use MarsPhotos\PhotoSearch\Api\SearchQuery;
use MarsPhotos\Views;

Views::registerViews(['welcome', 'search/form']);

// Form handling
if (Form::allValuesSet() && isset($_GET['photos']) && empty($_GET['photos'])) {

    //dd(SearchQuery::get());
    // todo: Photos class accepting stdClass response

    // todo: Search and Manifest Request and Response classes?
    //$manifest = ManifestQuery::get()->response()->manifest();
    $photos = SearchQuery::get()->response()->photos();
    $_POST['photos'] = $photos;
    Views::registerViews(['photos/photos.index']);
} elseif (isset($_GET['photos']) && empty($_GET['photos'])) {
    Views::registerViews(['error']);
}

// Includes views
App::render();