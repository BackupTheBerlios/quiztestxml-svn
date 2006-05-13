<?php

require_once 'core/webapp.php';

$topmodul='gnopaste';

$app=new WebApp( Array( 'topmodul' => $topmodul,
			'skip'     => array('auth','bench','test')
                      , 'loglevel' => 3 ) );

$app->run($topmodul);

?>
