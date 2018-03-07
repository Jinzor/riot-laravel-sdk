<?php

namespace Lbrs\Riot\Test\Unit;

use PHPUnit\Framework\TestCase;
use Lbrs\Riot\RiotSDK;

class RiotSdkTest extends TestCase
{
	public function test_sdk_init()
	{
        $this->client = new RiotSDK(get_env('RIOT_KEY'));
	}

	public function testGetUser()
    {
        $summoner = $this->client->getSummoner('Ryuuketsü');
        $this->assertInternalType('object', $summoner);
    }
}