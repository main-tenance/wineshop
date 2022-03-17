<?php

namespace App\Services\DDD\Products\VO;

use App\Services\DDD\Products\Entities\Vine;

class VineLine
{
    private Vine $vine;
    private float $percent;

    public function __construct(
        Vine  $vine,
        float $percent
    )
    {
        $this->vine = $vine;
        $this->percent = $percent;
    }

    /**
     * @return Vine
     */
    public function getVine(): Vine
    {
        return $this->vine;
    }

    /**
     * @return float
     */
    public function getPercent(): float
    {
        return $this->percent;
    }
}
