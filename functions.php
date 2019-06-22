<?php

function getAppPath(): string {
    return \pathinfo(
        __FILE__,
        PATHINFO_DIRNAME
    );
}

function dd($args): void
{
    $args = func_get_args($args); // Gets array with arguments

    die(
        var_dump(...$args)
    );
}