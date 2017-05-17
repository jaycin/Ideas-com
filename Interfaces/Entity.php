<?php
include_once("/repo");
/**
 * Created by PhpStorm.
 * User: Jayci
 * Date: 2017/05/15
 * Time: 10:32 PM
 */

private class Entity
{
    public static  function getEntitySql($type)
    {
        return "CREATE TABLE $type ".Entity::propertySql($type)." ;";
    }

    public static function checkIfCreated($type,$db)
    {
       $check = $db->query("SELECT count(*) AS tableCount
            FROM information_schema.TABLES
            WHERE (TABLE_SCHEMA = '".DBNAME."') AND (TABLE_NAME = '$type')");
        return(!empty($check[0]->tableCount));

    }

    public static function propertySql($type)
    {
        $repo = new repo();
        $class = new $type();
        $sql = [];
        foreach($class as $key => $value) {
           if($value == "ID")
           {
             $sql[] = "ADD COLUMN $value INT(11) KEY";
           }
            elseif(strpos($value,"Is") !== false)
            {
                $sql[] = "ADD COLUMN $value TinyIni(1)";
            }
            elseif(array_search($value,$repo->getEntityNames()) !== false)
            {
                $sql[] = "ADD COLUMN $value INT(11) INDEX";
            }
            else
            {
                $sql[] = "ADD COLUMN $value VARCHAR(255)";;
            }

        }
        return implode(' ',$sql);
    }
}