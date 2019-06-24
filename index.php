<?php

include_once 'bootstrap.php';
use MarsPhotos\App;
use MarsPhotos\PhotoSearch\Form\SearchForm as Form;
use MarsPhotos\PhotoSearch\Api\SearchQuery;
use MarsPhotos\Views;

Views::registerViews(['welcome', 'search/form']);

// Form handling
if (Form::allValuesSet() && \sanitized(isset($_GET['photos'])) && \sanitized($_GET['photos']) === 'find') {
    // todo: Photos class accepting stdClass response
    // todo: Search and Manifest Request and Response classes?

    $photos = SearchQuery::get()->response()->photos();
    $_POST['photos'] = $photos;
    Views::registerViews(['photos/photos.index']);
} elseif (\sanitized(isset($_GET['photos'])) && \sanitized($_GET['photos']) === 'find') {
    Views::registerViews(['error']);
}

// Includes views
App::render();