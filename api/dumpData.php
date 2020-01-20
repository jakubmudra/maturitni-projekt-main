<?php

$products = [];
$positions = [ [1,1], [6,2], [1,3], [1,4], [2,3], [2,4], [2,5], [2,1], [1,5], [3,4], [5,4]];
for($i = 0; $i < 10; $i++)
{
    $products[] = new Product($i, "Product #" . $i, 35.90, $positions[$i]);
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
