<?php
namespace Lbrs\Riot;
use GuzzleHttp\Client as Http;

/**
 * Riot API implementation.
 *
 * @version 1.0.0
 * @author  Loïc Brisset
 */
class Client
{
    const API_BASE_URI = 'https://euw1.api.riotgames.com';

    /**
     * @var Http
     */
    private $http;

    private $key;

    /**
     * Create a new client instance.
     *
     * @param string $apiKey.
     */
    public function __construct($apiKey)
    {
        $this->http = new Http([
            'base_uri' => self::API_BASE_URI,
            'headers' => [
                'Accept' => 'application/json',
            ]
        ]);

        $this->key = $apiKey;
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