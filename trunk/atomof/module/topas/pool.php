<?php

function pool_topas(){
    return new topas_pool();
}

class topas_pool {
    
    function &framework_provider($controller,$service,$modul){
        $controller->service('class/provider',$modul,1);
        $default = array('style' => null, 'lang' => null );
        $args    = $controller->service_args($service,$default);
     
        if(empty($args['base']))
            $args['base'] = $args['modul'];
        $obj = &new Topas_Provider($args);
        return $obj;
    }

    function &framework_i18n($controller,$service,$modul){
	list($m,$lang)=$controller->needs($service);
        $controller->service("class/i18n",$modul,1);
        $i18n = &new Topas_I18N($lang,$m);
	return $i18n;
    }

    function credits_php($controller,$service,$modul){
	ob_start();
	phpcredits(CREDITS_ALL - CREDITS_FULLPAGE);
	$credits=ob_get_contents();
	ob_end_clean();
	return $credits;
    }
}

?>
