<?php

$OUT=array( 

   'ennable' => true,
   'name'    => 'Topas',
   'is_a'    => FALSE,
   'author'  => "Sebastian Knapp <rock@ccls-online.de>",
   'license' => "LGPL",
   'title'   => 'basic atomof modul',
   'pool'    => TRUE,
	    
   'provide' => array(
         #'application/main' => '',
         #'framework/udbi' => '',
         #'component/search_service' => '',
         'constant/realpath' => $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF']).'/',
	 'class/provider' => '',
	 'credits/php'    => 'Ruft die Funktion phpcredits auf.',
	 'framework/provider' => '',
	 'error/service_not_found' => ''
         )   
);
                                   
?>
