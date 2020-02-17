<?php


namespace App\models;


class Transanction
{
    public function getTransaction(int $id = null)
    {
        // If is id null, return false
        if ($id === null)
            return false;

        $transaction = $this->getSingle($id);

        if ( count($transaction) == 0)
            return false;

        return $transaction;

    }

    public function getProductToPOS()
    {
        return Db::allRows('select p.id,p.name, p.price, CASE WHEN p.visibility = 0 THEN "false" ELSE "true" END visibility,max(case when meta_key = "xPos" then meta_value end) x,max(case when meta_key = "yPos" then meta_value end) y from product p JOIN product_meta pm ON p.id = pm.product_id WHERE pm.meta_key IN ("xPos", "yPos") AND p.visibility = 1 GROUP BY pm.product_id;');
    }

    public function getTransactionProducts($tid)
    {
        return Db::allRows('SELECT p.id, p.name, p.price, pit.quantity FROM product p JOIN products_in_transaction pit ON pit.product_id = p.id WHERE pit.transaction_id = ?', [$tid]);
    }

    public function saveProductToTransaction($pid, $tid, $q)
    {
        $result = Db::oneRow("SELECT id, quantity FROM products_in_transaction WHERE product_id = ? AND transaction_id = ?", [$pid, $tid]);
        $quantity = $result["quantity"] ?? null;
        $quantity = (is_null($quantity)) ? $q : $quantity + $q;

        $product = ["product_id" => $pid, "transaction_id" => $tid, "quantity" => $quantity];

        if (!$result)
            Db::insert('products_in_transaction', $product);
        else
            Db::update('products_in_transaction', $product, 'WHERE id = ?', [$result["id"]]);

    }

    public function createTransaction(){
        Db::insert("transaction", ["date_time" => date("Y-m-d H:i:s"), "total" => 0]);
        $lastID = Db::getLastId();
        return $lastID;
    }

    private function getSingle(int $id)
    {
        return Db::oneRow("SELECT * FROM transaction WHERE id = ?", [$id]);
    }
}