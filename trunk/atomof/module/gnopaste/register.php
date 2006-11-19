<?php

$OUT = array(
   'modul'     => 'gnopaste',
   'enable'    => false,
   'name'      => 'GNOPASTE',
   'title'     => 'yet another nopaste script',
   'copyright' => '2004-2005 by ghcif.de',
   'version'   => 'gnopaste v0.5.3',
   'website'   => 'http://www.ghcif.de',
   'author'    => 'GNOPASTE Development Team <devel@ghcif.de>',
   'license'   => 'GPL',
   'credits'   => 'special thx to McSchlumpf for the great banner <http://mcschlumpf.it-helpnet.de>',

   'require'   => array(
       'framework/i18n' => 'topas'
   ),
	     
   'provide'   => array(
       'page/header'   => 'xhtml website header with banner',
       'page/license'  => 'license and copyright',
       'page/title'    => 'GNOPASTE CODES REX',
       'page/body'     => '',
       'page/form'     => 'das Formular',
       'page/footer'   => '',
       'output/build'  => '',
       'session/start' => ''
   ),

   'needs'     => array(
       'framework/provider' => array('style'    => 'gnopaste'),
       'framework/i18n'     => array('language' => 'de', 'country' => 'DE')

#       'framework/imageprovider' => array( 'base' => 'gnopaste', 'style' => 'gnopaste' ),
#       'framework/styleprovider' => array( 'base' => 'gnopaste', 'style' => 'gnopaste' )
   )
);

?>
