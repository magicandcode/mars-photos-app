<?php

namespace MarsPhotos\PhotoSearch\Api;

/**
 * Class Response represents the JSON string received on an API request.
 * It does NOT make an API call. The Response constructor accepts a JSON
 * string derived from the NASA Mars Rover Photos API.
 *
 * @package MarsPhotos\PhotoSearch\Api
 */
class Response
{
    /**
     * JSON response object
     * @var \stdClass
     */
    private $response;

    /**
     * Photos property of the JSON response object if SearchQuery
     * @var array
     */
    private $photos = [];

    /**
     * Manifest property of the JSON response object if ManifestQuery
     * @var array
     */
    private $manifest;

    /**
     * Response constructor.
     *
     * @param string $response JSON string
     * @throws \Exception
     */
    private function __construct(string $response)
    {
        $this->setResponse($response);

        if ($this->isApiResponse($this->response)) {

            if ($this->isQuery('SearchQuery')) {
                // Sets photos property
                $this->photos = $this->response->photos;

                // Sets default empty object, unable to set when declaring
                $this->manifest = new \stdClass();
            } elseif ($this->isQuery('ManifestQuery')) {
                // Sets manifest property
                $this->manifest = $this->response->photo_manifest;
            }
        }
    }

    /**
     * Static init
     * @param string $response
     * @return Response
     * @throws \Exception
     */
    public static function get(string $response): Response
    {
        return new Response($response);
    }

    /**
     * Gets photos array
     * @return array
     */
    public function photos(): array
    {
        return $this->photos;
    }

    /**
     * Gets manifest object
     * @return \stdClass
     */
    public function manifest(): \stdClass
    {
        return $this->manifest;
    }

    /**
     * Sets JSON string in the constructor.
     *
     * @param string $json
     * @throws \Exception
     */
    private function setResponse(string $json): void
    {
        $response = \json_decode($json);

        if ($this->isApiResponse($response)) {
            $this->response = $response;
        }else {
            throw new \Exception(_('Unable to decode JSON: invalid argument'));
        }
    }

    /**
     * Returns true if JSON object is derived from the Nasa Mars Rover Photos API.
     *
     * @param \stdClass $response
     * @return bool
     */
    private function isApiResponse(\stdClass $response): bool
    {
        if (isset($response->photos) || isset($response->photo_manifest)) {
            return true;
        }

        return false;
    }

    private function isQuery(string $className): bool
    {
        $response = $this->response;

        if ($className === 'SearchQuery' && isset($response->photos)) {
            return true;
        } elseif (
            $className === 'ManifestQuery' && isset($response->photo_manifest)
        ) {
            return true;
        }

        return false;
    }
}