<?php

namespace App\Services\DDD\Products;

use App\Services\DDD\Products\Entities\Sugar;
use App\Services\DDD\Products\Entities\Wine;
use App\Services\DDD\Products\VO\Age;
use App\Services\DDD\Products\VO\Composition;
use App\Services\DDD\Products\VO\Price;
use App\Services\DDD\Products\VO\Unit;
use App\Services\DDD\Products\VO\VineLine;

class Product
{
    private int $id;
    private string $code;
    private string $name;
    private string $description;
    private Age $age;
    private Price $price;
    private Unit $unit;
    private Sugar $sugar;
    private Composition $composition;
    private Wine $wine;

    public function __construct(
        int         $id,
        string      $code,
        string      $name,
        string      $description,
        Age         $age,
        Price       $price,
        Unit        $unit,
        Sugar       $sugar,
        Composition $composition,
        Wine        $wine
    )
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->description = $description;
        $this->age = $age;
        $this->price = $price;
        $this->unit = $unit;
        $this->sugar = $sugar;
        $this->composition = $composition;
        $this->wine = $wine;
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

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return Age
     */
    public function getAge(): Age
    {
        return $this->age;
    }

    /**
     * @return Price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }

    /**
     * @return Unit
     */
    public function getUnit(): Unit
    {
        return $this->unit;
    }

    /**
     * @return Sugar
     */
    public function getSugar(): Sugar
    {
        return $this->sugar;
    }

    /**
     * @return Composition
     */
    public function getComposition(): Composition
    {
        return $this->composition;
    }

    /**
     * @return Wine
     */
    public function getWine(): Wine
    {
        return $this->wine;
    }

    public function addVineLine(Product $product, VineLine $vineLine)
    {
        $product->composition->addVineline($vineLine);
    }
}
