<?php
// Prevent direct access
\debug_backtrace() || die('No.');

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

// Santizes input value
function sanitize(&$input): void
{
    $input = \htmlspecialchars($input, ENT_QUOTES);
}

function sanitized($input): string //todo: Returns string?
{
 return \htmlspecialchars($input, ENT_QUOTES);
}