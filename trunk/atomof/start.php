<?php

require_once 'core/webapp.php';

$app=new WebApp( Array( 'topmodul' => 'yw_start'
		      , 'skip'     => array('auth','bench','test')
                      , 'loglevel' => 3 ) );

$app->run('yw_start');

?>
