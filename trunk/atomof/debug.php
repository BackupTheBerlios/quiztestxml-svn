<?php

require_once 'core/debug.php';

$top='gnopaste';

$app=new DebugApp( Array( 'topmodul' => $top
			, 'skip'     => array('auth','bench','test')
                        , 'loglevel' => 3 ) );

$app->run($topmodul);

?>
