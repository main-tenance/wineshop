<?php

namespace App\Services\DDD\Products\DTOs;

class AvgRatingDTO
{
    private float $score;
    private int $customersCount;

    public function __construct(
        float $score,
        int   $customersCount
    )
    {
        $this->score = $score;
        $this->customersCount = $customersCount;
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * @return int
     */
    public function getCustomersCount(): int
    {
        return $this->customersCount;
    }

}
