<?php

if(strstr(__FILE__,$_SERVER['PHP_SELF'])) exit(0);

list($controller,$service,$modul)=$IN;

if($controller->in_hierarchy($modul)){

   $OUT=array(
       'provide' => array(
  	   'application/background'
	       => $controller->service('application/background','yw_start',1),
	   'application/main'
	       => $controller->service('application/background','yw_start',1)
       )
   );
}
else{
   $OUT=array();
}

?>
