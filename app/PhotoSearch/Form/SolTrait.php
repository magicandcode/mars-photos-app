<?php

namespace MarsPhotos\PhotoSearch\Form;

// Prevent direct access
\debug_backtrace() || die('No.');

if (!\trait_exists('Form')) {
    trait SolTrait
    {
        public static function getMaxSol(): int
        {
            // todo: Get max_sol from Rover
            return 10;
        }

        public static function isValidSol($sol): bool
        {
            return $sol >= 0 && $sol <= self::getMaxSol();
        }
    }
}