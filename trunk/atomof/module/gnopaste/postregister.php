<?php

$controller=$IN[0];

$OUT = array(
    'friend' => array(
        'provider' => $controller->service('framework/provider','topas',1),
    )
);		      

?>
