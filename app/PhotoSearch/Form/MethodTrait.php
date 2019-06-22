<?php

namespace MarsPhotos\PhotoSearch\Form;

use MarsPhotos\PhotoSearch\Form\SearchForm as Form;

// Prevent direct access
\debug_backtrace() || die('No.');

if (!\trait_exists('MethodTrait')) {
    trait MethodTrait
    {
        /**
         * Returns either POST or GET value for $name key
         * @param string $name
         * @return mixed
         */
        public static function methodIsSet(): bool
        {
            if (Form::getMethod() === 'get') {
                return isset($_GET) && !empty($_GET);
            } elseif (Form::getMethod() === 'post') {
                return isset($_POST) && !empty($_POST);
            }

            return false;
        }

        /**
         * Returns either POST or GET value for $name key
         * @param string $name
         * @return mixed
         */
        private static function useMethod(string $name)
        {
            // Checks if $_GET or $_POST is set
            if (self::methodIsSet()) {
                if (Form::getMethod() === 'get') {
                    return $_GET[$name];
                } elseif (Form::getMethod() === 'post') {
                    return $_POST[$name];
                }
                // todo: throw Exception?
            }

            return ''; // Returns empty string which will "fail" as a set value
        }

        public static function allValuesSet(): bool
        {
            // Gets form field names
            $fields = \array_keys(self::$fields);

            foreach ($fields as $name) {
                if (self::isValueSet($name)) {
                    continue;
                } else {
                    return false;
                }
            }

            return true;
        }

        public static function isValueSet(string $name): bool
        {
            // Sanitizes input
            \out($name);
            $value = self::useMethod($name) !== null ? self::useMethod($name) : '';

            if (isset($value) && !empty($value)) {
                return true;
            } elseif (isset($value) && $name === 'sol' && ($value === '0' || $value === 0)) {
                // Handles special case where sol === 0
                return true;
            }

            return false;
        }

        public static function getMethod()
        {
            return self::$method;
        }
    }
}