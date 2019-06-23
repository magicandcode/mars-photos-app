<?php

namespace MarsPhotos\PhotoSearch\Form;

use MarsPhotos\App;

// Prevent direct access
\debug_backtrace() || die('No.');

if (!\trait_exists('Form')) {
    trait SolTrait
    {
        public static function getMaxSol(): int
        {
            return App::get('rover')->maxSol();
        }

        public static function isValidSol($sol): bool
        {
            return $sol >= 0 && $sol <= self::getMaxSol();
        }
    }
}