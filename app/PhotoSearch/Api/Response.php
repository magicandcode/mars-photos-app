<?php

namespace MarsPhotos\PhotoSearch\Api;

use MarsPhotos\App;

/**
 * Class Response represents the JSON string received on an API request.
 * It does NOT make an API call. The Response constructor accepts a JSON
 * string derived from the DeBounce API.
 *
 * @package MarsPhotos\PhotoSearch\Api
 */
class Response
{
    /**
     * Request url
     * @var string
     */
    private $url;

    /**
     * Photos property of the JSON response object
     * @var array
     */
    private $photos;

    /**
     * JSON response object
     * @var \stdClass
     */
    private $response;

    /**
     * Response constructor.
     *
     * @param string $json JSON string
     * @throws \Exception
     */
    private function __construct(string $response)
    {
        $this->setResponse($response);

        if (self::isApiResponse($this->response)) {
            //$this->data = $this->response->data;
            $this->photos = $this->response->photos;
        }

        /*


        $this->setJson($response);
        $this->success = (int) $this->response->success;
        $this->balance = isset($this->response->balance) ?
            (int) $this->response->balance : 0;

        // Sets properties from response JSON object if API request is 1
        if ($this->success === 1) {
            $this->balance = (int) $this->response->balance;
            $this->email = $this->response->debounce->email;
            $this->code = (int) $this->response->debounce->code;
            $this->role = $this->response->debounce->role === 'true' ?
                true : false; // Casts to boolean
            $this->freeEmail = $this->response->debounce->free_email === 'true' ?
                true : false; // Casts to boolean
            $this->result = $this->response->debounce->result;
            $this->reason = $this->response->debounce->reason;
            $this->sendTransactional =
                (int) $this->response->debounce->send_transactional;
        } else {

            if ($this->balance < 1) {
                throw new \Exception(_(
                    'Du har slut på krediter, kan inte komma åt anropad data.'
                )); // Todo: Prefilter invalid e-mails
            } else {
                throw new \Exception(_(
                    'Kan inte komma åt anropad data, kontrollera din API-nyckel
                    och försök igen.'
                ));
            }
        }
*/
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
     * @return \stdClass
     */
    public function photos(): array
    {
        return $this->response->photos;
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

        if (self::isApiResponse($response)) {
            $this->response = $response;
        } else {
            //throw new \Exception(_('Unable to decode JSON: invalid argument'));
        }

    }

    /**
     * Returns true if JSON object is derived from the Nasa MArs Rover Photos API.
     *
     * @param \stdClass $response
     * @return bool
     */
    private static function isApiResponse(\stdClass $response): bool
    {
        return isset($response->photos) ? true : false;
    }
}