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
        $this->client = new RiotSDK('RGAPI-1c69db36-eca7-46f7-b0a0-5f21f03b5d5c');
        $this->assertInternalType('object', $this->client);
    }

	public function testGetSummoner()
    {
        $result = $this->client->getSummoner('Ryuuketsü');
        $this->assertInternalType('array', $result);
	    $this->assertArrayHasKey('name', $result);
    }

    public function testGetChampions()
    {
    	$response = $this->client->getChampions();
    	$this->assertArrayHasKey('champions', $response);
    	$result = $response['champions'];
    	$this->assertInternalType('array', $result);

    	foreach($result as $k => $v) {
			$this->assertInternalType('array', $v);
    		$this->assertArrayHasKey('id', $v);
    		exit;
    	}
    }
}