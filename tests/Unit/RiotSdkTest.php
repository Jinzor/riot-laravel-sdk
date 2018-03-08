<?php

namespace Lbrs\Riot\Test\Unit;

use PHPUnit\Framework\TestCase;
use Lbrs\Riot\RiotSDK;

/**
 * @property RiotSDK client
 */
class RiotSdkTest extends TestCase
{
	/**
     * This method is called before each test.
     */
    protected function setUp()
    {
        $this->client = new RiotSDK('RGAPI-0af5ef62-ae48-4be6-8b23-ec68b2a30225');
        $this->assertInternalType('object', $this->client);
    }

	public function testGetSummoner()
    {
        $result = $this->client->getSummoner('Ryuuketsü');
        $this->assertInternalType('object', $result);
	    $this->assertObjectHasAttribute('name', $result);
    }

    public function testGetChampions()
    {
    	$result = $this->client->getChampions();
    	$this->assertInternalType('object', $result);

    	$first = $result->first();
		$this->assertInternalType('object', $first);
		$this->assertObjectHasAttribute('id', $first);
    }

    public function testGetChampionMasteries()
    {
        $results = $this->client->getSummoner('Ryuuketsü')->getChampionMasteries();

        $this->assertInternalType('object', $results);

        $first = $results->first();
        $this->assertInternalType('object', $first);
        $this->assertObjectHasAttribute('championId', $first);
    }

    public function testGetChampionMasteriesScore()
    {
        $result = $this->client->getSummoner('Ryuuketsü')->getChampionMasteriesScore();
        $this->assertInternalType('int', $result);
    }
}