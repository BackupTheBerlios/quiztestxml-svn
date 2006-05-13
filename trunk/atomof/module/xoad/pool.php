<?php

function pool_xoad(){
    return new xoad_pool();
}

class xoad_pool(){
     
    /**
     * Registers XOAD client header files.
     *
     * @access	public
     *
     * @param	string	$base		Base XOAD folder.
     *
     * @param	bool	$optimized	true to include optimized headers, false otherwise.
     *
     * @return	string	HTML code to include XOAD client files.
     *
     * @static
     *
     */
    function header($controller,$service,$modul)
    {
	$default = array( 'base'      => '.',
			  'optimized' => true
			);
	$args=$controller->service_args($service,$default);
	$returnValue = '<script type="text/javascript" src="' . $base . '/js/xoad/';

	$returnValue .= 'xoad';

	if ($optimized) {

	    $returnValue .= '_optimized';
	}

	$returnValue .= '.js"></script>';

	if (array_key_exists('_XOAD_CUSTOM_HEADERS', $GLOBALS)) {

	    foreach ($GLOBALS['_XOAD_CUSTOM_HEADERS'] as $fileName) {

		$returnValue .= '<script type="text/javascript" src="' . $base . ($optimized ? $fileName[1] : $fileName[0]) . '"></script>';
	    }
	}

	if (array_key_exists('_XOAD_EXTENSION_HEADERS', $GLOBALS)) {

	    foreach ($GLOBALS['_XOAD_EXTENSION_HEADERS'] as $extension => $files) {

		$extensionBase = $base . '/extensions/' . $extension . '/';

		foreach ($files as $fileName) {

		    $returnValue .= '<script type="text/javascript" src="' . $extensionBase . ($optimized ? $fileName[1] : $fileName[0]) . '"></script>';
		}
	    }
	}

	return $returnValue;
    }

   function xoad_header(){   
       
   }
   
}
