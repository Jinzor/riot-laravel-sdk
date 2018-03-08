<?php

namespace Lbrs\Riot;

use GuzzleHttp\Client;
use Lbrs\Riot\Resources;

/**
 * Riot API implementation.
 *
 * @version 1.0.0
 * @author  Loïc Brisset
 */
class RiotSDK
{
    const API_BASE_URI = 'https://euw1.api.riotgames.com';

    /**
     * @var Client
     */
    protected $http;

    /**
     * @var string
     */
    private $key;

    /**
     * Create a new client instance.
     *
     * @param string $apiKey.
     */
    public function __construct($apiKey)
    {
        $this->key = $apiKey;

        $this->http = new Client([
            'base_uri' => self::API_BASE_URI,
            'headers' => [
                'Accept' => 'application/json',
                'X-Riot-Token' => $this->key,
            ]
        ]);
    }

    /**
     * Get a Summoner from his name.
     *
     * @param $name
     * @return Resources\Summoner
     */
    public function getSummoner($name)
    {
        return (new Resources\Summoner($this))->getFromName($name);
    }

    /**
     * Return the Champions list.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getChampions()
    {
        return (new Resources\Champion($this))->getList();
    }

    /**
     * Send a request to the API.
     *
     * @param  string $method The HTTP method.
     * @param  string $endpoint The endpoint.
     * @param  array $params The params to send with the request.
     * @return mixed The response as JSON.
     */
    public function call($method, $endpoint, array $params = null)
    {
        $options = [];
        if (!empty($params)) {
            $options['json'] = $params;
        }

        $response = $this->http->request($method, $endpoint, $options);
        return json_decode($response->getBody(), true);
    }
}