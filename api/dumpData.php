<?php

$products = [];
$positions = [ 1 => [1,1], [1,2], [1,3], [1,4], [1,5], [2,1], [2,2], [2,3], [2,4], [2,5], [3,1], [3,2], [3,3], [3,4], [3,5], [4,1], [4,2], [4,3], [4,4], [4,5], [5,1], [5,2], [5,3], [5,4], [5,5], [6,1]];
for($i = 1; $i <= 15; $i++)
{
    $id = array_rand($positions);
    $products[] = new Product($i, "Product #" . $i, 35.90, $positions[$id]);
    unset($positions[$id]);
}

foreach ($products as $product)
{
 //  echo sprintf("Product # %d named %s cost %s <br>", $product->id, $product->name, Formater::formatPrice($product->price));
    //echo $product->getProductJSON();
}


$userM = new User();
$userM->add(1,"Jakub Mudra", "me@jakubmudra.cz", "admin", "Heslo123..");


function searchForPosition($id, $array) {
    foreach ($array as $key => $val) {
        if ($val->position === $id) {
            return $key;
        }
    }
    return false;
}
