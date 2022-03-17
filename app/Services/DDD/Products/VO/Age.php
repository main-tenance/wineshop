<?php

namespace App\Services\DDD\Products\VO;

use App\Services\DDD\ValueObject;

class Age
{
    private int $year;
    private int $holding;

    public function __construct(
        int $year,
        int $holding
    )
    {
        $this->year = $year;
        $this->holding = $holding;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getHolding()
    {
        return $this->holding;
    }

}
