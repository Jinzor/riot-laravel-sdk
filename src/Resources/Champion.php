<?php

namespace Lbrs\Riot\Resources;

use Illuminate\Support\Collection;

class Champion extends ApiResource
{
    const URI = '/lol/platform/v3/';

    protected $fields = [
        'id',
        'active',
        'botEnabled',
        'freeToPlay',
        'botMmEnabled',
        'rankedPlayEnabled',
    ];

    /**
     * @return Collection
     */
    public function getList()
    {
        $response = $this->getSDK()->call('GET', self::URI . 'champions');
        return $this->asCollection($response['champions']);
    }

}