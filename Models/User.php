<?php
/**
 * Created by PhpStorm.
 * User: Jayci
 * Date: 2017/05/15
 * Time: 10:04 PM
 *
*/

public class User extends Entity
{
    private $ID;
    private $Username;
    private $Password;
    private $Name;
    //Serialized external vendor auth data list
    private $RelativeData;

}