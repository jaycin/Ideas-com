<?php
/**
 * Created by PhpStorm.
 * User: Jayci
 * Date: 2017/05/16
 * Time: 7:12 AM
 */

//Include repo and config files
require_once('/Database/config.php');
require_once('/Database/repo.php');
require_once ('/Database/db.php');
$repo = new repo();
$repo->init();
$repo->up($db);
$pageData = $repo->getPage($db,$_REQUEST['page']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Include angular js files-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="icon" href="assets/favicon.ico" />
    <title><?=$pageData->title?></title>
    <?
    foreach($pageData->Meta as $meta)
    {
        echo('<meta name="'.$meta->name.'" content="'.$meta->content.'">');
    }
    ?>
    <meta name="description" content="<?=$pageData->title?>">
    <script src="/js/angular.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-animate.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-touch.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-sanitize.js"></script>
    <script src="ui-bootstrap-tpls-2.5.0.min.js"></script>
    <?
    foreach($pageData->scripts as $k=>$v)
    {
      echo('<script src="$v"></script>');
    }
    ?>
    <link href="/css/bootstrap.css" rel="stylesheet"/>
    <?
    foreach($pageData->scripts as $k=>$v)
    {
        echo('<link href="$v" rel="stylesheet"/>');
    }
    ?>
</head>


