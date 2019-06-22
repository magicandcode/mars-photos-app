<?php

namespace MarsPhotos\PhotoSearch\Form;

// Prevent direct access
\debug_backtrace() || die('No.');

if (!\class_exists('SearchForm')) {
    class SearchForm
    {
        use CameraTrait;
        use SolTrait;
        use MethodTrait;

        /**
         * Form method to use
         * @var string
         */
        private static $method = 'get';

        /**
         * Form field names and default values
         * @var array
         */
        private static $fields = [
            'sol' => 0,
            'camera' => 'any'
        ];

        public static function getFields(): array
        {
            return self::$fields;
        }

        public static function getValue(string $name)
        {
            // Checks if valid field name
            if (self::isValidFieldName($name)) {
                if (self::isValueSet($name)) {
                    return self::useMethod($name);
                }

                return self::$fields[$name]; // Returns default value
            }

            return ''; // Returns empty if invalid name
        }

        public static function getDefaultValue(string $name)
        {
            // Checks if valid field name
            if (self::isValidFieldName($name)) {
                return self::$fields[$name]; // Returns default value
            }

            return ''; // Returns empty if invalid name
        }

        private static function isValidFieldName(string $name): bool
        {
            // Sanitises input
            \out($name);

            // Gets field names
            $fields = \array_keys(self::$fields);

            foreach ($fields as $field) {
                if ($field === $name) {
                    return true;
                }
            }

            return false;
        }
    }
}