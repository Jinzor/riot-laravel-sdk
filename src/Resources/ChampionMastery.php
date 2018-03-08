<?php

namespace Lbrs\Riot\Resources;

class ChampionMastery extends ApiResource
{
    const URI = '/lol/champion-mastery/v3/';

    protected $fields = [
        'playerId',
        'championId',
        'championLevel',
        'championPoints',
        'lastPlayTime',
        'championPointsSinceLastLevel',
        'championPointsUntilNextLevel',
        'chestGranted',
        'tokensEarned',
    ];

    /**
     * @param $summonerId
     * @param null $championId
     * @return \Illuminate\Support\Collection
     */
    public function getList($summonerId, $championId = null)
    {
        $endpoint = 'champion-masteries/by-summoner/' . $summonerId;

        if (!is_null($championId)) {
            $endpoint .= '/by-champion/' . $championId;
        }
        $response = $this->getSDK()->call('GET', self::URI . $endpoint);

        return $this->asCollection($response);
    }

    /**
     * @param $summonerId
     * @return int
     */
    public function getScore($summonerId)
    {
        return $this->getSDK()->call('GET', self::URI . 'scores/by-summoner/' . $summonerId);
    }
}