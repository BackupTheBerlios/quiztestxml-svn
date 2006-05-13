<?php

function pool_topas(){
    return new topas_pool();
}

class topas_pool {
    
    function framework_templateprovider($controller,$service,$modul){
        if( $controller->service('class/provider',$modul,1) ){
	    $default = array( 'base' => null, 'style' => null, 'lang' => null );
	    return new topas_template_provider($controller->service_args($service,$default));
	}
    }
    
}

?>
