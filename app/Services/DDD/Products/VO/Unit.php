<?php

namespace App\Services\DDD\Products\VO;

class Unit
{
    private int $volume;
    private string $package;

    public function __construct(
        int    $volume,
        string $package
    )
    {
        $this->volume = $volume;
        $this->package = $package;
    }

    /**
     * @return int
     */
    public function getVolume(): int
    {
        return $this->volume;
    }

    /**
     * @return string
     */
    public function getPackage(): string
    {
        return $this->package;
    }

}
