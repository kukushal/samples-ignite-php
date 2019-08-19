<?php

namespace Samples\Ignite\Php;

class Record
{
    public $id;
    public $price;
    public $quantity;

    public function __construct() {}

    public static function create(string $id, float $price, int $quantity): Record
    {
        $r = new Record();

        $r->id = $id;
        $r->price = $price;
        $r->quantity = $quantity;

        return $r;
    }

    public function __toString() {
        return '{id: \'' . $this->id . '\' price: ' . $this->price . ' quantity: ' . $this->quantity . '}';
    }
}