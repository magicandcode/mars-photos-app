<?php
// todo: DEBUG only!
ini_set("xdebug.var_display_max_children", -1);
ini_set("xdebug.var_display_max_data", -1);
ini_set("xdebug.var_display_max_depth", -1);

include_once 'bootstrap.php';
use MarsPhotos\App;
use MarsPhotos\PhotoSearch\Api\ManifestQuery;
use MarsPhotos\PhotoSearch\Form\SearchForm as Form;
use MarsPhotos\PhotoSearch\Api\SearchQuery;
use MarsPhotos\Views;

Views::registerViews(['welcome', 'search/form']);

// Form handling
if (Form::allValuesSet()) {
    // todo: Photos class accepting Query object
    // todo: Send response via POST

    // todo: Search and Manifest Request and Response classes?
    //$photos = SearchQuery::get()->response()->photos();
    //$manifest = ManifestQuery::get()->response()->manifest();
}

// Includes views
App::render();