<?php

if(strstr(__FILE__,$_SERVER['PHP_SELF'])) require('../../../core/protect.php');

list($controller,$service,$modul)=$IN;

$bg1 = $controller->media('bgstart.jpg','yw_start');
$tag = new Topas_tag();

$common='position: absolute; height: 1600px; top: 0px; z-index: 0; ';
$left = $tag->div( array('id' => 'site-bg-left', 
          'style' => "{$common} width: 50%; left: 0px; background-color: #ffffce;"));

$rigd = $tag->div( array('id' => 'site-bg-right',
          'style' => "{$common} width: 50%; left: 50%; background-color: #ff6702;"));
	  
$midl = $tag->div( array('id' => 'site-bg-middle',
          'style' => "{$common} width: 800px; left: 12%; background: url(".$bg1."); text-align: center;"));
$midl->pp($controller->service("application/banner","yw_start",1));

foreach( array($left,$rigd,$midl) as $s ){ $f[]=$s->get(); }

$OUT=<<<EOT
<!-- Hintergrund -->
$f[0]
$f[1]
$f[2]
<!-- /Hintergrund -->
EOT;

?>
