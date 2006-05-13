<?

list($controller,$service,$modul)=$IN;

$origserv=$controller->needs_val($service);
$OUT="<div style=\"color: red;\">Service $origserv not found!</div>"
  
?>
