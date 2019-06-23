<?php

namespace MarsPhotos;

// Prevent direct access
\debug_backtrace() || die('No.');

if (!\class_exists('App')) {
    class App
    {
        /**
         * Service container array
         * @var array
         */
        private static $container;

        /**
         * Renders registered views.
         * Registers Header and Foolter views if not already registered. These
         * are needed for the app to run at all.
         */
        public static function render(): void
        {
            // Register header and footer
            Views::registerHeader();
            Views::registerFooter();

            // Include views
            Views::includeAll();
        }

        /**
         * Gets bound value from the container.
         * Gets bound value from the container,
         * using a string of array keys delimited by a "."
         * for each level: 'key1.key2.key3' corresponds to
         * ['key1']['key2']['key3'].
         *
         * @param string $keyString
         * @return mixed
         * @throws \Exception
         */
        public static function get(string $keyString)
        {
            return self::getValue(
                self::getKeys($keyString)
            );
        }

        /**
         * Binds value into the container.
         * Binds value into the container,
         * using a string of array keys delimited by a "."
         * for each level: 'key1.key2.key3' corresponds to
         * ['key1']['key2']['key3'].
         *
         * @param string $keyString
         * @param mixed $value
         */
        public static function bind(string $keyString, $value)
        {
            self::setValue(
                self::getKeys($keyString),
                $value
            );
        }

        /**
         * Binds value into the container.
         * Binds value into the container,
         * using an array of keys.
         *
         * @param array $keys
         * @param mixed $value
         */
        private static function setValue(array $keys, $value): void
        {
            $container = &self::$container;

            while (\count($keys) > 0) {
                $key = \array_shift($keys);
                if (!\is_array($container)) {
                    $container = [];
                }
                $container = &$container[$key];
            }
            $container = $value;
        }

        /**
         * Gets an array of keys from a string delimited by a ".".
         *
         * @param string $keyString
         * @return array
         */
        private static function getKeys(string $keyString): array
        {
            return \explode('.', $keyString);
        }

        /**
         * Gets value from the container.
         * Gets value from the container,
         * using an array of array keys.
         *
         * @param array $keys
         * @param array|null $container
         * @return array|mixed|null
         * @throws \Exception
         */
        private static function getValue(array $keys, ?array $container = null)
        {
            $container = $container ?: self::$container;

            foreach ($keys as $key) {
                if (!\is_array($container[$key])) {
                    if (isset($container[$key])) {
                        return $container[$key];
                    } else {
                        throw new \Exception(
                            _("Unable to get value for key $key, key does not exist.")
                        );
                    }
                }
                $container = $container[$key];
                \array_shift($keys);
            }

            return $container;
        }
    }
}