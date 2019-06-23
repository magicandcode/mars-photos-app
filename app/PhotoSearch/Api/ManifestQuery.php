<?php

namespace MarsPhotos\PhotoSearch\Api;

// Prevent direct access
use MarsPhotos\App;
use MarsPhotos\PhotoSearch\Form\CameraTrait;
use MarsPhotos\PhotoSearch\Form\MethodTrait;
use MarsPhotos\PhotoSearch\Form\SearchForm as Form;

\debug_backtrace() || die('No.');

if (!\class_exists('ManifestQuery')) {
    class ManifestQuery extends Query
    {
        private $baseUrl = 'https://api.nasa.gov/mars-photos/api/v1/manifests/curiosity?api_key=DEMO_KEY';
        private $url;

        private function __construct()
        {
            // Sets url on instantiation
            $this->set();
        }

        public static function get()
        {
            return new ManifestQuery();
        }

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