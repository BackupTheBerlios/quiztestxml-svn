<?php

if(strpos(__FILE__,$_SERVER['PHP_SELF'])===FALSE) require('../../../core/protect.php');

list($controller,$service,$modul)=$IN;

$tag = new Topas_Tag();

$banner = $tag->div(array(
   'id'    => 'app-banner',
   'style' => "position: absolute; top: 200px; left: 12%;"));

$banner->pp($controller->service("application/banner",'',1));

$message = $tag->div(array(
   'id' => 'welcome-message',
   'style' => "position: absolute; top: 422px; left: 16%;"
	     ."font-family: Verdana, sans-serif; font-size: 2ex; color: #940E29;"));

$message->pp($controller->service("message/welcome","",1));

$OUT  = $controller->service("application/background","",1);
$OUT .= $banner->get()."\n".$message->get()."\n";
$OUT .= $controller->service("application/validator","yw_start",1);

?>
