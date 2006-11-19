<?php

list($controller,$service,$modul)=$IN;

$lang=$controller->framework["i18n"]->messages;

$controller->service("page/form",$modul);

?>