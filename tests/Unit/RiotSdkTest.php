<?php

namespace Lbrs\Riot\Test\Unit;

use PHPUnit\Framework\TestCase;
use Lbrs\Riot\RiotSDK;

class RiotSdkTest extends TestCase
{
	/**
     * This method is called before each test.
     */
    protected function setUp()
    {
        $this->client = new RiotSDK(env('RIOT_KEY'));
        $this->assertInternalType('object', $this->client);
    }

	public function testGetSummoner()
    {
        $result = $this->client->getSummoner('Ryuuketsü');
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertInternalType('object', $result);
        $data = json_decode($result->getBody(true), true);
	    $this->assertArrayHasKey('name', $data);
    }

	public function testGetChampions()
    {
        $result = $this->client->getChampions();
        $this->assertEquals(200, $result->getStatusCode());
        $this->assertInternalType('object', $result);
    }
}