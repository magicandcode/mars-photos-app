<?php

namespace MarsPhotos;

// Prevent direct access
use MarsPhotos\PhotoSearch\Api\ManifestQuery;

\debug_backtrace() || die('No.');

if (!\class_exists('Rover')) {
    class Rover
    {
        private $manifest;
        private $name;
        private $totalPhotos;
        private $maxSol;
        private $landingDate;
        private $status;

        private function __construct()
        {
            // Sets manifest, API request
            $this->manifest = ManifestQuery::get()->response()->manifest();

            // Unsets photos property to reduce size
            unset($this->manifest->photos);

            $this->name = $this->manifest->name;
            $this->totalPhotos = $this->manifest->total_photos;
            $this->maxSol = $this->manifest->max_sol;

            // todo: Add getters if time
            $this->status = $this->manifest->status;
            $this->landingDate = $this->manifest->landing_date;
        }

        // Init once and bind to App container
        public static function get(): Rover
        {
            return new Rover();
        }

        public function name(): string
        {
            return $this->name;
        }

        public function totalPhotos(): int
        {
            return (int) $this->totalPhotos;
        }

        public function maxSol(): int
        {
            return (int) $this->maxSol;
        }

        public static function getCameras(): array
        {
            // Unable to get all cameras via ManifestQuery, needs a SearchQuery,
            // use static array for now
            // Cameras obtained from API response; probably won't change within
            //the near future...
            return [
                'FHAZ'      => 'Front Hazard Avoidance Camera',
                'MAST'      => 'Mast Camera',
                'CHEMCAM'   => 'Chemistry and Camera Complex',
                'MAHLI'     => 'Mars Hand Lens Imager',
                'MARDI'     => 'Mars Descent Imager',
                'RHAZ'      => 'Rear Hazard Avoidance Camera',
                'NAVCAM'    => 'Navigation Camera'
            ];
        }
    }
}