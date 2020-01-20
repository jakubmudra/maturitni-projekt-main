<?php

class Product
{

    public $id;
    public $name;
    public $price;
    public $visible;
    public $position;
    public $description;

    function __construct($id, $name, $price, $position = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->position = $position;
        $this->visible = true;
    }

    public function getProductJSON()
    {
        $dataToReturn = ["id" => $this->id, "name" => $this->name, "price" => $this->price, "visible" => $this->visible, "position" => $this->position];
        return json_encode($dataToReturn);
    }
}
