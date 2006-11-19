<?php

list($controller,$service,$modul)=$IN;

$controller->service('session/start');
$controller->service('page/header');
$controller->service('page/body');
$controller->service('page/footer');

$OUT='';

?>
