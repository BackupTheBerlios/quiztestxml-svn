<?php

require_once 'core/webapp.php';

$topmodul='yw_page';

$app=new WebApp( Array( 'topmodul' => $topmodul,
			'skip'     => array('auth','bench','test')
                      , 'loglevel' => 3 ) );

$app->run($topmodul);

?>
