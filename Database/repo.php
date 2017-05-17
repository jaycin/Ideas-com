<?php
/**
 * Created by PhpStorm.
 * User: SouthCode
 * Date: 2017/05/15
 * Time: 9:33 PM
 */

public class repo
{
    private $names;
    public function init()
    {
        //Incude all model files
        $root = scandir('/Models');
        foreach ($root as $model) {
            if (!empty($model)) {
                include($model);
            }
        }

    }
    public function up($db)
    {
        $root = scandir('/Models');
        foreach ($root as $model) {
            if (!empty($model)) {
                $class ="Class".str_replace('.php',str_replace("/",$model));
                $entity = new $class();
                $names[] = $class;
                if($entity::checkIfCreated($class,$db)) {
                    $db->query($entity::getEntitySql($class, $db));
                }
            }
        }
    }



    public  function  getEntityNames()
    {
        return names;
    }



}