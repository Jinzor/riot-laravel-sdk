<?php

namespace Lbrs\Riot\Resources;

use Illuminate\Support\Collection;
use Lbrs\Riot\RiotSDK;

class ApiResource
{
    protected $fields = [];
    private $lib;

    public function __construct(RiotSDK $lib)
    {
        $this->lib = $lib;
    }

    public function getSDK()
    {
        return $this->lib;
    }

    public function getId()
    {
        return $this->id;
    }

    public function format($data)
    {
        foreach ($data as $k => $v) {
            if (in_array($k, $this->fields)) {
                $this->{$k} = $v;
            }
        }

        return $this;
    }

    /**
     * @param $data
     * @return Collection
     */
    protected function asCollection($data)
    {
        $champions = new Collection();
        foreach($data as $obj) {
            $champions->push($this->format($obj));
        }
        return $champions;
    }
}