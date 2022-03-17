<?php

namespace App\Services\DDD\Products\VO;

class Price
{
    private float $amount;
    private string $currency;

    public function __construct(
        float  $amount,
        string $currency
    )
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }


}
