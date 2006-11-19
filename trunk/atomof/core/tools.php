<?php

/*
 * Created on May 14, 2005
 * 
 * GPL
 * Copyright (C) 2006, Lorenzo Bettini, http://www.lorenzobettini.it
 * 
 */

/**
 * generate a gloval variable with the name passed in $var
 * and value the content of $_POST[$var], or, if not defined of $_GET[$var]
 */
function getvar($var) {
	global $$var;
	
	if (isset($_POST[$var])) {
	        $$var = $_POST[$var];
	} else {
	        $$var = $_GET[$var];
	}
}

?>
