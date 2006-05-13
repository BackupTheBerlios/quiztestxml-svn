<?php

// License: GPL

class topas_media_provider {
    
    function root(){
	return TMF_MEDIA_DIR;
    }
    
    function get($name){
	$fn = $this->path()."$name";
	$fd = "";
	$fpread = @fopen($fn, 'r');
	if( !($fpread === FALSE) ){
	   while(!feof($fpread))
	   {
	       $fd .= fgets($fpread, 4096);
	   }
	   fclose($fpread);
	}

        return $fd;
    }
}

class topas_template_provider extends topas_media_provider {
    
    function topas_template_provider ($args) {
	$this->base  = $args['base'];
	$this->style = $args['style'];
	$this->lang  = $args['lang'];
    }
    
    function path(){
	$path=$this->root()."/";
	if( $this->base  ) $path.="{$this->base}/";
	if( $this->style ) $path.="{$this->style}/";
	if( $this->lang  ) $path.="{$this->lang}/";
	return $path;
    }
    
}

?>
