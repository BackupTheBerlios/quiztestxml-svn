<?php

$controller=$IN[0];

$OUT = array(
    'friend' => array(
	 'templateprovider' => $controller->service('framework/templateprovider','topas',1)
    )
);		      

?>
