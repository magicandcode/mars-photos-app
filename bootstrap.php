<?php
// Functions lib
include_once 'functions.php';

// Autoloader
use MarsPhotos\App;
include_once 'vendor/autoload.php';

// App Container
App::bind('app', include_once 'config.php');
App::bind('dir.scripts', __DIR__.'/resources/js/');