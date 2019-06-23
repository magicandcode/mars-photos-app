<?php

namespace MarsPhotos\PhotoSearch\Form;

use MarsPhotos\App;
use MarsPhotos\Rover;

// Prevent direct access
\debug_backtrace() || die('No.');

if (!\trait_exists('SolTrait')) {
    trait SolTrait
    {
        public static function getMaxSol(): int
        {
            return (int) App::get('rover')->maxSol();
        }

        public static function isValidSol($sol): bool
        {
            if (
                \is_numeric($sol)
                && \floor($sol) == $sol
                && $sol >= 0
                && $sol <= self::getMaxSol()
            ) {
                return true;
            }

            return false;
        }
    }
}