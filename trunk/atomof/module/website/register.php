<?php

$OUT=array( 

   'enable'  => true,
   'pool'    => true,
   'name'    => 'website',
   'title'   => 'standard service for a common website',
   'author'  => 'Sebastian Knapp <rock@ccls-online.de>',
   'license' => 'LGPL',
   'provide' => array(
      'output/build'    => '',

      'document/type' =>
             array( 'html_transitional'
                  , 'html_strict'
		  , 'xhtml_transitional'
                  , 'xhtml_strict'
                  , 'xml' ),
      'document/meta'   => '',
      'document/start'  => "<html><head>\n",
      'document/body'   => "</head><body>\n",
      'document/finish' => "</body></html>\n",
      'document/title'         => '',
      'document/shortcut_icon' => '',
      'document/stylesheet'    => '',
      'document/style'         => '',
      'application/prepare'    => '',
      'application/banner'     => '',

      'framework/SafeIO' => 'Ein- und Ausgabe sichern'
             ),
   'needs' => array(
      'document/type' => 'html_transitional'
	    )
);

?>
