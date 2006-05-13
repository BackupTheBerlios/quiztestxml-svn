<?php

$OUT=array(
   'enable'   => TRUE,
   'name'     => 'Young-Workers Start',
   'is_a'     => 'website',
   'author'   => 'Valeria Gulinska, Sebastian Knapp <rock@ccls-online.de>',
   'require'  => array(
      'class/tag' => 'topas'
   ),
   'provide'  => array(
      'application/main' => '',
      'application/background' => '',
      'application/validator'  => '',
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
