<?php

$controller=$IN[0];
$doctype=$controller->needs_val($IN[1]);

switch( $doctype ){
   case 'html_transitional':
      $OUT='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
      break;
   case 'xhtml_transitional':
      $OUT='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
              ."\n".'<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">';
      $controller->SetModuleValue('document/start',"<head>\n");
      break;
   case 'html_strict':
      break;
   case 'xhtml_strict':
      $OUT=<<<EOT
<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
EOT;
      break;
   case 'xml':
      $OUT='<?xml version="1.0">';
      break;
   default: $OUT="<!-- UNKNOWN_PARAMETER FOR SERVICE DOCUMENT/TYPE -->";
}

$OUT.="\n";

?>
