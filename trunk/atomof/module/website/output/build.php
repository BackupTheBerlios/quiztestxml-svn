<?php

$controller=$IN[0];

$controller->run_services(
     'application/prepare'
    ,'document/type'
    ,'document/start'
    ,'document/meta'
    ,'document/title'
    ,'document/shortcut_icon'
    ,'document/stylesheet'
    ,'document/style'
    ,'document/body'
    ,'application/main'
    ,'document/finish');
    
?>
