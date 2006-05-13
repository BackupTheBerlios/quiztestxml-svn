<?php

if(strstr(__FILE__,$_SERVER['PHP_SELF'])) require('../../../core/protect.php');

list($controller,$service,$modul)=$IN;

$icon=$controller->media('w3c-xhtml-strict.png','yw_start');
$css =$controller->media('valid-css.png','yw_start');

$OUT=<<<EOT
  <div style="position: absolute; bottom: 20px; left: 45%">
    <a href="http://validator.w3.org/check?uri=referer"><img
        src="$icon"
        alt="Valid XHTML 1.0 Strict" height="31" width="88" class="validator-icon" /></a>
	
    <a href="http://jigsaw.w3.org/css-validator/check/referer"><img
       src="$css"
       alt="Valid CSS!" height="31" width="88" class="validator-icon" /></a>
  </div>
EOT;

?>
