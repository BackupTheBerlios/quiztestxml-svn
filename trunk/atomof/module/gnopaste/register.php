<?php

$OUT = array(
   'name'      => 'GNOPASTE',
   'title'     => 'yet another nopaste script',
   'copyright' => '2004-2005 by ghcif.de',
   'version'   => 'gnopaste v0.5.3',
   'website'   => 'http://www.ghcif.de',
   'author'    => 'GNOPASTE Development Team <devel@ghcif.de>',
   'license'   => 'GPL',
   'credits'   => 'special thx to McSchlumpf for the great banner <http://mcschlumpf.it-helpnet.de>',
	     
   'provide'   => array(
       'page/header' => 'xhtml website header with banner',
       'output/build' => ''
   ),

   'needs'     => array(
       'framework/templateprovider' => array( 'base' => 'gnopaste', 'style' => 'gnopaste' ) 			
   )
);

?>
