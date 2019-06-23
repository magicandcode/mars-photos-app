<?php

namespace MarsPhotos\PhotoSearch\Api;

use MarsPhotos\App;

class Request
{
    /**
     * Query object from which to get url
     * @var Query
     */
    private $query;

    /**
     * Url to use when requesting API
     * @var string
     */
    private $url;

    /**
     * API response
     * @var string JSON string
     */
    private $response;

    /**
     * Request constructor, calls API on instantiation.
     *
     * @param Query $query
     * @throws \Exception
     */
    private function __construct(Query $query)
    {
        $this->query = $query;
        $this->setUrl();
        $this->setResponse(); // Todo: Make sure it's only requested once per submit
    }

    /**
     * Static construct wrapper to allow for chaining.
     *
     * @param string $email
     * @return Request
     * @throws \Exception
     */
    public static function get(Query $query): Request
    {
        return new Request($query);
    }

    /**
     * Sets Request url.
     *
     * @param string $email
     * @throws \Exception
     */
    private function setUrl(): void
    {
        $this->url = \str_replace(
            ['DEMO_KEY'], // Replace in url
            [App::get('api.key')], // Replace with
            $this->query->getUrl()
        );
    }

    /**
     * Sets Request JSON string response.
     *
     * @return void
     */
    private function setResponse(): void
    {
        $this->response = \file_get_contents($this->url); // API request
    }

    /**
     * Returns new Response instance with request response as argument.
     *
     * @return Response
     * @throws \Exception
     */
    public function response(): Response
    {
        return Response::get($this->response);
    }
}