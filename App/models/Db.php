<?php


namespace App\models;


use App\Config\Config;

class Db
{
    private static $connection;

    private static $settings = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        \PDO::ATTR_EMULATE_PREPARES => false
    ];

    public static function connect()
    {
        if (!isset(self::$connection)) {
            self::$connection = @new \PDO(
                sprintf("mysql:host=%s;dbname=%s", Config::$database["host"], Config::$database["database"]),
                Config::$database["user"],
                Config::$database["password"],
                self::$settings
            );
        }
    }

    public static function oneRow($query, $params = [])
    {
        $return = self::$connection->prepare($query);
        $return->execute($params);
        return $return->fetch();
    }

    public static function allRows($query, $params = [])
    {
        $return = self::$connection->prepare($query);
        $return->execute($params);
        return $return->fetchAll();
    }

    public static function singleEntry($query, $params = [])
    {
        $return = self::oneRow($query, $params);
        return $return[0];
    }

    public static function rowCount($query, $params = [])
    {
        $return = self::$connection->prepare($query);
        $return->execute($params);
        return $return->rowCount();
    }

    public static function insert($table, $params = [])
    {
        return self::rowCount("INSERT INTO `$table` (`".
            implode('`, `', array_keys($params)).
            "`) VALUES (".str_repeat('?,', sizeOf($params)-1)."?)",
            array_values($params));
    }

    public static function update($table, $values = array(), $cond, $params = array()) {
        return self::rowCount("UPDATE `$table` SET `".
            implode('` = ?, `', array_keys($values)).
            "` = ? " . $cond, array_merge(array_values($values), $params));
    }

    public static function getLastId()
    {
        return self::$connection->lastInsertId();
    }

    public static function insertMultiple($tableName, $data)
    {

        //Will contain SQL snippets.
        $rowsSQL = array();

        //Will contain the values that we need to bind.
        $toBind = array();

        //Get a list of column names to use in the SQL statement.
        $columnNames = array_keys($data[0]);

        //Loop through our $data array.
        foreach($data as $arrayIndex => $row){
            $params = array();
            foreach($row as $columnName => $columnValue){
                $param = ":" . $columnName . $arrayIndex;
                $params[] = $param;
                $toBind[$param] = $columnValue;
            }
            $rowsSQL[] = "(" . implode(", ", $params) . ")";
        }

        //Construct our SQL statement
        $sql = "INSERT INTO `$tableName` (" . implode(", ", $columnNames) . ") VALUES " . implode(", ", $rowsSQL);

        //Prepare our PDO statement.
        $return = self::$connection->prepare($sql);

        //Bind our values.
        foreach($toBind as $param => $val){
            $return->bindValue($param, $val);
        }

        //Execute our statement (i.e. insert the data).
        return $return->execute();
    }

}
