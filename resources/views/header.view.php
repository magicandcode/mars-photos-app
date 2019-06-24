<?php
    // Prevent direct access
    \debug_backtrace() || die('No.');

    use MarsPhotos\App;
?>
<!doctype html5>
<html>
<head>
    <meta charset="utf-8">
    <title><?=App::get('app.title')?></title>
    <link rel="icon" href="<?=App::get('dir.root')?>favicon.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/c81a335880.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css">
    <link rel="stylesheet" href="<?=App::get('dir.styles')?>main.css">
</head>
<body>
    <div class="main app">
        <h1 class="app"><?=_('Mars Rover Photos')?></h1>