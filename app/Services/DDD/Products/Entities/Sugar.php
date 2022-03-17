<?php

namespace App\Services\DDD\Products\Entities;

class Sugar
{
    private int $id;
    private string $code;
    private string $name;

    public function __construct(
        int    $id,
        string $code,
        string $name
    )
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
