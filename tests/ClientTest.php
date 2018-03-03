<?php

use PHPUnit\Framework\TestCase;
use Lbrs\Riot\Client;

class ClientTest extends TestCase
{
    private $client;

    public function setUp()
    {
        $key = getenv('RIOT_KEY');
        $this->client = new Client($key);
    }

    public function testGetUser()
    {
        $summoner = $this->client->getSummoner('Ryuuketsü');
        $this->assertInternalType('object', $summoner);
    }
}