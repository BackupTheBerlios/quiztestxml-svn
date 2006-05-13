<?php

$OUT=array(
   'enable'   => TRUE,
   'name'     => 'Young-Workers Page',
   'is_a'     => 'website',
   'license'  => 'LGPL',
   'author'   => 'Valeria Gulinska, Sebastian Knapp <rock@ccls-online.de>',
   'require'  => array(
      'class/tag' => 'topas',
      'framework/xhtmlheader' => '29o3',
      'framework/xhtmlbody'   => '29o3'
   ),
   'provide'  => array(
      'application/main' => 'Hallo Welt!',
      'message/welcome'        => 'Bitte haben Sie noch etwas Geduld!',
      'document/meta'          => '',
      'document/start'         => "<head>\n", // whenever xhtml_strict
      'document/body'          => '</head><body style="padding: 0px; margin: 0px;">'
   ),
   'needs'    => array(
      'document/type'          => 'xhtml_strict',
      'document/title'         => 'young.workers.de',
      'document/stylesheet'    => 'start.css',
      'document/shortcut_icon' => 'yw.png',
      'application/banner'     =>
         array( "modul" => 'yw_start'
              , "src" => 'startbanner.jpg'
              , "alt" => "Hier entsteht das Jugendjobportal young-workers.de"
              , "height" => 91, "width" => 803 ),
   )

);

?>
