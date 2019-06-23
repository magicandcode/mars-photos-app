<?php

namespace MarsPhotos\PhotoSearch\Api;

// Prevent direct access
use MarsPhotos\App;
use MarsPhotos\PhotoSearch\Form\CameraTrait;
use MarsPhotos\PhotoSearch\Form\MethodTrait;
use MarsPhotos\PhotoSearch\Form\SearchForm as Form;

\debug_backtrace() || die('No.');

if (!\class_exists('Query')) {
    class Query
    {
        use CameraTrait;

        private $baseUrl = 'https://api.nasa.gov/mars-photos/api/v1/rovers/curiosity/photos?OPTIONS_QUERY&api_key=DEMO_KEY';
        private $apiKey; // Use demo key by default
        private $defaultOptionsQuery = 'sol=0'; // Determined from API docs
        private $optionsQuery;
        private $url;
        private $camera;
        private $sol;

        private function __construct()
        {
            // Check if form has been submitted
            if (Form::allValuesSet()) {
                $this->setOptionsQuery();
                $this->set();
            }
        }

        public static function init(): Query
        {
            return new Query();
        }

        public function get(): string
        {
            return $this->url;
        }

        private function set(): void
        {
            $url = \str_replace(
                ['OPTIONS_QUERY'],//, 'DEMO_KEY'], // todo: set API key in request?
                [$this->optionsQuery],//, App::get('app.api.key')],
                $this->baseUrl
            );
            // todo: further validation/checks?
            $this->url = $url;
        }

        private function isValid(string $name): bool
        {
            \sanitize($name);

            // Validates each form field
            if ($name === 'sol') {
                return $this->validateSol();
            } elseif ($name === 'camera') {
                return $this->validateCamera();
            }

            return false;
        }

        private function validateSol(): bool
        {
            // Sol validations rules
            $sol = Form::getValue('sol'); // Input is sanitised

            if (
                \is_numeric($sol)
                && (\floor($sol) == $sol) // Converted to float; use ==
                && $sol >= 0
                && $sol <= Form::getMaxSol()
            ) {
                return true;
            }

            return false;
        }

        private function validateCamera(): bool
        {
            // Camera validations rules
            $camera = Form::getValue('camera'); // Input is sanitised

            // Only accept valid camera keys
            return \in_array(
                $camera, self::getValidCameraKeys()
            ) ? true : false;
        }

        private function setOptionsQuery(): void
        {
            // Checks if form is submitted
            if (Form::allValuesSet()) {
                // Gets form field names
                $fields = \array_keys(Form::getFields());
                $options = [];

                foreach ($fields as $name) {
                    if ($this->isValid($name)) {
                        $this->${'name'} = $name.'='.strtolower(
                            Form::getValue($name)
                        );
                    } else {
                        $this->${'name'} = '';
                    }

                    $options[] = $this->${'name'};
                }

                // Join options and separate by &
                $query = \implode(
                    '&', \array_filter($options)
                );

                $this->optionsQuery = $query ?: $this->defaultOptionsQuery;
            }
        }
    }
}