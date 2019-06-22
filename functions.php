<?php

function getAppPath(): string {
    return \pathinfo(
        __FILE__,
        PATHINFO_DIRNAME
    );
}

function dd($args): void
{
    die(
        var_dump(
            $args
        )
    );
}