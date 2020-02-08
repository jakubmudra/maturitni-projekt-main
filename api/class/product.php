<?php

class Product
{

    public $id;
    public $name;
    public $price;
    public $visible;
    public $position;
    public $color;
    public $description;

    function __construct($id, $name, $price, $p = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->position = ["x" => $p[0], "y" => $p[1]];
        $this->visible = true;
        $this->color = "blue";
    }

    public function getProductJSON()
    {
        $dataToReturn = ["id" => $this->id, "name" => $this->name, "price" => $this->price, "visible" => $this->visible, "position" => $this->p];
        return json_encode($dataToReturn);
    }
}
