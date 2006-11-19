<?php

// License: GPL
class Topas_Provider{
    var $template;
    var $image;
    var $style;

    function Topas_Provider($args){
        $this->template = &new topas_template_provider($args);
        $this->image    = &new topas_image_provider($args);
        $this->style    = &new topas_style_provider($args);
    }
}

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

class topas_basic_provider extends topas_media_provider {
    
    function topas_basic_provider ($args) {
	$this->base  = $args['base'];
	$this->style = $args['style'];
	$this->lang  = $args['lang'];
    }
    
    function path(){
	$path=$this->root()."/";
	if( $this->base  ) $path.="{$this->base}/";
	if( $this->style ) $path.="{$this->style}/";
	if( $this->lang  ) $path.="{$this->lang}/";
	if( $this->type  ) $path.="{$this->type}/";
	return $path;
    }
    
}

class topas_style_provider extends topas_basic_provider {
    function topas_style_provider($args){
	parent::topas_basic_provider($args);
    }
}

class topas_template_provider extends topas_basic_provider {
    function topas_template_provider($args){
	     $this->type='template';
	     parent::topas_basic_provider($args);
    }
}

class topas_image_provider extends topas_basic_provider {
    function topas_image_provider($args){
	$this->type='image';
	parent::topas_basic_provider($args);
    }
    
    function get($name){
	return $this->path().$name;
    }

}
  
?>
