<?php

namespace Lbrs\Riot;
use GuzzleHttp\Client;

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
    private $http;

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
     * @return array|object
     */
    public function getSummoner($name)
    {
        return $this->call('GET', '/lol/summoner/v3/summoners/by-name/' . $name);
    }

    /**
     * Return the Champion list
     *
     * @return array|object
     */
    public function getChampions()
    {
        return $this->call('GET', '/lol/platform/v3/champions');
    }

    /**
     * Send a request to the API.
     *
     * @param  string $method The HTTP method.
     * @param  string $endpoint The endpoint.
     * @param  array $params The params to send with the request.
     * @return array|object The response as JSON.
     */
    private function call($method, $endpoint, array $params = null)
    {
        $options = [];
        if (!empty($params)) {
            $options['json'] = $params;
        }
        $response = $this->http->request($method, $endpoint, $options);
        return json_decode($response->getBody());
    }
}