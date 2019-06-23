<?php

namespace MarsPhotos;

// Prevent direct access
\debug_backtrace() || die('No.');

if (!\class_exists('Views')) {
    class Views
    {
        private static $views;
        private const HEADER = 'header';
        private const FOOTER = 'footer';
        private static $header = '';
        private static $footer = '';

        private static function includeView(string $view, bool $includeOnce = false): void
        {
            $path = self::getPath($view);
            if (!empty($path)) {
                if ($includeOnce) {
                    include_once $path;
                } else {
                    include $path;
                }
            }
        }

        public static function getPath(string $view): string
        {
            $path = \getAppPath().'/resources/views/'.$view.'.view.php';

            return \file_exists($path) ? $path : '';
        }

        // Used within App::render method
        public static function includeAll(): void
        {
            if (self::hasViews()) {
                $views = self::$views;

                foreach ($views as $view) {
                    $includeOnce = false;

                    if (self::HEADER === $view || self::FOOTER === $view) {
                        $includeOnce = true;
                    }

                    self::includeView($view, $includeOnce);
                }
            }
        }

        public static function registerViews(array $viewsToRegister): void
        {
            $views = &self::$views;

            if (!\is_array($views)) {
                $views = [];
            }

            foreach ($viewsToRegister as $view) {
                // Only register valid views
                if (\file_exists(self::getPath($view))) {
                    $views[] = $view;
                }
            }

            // Make sure that header is the first view and footer the last
            if (self::hasHeader()) {
                self::positionHeader();
            }

            if (self::hasFooter()) {
                self::positionFooter();
            }
        }

        public static function registerHeader(): void
        {
            if (!self::hasHeader()) {
                if (!empty(self::getPath(self::HEADER))) {
                    self::registerViews([self::HEADER]);
                    self::$header = self::HEADER;
                    // Move to beginning of array
                    self::positionHeader();
                }
            }
        }

        public static function registerFooter(): void
        {
            if (!self::hasFooter()) {
                if (!empty(self::getPath(self::FOOTER))) {
                    self::registerViews([self::FOOTER]);
                    self::$footer = self::FOOTER;
                    // Move to end of array
                    self::positionFooter(); // Todo: move to registerViews
                }
            }
        }

        private static function positionHeader(): void
        {
            if (self::hasHeader()) {
                $views = &self::$views;

                if ($views[0] !== self::HEADER) {
                    // Move header to the beginning
                    // Find header index
                    $index = \array_search(self::HEADER, $views);
                    unset($views[$index]); // Remove from wrong position
                    \array_unshift($views, self::HEADER); // Add to beginning
                    \array_values($views); // Reset indexes
                }
                // Header is in the beginning
            }
        }

        private static function positionFooter(): void
        {
            if (self::hasFooter()) {
                $views = &self::$views;
                $size = \count($views);

                if ($views[$size -1] !== self::FOOTER) {
                    // Move header to the beginning
                    // Find footer index
                    $index = \array_search(self::FOOTER, $views);
                    unset($views[$index]); // Remove from wrong position
                    \array_unshift($views, self::FOOTER); // Add to beginning
                    \array_values($views); // Reset indexes
                }
                // Footer is in the end
            }
        }

        public static function unregisterViews(array $viewsToUnregister): bool
        {
            $views = &self::$views;

            if (\is_array($views)) {
                if (\count($viewsToUnregister) > 0) {
                    foreach ($viewsToUnregister as $view) {
                        // Prevent unregistering header or footer
                        if (self::HEADER !== $view && self::FOOTER !== $view) {

                            if (\in_array($view, self::$views)) {
                                $key = \array_search($view, self::$views);
                                unset(self::$views[$key]);
                            }
                        }
                        return true;
                    }

                    self::positionHeader();
                    self::positionFooter();
                } else {
                    return false;
                }
            }

            return false;
        }

        public static function getViews(): array
        {
            return self::$views ?: [];
        }

        public static function hasViews(): bool
        {
            return empty(self::$views) ? false : true;
        }

        public static function hasHeader(): bool
        {
            // Check if header is set
            if (!empty(self::$header)) {
                // Return true if valid view
                return !empty(self::getPath(self::$header));
            }

            return false;
        }

        public static function hasFooter(): bool
        {
            // Check if header is set
            if (!empty(self::$footer)) {
                // Return true if valid view
                return !empty(self::getPath(self::$footer));
            }

            return false;
        }
    }
}