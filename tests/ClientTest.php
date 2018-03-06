<?php

namespace Lbrs\Riot\Test;

use PHPUnit\Framework\TestCase;
use Lbrs\Riot\RiotSDK;

class ClientTest extends TestCase
{
    private $client;

    public function setUp()
    {
        $key = getenv('RIOT_KEY');
        $this->client = new RiotSDK($key);
    }

    public function testGetUser()
    {
        $summoner = $this->client->getSummoner('Ryuuketsü');
        $this->assertInternalType('object', $summoner);
    }
}