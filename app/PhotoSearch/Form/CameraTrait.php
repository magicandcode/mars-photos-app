<?php

namespace MarsPhotos\PhotoSearch\Form;

use MarsPhotos\Rover;

// Prevent direct access
\debug_backtrace() || die('No.');

if (!\trait_exists('Form')) {
    trait CameraTrait
    {
        use MethodTrait;

        private static $cameraFieldName = 'camera';

        public static function getCameraOptions(): void
        {
            $cameras = self::getValidCameras();

            foreach ($cameras as $key => $name) {
                $selected =
                    self::getDefaultValue(
                        self::$cameraFieldName
                    ) === $key ? ' selected' : '';

                if (MethodTrait::methodIsSet()) {
                    if (MethodTrait::isValueSet(self::$cameraFieldName)) {
                        $selected = self::getValue(
                            self::$cameraFieldName
                        ) === $key ? ' selected' : '';
                    }
                }
            ?>
                <option value="<?=$key?>"<?=$selected?>><?=$name?></option>
            <?php }
        }

        public static function isValidCameraKey(string $key): bool
        {
            return \in_array($key, self::getValidCameraKeys());
        }

        private static function getValidCameraKeys(): array
        {
            $cameras = self::getValidCameras();
            $keys = \array_keys($cameras);

            return $keys;
        }

        private static function getValidCameraNames(): array
        {
            $cameras = self::getValidCameras();
            $names = \array_values($cameras);

            return $names;
        }

        private static function getValidCameras(): array
        {
            $cameras = Rover::getCameras();
            $cameras['any'] = _('Any Camera'); // Add custom "any" camera

            return $cameras;
        }
    }
}