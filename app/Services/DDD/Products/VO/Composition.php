<?php

namespace App\Services\DDD\Products\VO;

class Composition
{
    private array $vineLines;

    public function addVineline(VineLine $vineLine)
    {
        $this->vineLines[] = $vineLine;
    }

    /**
     * @return array
     */
    public function getVineLines(): array
    {
        return $this->vineLines;
    }
}
