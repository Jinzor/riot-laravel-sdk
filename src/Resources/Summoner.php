<?php

namespace Lbrs\Riot\Resources;

class Summoner extends ApiResource
{
    const URI = '/lol/summoner/v3/summoners/';

    protected $fields = [
        'id',
        'accountId',
        'name',
        'profileIconId',
        'revisionDate',
        'summonerLevel',
    ];

    public function getFromId($id)
    {
        $response = $this->getSDK()->call('GET', self::URI . 'by-account/' . $id);
        return $this->format($response);
    }

    public function getFromName($name)
    {
        $response = $this->getSDK()->call('GET', self::URI . 'by-name/' . $name);
        return $this->format($response);
    }

    public function getChampionMasteries($championId = null)
    {
        return (new ChampionMastery($this->getSDK()))->getList($this->getId(), $championId);
    }

    public function getChampionMasteriesScore() {
        return (new ChampionMastery($this->getSDK()))->getScore($this->getId());
    }
}