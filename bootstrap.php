<?php
// Functions lib
include_once 'functions.php';

// Autoloader
use MarsPhotos\App;
use MarsPhotos\Rover;

include_once 'vendor/autoload.php';

// App Container
App::bind('config', include_once 'config.php');
App::bind('app', App::get('config')['app']);
App::bind('api', App::get('config')['api']);
// todo: set paths relative to root
App::bind('dir.scripts', '../resources/js/');
App::bind('dir.styles', '../resources/css/');
App::bind('dir.root', './');

// Init Rover
$rover = Rover::get();
App::bind('rover', $rover);