<?php

namespace MarsPhotos\PhotoSearch\Api;

// Prevent direct access
\debug_backtrace() || die('No.');

if (!\class_exists('Query')) {
    abstract class Query
    {
        private $baseUrl = '';
        private $url;

        public function getUrl(): string
        {
            return $this->url;
        }

        private function set(): void
        {
            $this->url = $this->baseUrl;
        }

        private function request(): Request
        {
            return Request::get($this);
        }

        public function response(): Response
        {
            return $this->request()->response();
        }
    }
}