<?php

/*
 * This file includes the core classes for the atomof web application framework.
 * Some ideas are borrowed from easy PHP framework.
 * 
 * Copyright (C) 2005-2006 Sebastian Knapp <rock@ccls-online.de>
 * 
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the GNU Library General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or (at your
 * option) any later version.
 * 
 * This library is distributed in the hope that it will be useful, but without
 * any warranty; without even the implied warranty of merchantability or 
 * fitness for a particular purpose. Please see the GNU Library General Public
 * License for more details.
 * 
 */

define('TMF_MODUL_DIR','module');  # modules directory
define('TMF_MEDIA_DIR','media');   # images, styles, flash, ...
define('TMF_I18N_DIR','i18n');     # translations


/**
* generation time
*/
function tmf_starttime(){
   static $starttime;
   if( $starttime )
      return $starttime;
   $mtime = microtime();
   $mtime = explode(" ",$mtime);
   $mtime = $mtime[1] + $mtime[0];
   $starttime = $mtime;
}
tmf_starttime();

/* for modules which use that stuff */
if( defined("IMPORT_TOOLS") ){
    require_once("core/tools.php");
}

class tmf_util {
    function subdirs($dir,$skip=array()){
        $subdirs=array();
        $dh= @opendir($dir);
        if( $dh ){
           while( FALSE !== ($e=readdir($dh))){
              if ($e == '.' || $e == '..' || in_array($e,$skip)) continue;
              if( is_dir("$dir/$e") ) array_push($subdirs,$e);
           }
        }
        return $subdirs;
    }
}

class tmf_args {
   
    function set_args($obj,$keys,$args){
	foreach($keys as $key => $meth){
           $obj->parameter[$key]=call_user_method($meth,$this,$args[$key]);
        }
    }
    
    function asis($args){
	return $args;
    }
    
    function array2hash($args){
	$n=array();
	if(is_array($args))
	   foreach($args as $key) $n[$key]=1;
	elseif($args)
	   $n["$a"]=1;
 
	return $n;
    }
}

class tmf_module {
    
    var $module=array();
    
    function tmf_module($args=array('skip'=>array())){
        $arg=new tmf_args();
	$arg->set_args($this,
		       array('skip' => 'array2hash'),
		       $args);
    }
    
    function load($dir){
        $skip=$this->parameter['skip'];
	if(!$skip[$dir]){
	    $this->module[$dir]=array('dir' => $dir);
	}
    }
    
    function count(){
	return count($this->module);
    }
    
    function dirs(){
	return array_keys($this->module);
    }

    function free($mod){
        unset($this->module[$mod]);
    }

    function merge($dir,$arg){
	foreach($arg as $key => $val){
	   if(is_array($val)){
	      if(empty($this->module[$dir][$key]))
              	 $this->module[$dir][$key]=array();
	      $this->module[$dir][$key]=array_merge($this->module[$dir][$key],$val);
	   }
	   else{
	      $this->module[$dir][$key]=$val;
	   }
	}
    }
    
    function is_a($dir){
	return $this->module[$dir]['is_a'];
    }
    
    function has_pool($dir){
	return $this->module[$dir]['pool'];
    }
    
    function srv_needs($dir,$service){
	if(isset($this->module[$dir]['needs'][$service])){
	    return $this->module[$dir]['needs'][$service];
	}
	return FALSE;
    }
    
    function prv_value($dir,$service){
	return $this->module[$dir]['provide'][$service];
    }
    
    function has_service($dir,$service){
	return isset($this->module[$dir]['provide'][$service]) ? TRUE : FALSE;
    }
}

class tmf_controller {
    
   var $module;
   var $framework=array();
   var $hierarchy=array();

   function tmf_controller($para){
      $top = $para['topmodul'];
      $this->module=new tmf_module($para);
      $skipdirs=array('.svn');
       foreach( tmf_util::subdirs(TMF_MODUL_DIR,$skipdirs) as $dir ){
	   $this->module->load($dir);
       }
       $this->step("preregister"); # unused until now
       $this->step("register");
       $this->setup_hierarchy($top);
       $this->remove_disabled_modules();
       $this->requirements();
       $this->step("postregister");
   }
    
   function step($step){
      foreach( $this->module->dirs() as $d ){
         $file = TMF_MODUL_DIR."/".$d."/$step.php";
         if(is_file($file)){
            $OUT=NULL;
            $OUT=$this->service($step,$d,1);
            if(is_array($OUT)){
               $this->module->merge($d,$OUT);
            }
            else{
               die("register variable not set correctly in dir $d!");
            }
         }
         else{
            if($step=="register"){
               die("no register file in dir $d!");
            }
         }
      }
   }

   // remove disabled modules which are not in hierarchy

   function remove_disabled_modules(){
      foreach ( $this->module->dirs() as $d ){
         if( $this->in_hierarchy($d) ) continue;
         if( ! $this->module->module[$d]['enable'] ){
            $this->module->free($d);
         }
      }
   }
   
   /* Moduleliste */
   function setup_hierarchy($modul){
      $this->hierarchy[]=$modul;
      if(!in_array($modul,$this->module->dirs()))
	 die("Unknown top modul $modul!");
      while( $isa=$this->module->is_a($modul) ){
         $this->hierarchy[]=$isa;
         $modul=$isa;
      }
      $this->hierarchy[]='topas';
   }
    
   function in_hierarchy($modul){
      $z=count($this->hierarchy);
      for($c=0;$c<$z;$c++){
	  if($this->hierarchy[$c]==$modul) return $c+1;
      }
      return 0;
   }

   function output_from_modul($initial_service="output/build",$modul=NULL ){
      $this->service($initial_service,$modul);
   }
   
   function current_modul(){
      return $this->hierarchy[0];
   }

   function service_modul(&$service){
      foreach ($this->hierarchy as $dir ){
         if( $this->module->has_service($dir,$service)){
            return $dir;
         }
      }
      $newserv="error/service_not_found";
      if( $service == $newserv )
         die;
      $this->set_srv_needs($newserv,$service);
      $service=$newserv;
      return $this->service_modul($service);
   }

   /*
    * Service Arguments
    *
    */
   function needs($service){
      foreach ( $this->hierarchy as $dir ){
         $val=$this->module->srv_needs($dir,$service);
         if($val) return array($dir,$val);
      }
      return array($dir,'');
   }

   function needs_val($service){
      list($mod,$val)=$this->needs($service);
      return $val;
   }
    
   function service_args($service,$default=array()){
      list($mod,$val)=$this->needs($service);
       return array_merge(array('modul'=>$mod),$default,$val);
   }
    
   function set_prv_value($service, $val ){
      $this->module->module[$this->current_modul()]['provide'][$service]=$val;
   }

   function set_srv_needs( $service, $val ){
      $this->module->module[$this->current_modul()]['needs'][$service]=$val;
   }
    
   /* Ein Modulprivates Objekt */
   /* friend is mostly the second part of servicename */
   function friend($friend,$modul){
      return $this->module->module[$modul]['friend'][$friend];
   }
    
   /* Haupsaechlich Frameworks und Klassen werden geladen.
    * Bei einer Klasse wird aber nur die Datei aufgerufen und kein Objekt angelegt.
    * Bei gleichen Frameworks gewinnt das in der Hierarchy weiter oben stehnde Modul,
    * wenn es nicht aus dem selben Modul geladen wird. Dann wird dieses Framework ergaenzt.
    * Diese Eigenschaft (add_info) sollte im Framework implementiert sein.
    * TODO: warum ein Framework laden wenn es durch ein höherstehendes ersetzt wird?
    */
   function requirements(){
      $loaded=array();
      $cnt   =0;

      foreach( array_reverse($this->hierarchy) as $dir ){
         $require=$this->module->module[$dir]["require"];
         if( isset($require) ){
            foreach( $require as $service => $servdir ){
               list( $part,$serv )=explode("/",$service,2);

	       if( isset($loaded[$service]) ){
                  if($loaded[$service]==$servdir){
		     if($part=="framework"){
		        $this->framework[$service]->add_info($this,$dir);
		        continue;
	             }
		  }
	       }
	       $obj[$cnt]=$this->service($service,$servdir,1);
               if( $part == "framework" ){
                  $this->framework[$serv]=&$obj[$cnt++];
               }
	       $loaded[$service]=$servdir;
            }
         }
      }
   }

   /*
    * Execution
    * 
    */
   
   function run_services(){
      $services=func_get_args();
      $out="";
      foreach ( $services as $serv ){
         if( is_array($serv) ) $out .= $this->service($serv[0],$serv[1],$serv[2]);
         else                  $this->service($serv);
      }
      return $out;
   }

   function service($service,$dir=FALSE,$background=FALSE){
      if(!$dir)
         $dir=$this->service_modul($service);
      if(!$dir) // There is currently no modul providing this service.
         return;
      $OUT=$this->service_execution($service,$dir);
      if($background)
         return $OUT;
      else
         echo $OUT; return '';
   }

   function service_execution($service,$dir){
      $s=$this->std_service($service,$dir);
      if( $s !== NULL )
         return $s;

      $include_file=TMF_MODUL_DIR."/$dir/$service.";
      if( file_exists($include_file."php") ){
         $IN=array($this,$service,$dir);
         include(TMF_MODUL_DIR."/$dir/$service.php");
         return $OUT;
      }
      if( file_exists($include_file."html") ){
         ob_start();
         include($include_file."html");
         $s=ob_get_contents();
         ob_end_clean();
      }
      if( $s===NULL){
         if( $this->module->has_pool( $dir ) ){
            include_once(TMF_MODUL_DIR."/$dir/pool.php");
	    $func=str_replace ( "/", "_", $service );
	    $o=call_user_func("pool_{$dir}");
	    if( method_exists($o,$func) ){
	       $s=call_user_method ($func,$o,$this,$service,$dir);
	    }
	    else{
               $s=$this->module->prv_value($dir,$service);
	    }
         }
         else{
            $s=$this->module->prv_value($dir,$service);
         }
      }
      return $s;
   }

   function std_service($service,$dir){
      $value = $this->module->prv_value($dir,$service);
      #$tag   = new Topas_Tag();
      list( $part,$serv )=explode("/",$service,2);
      $s=NULL;
      switch( $part ){
         case 'link':
           # $s=$tag->a($value); 
            break;
         case 'function':
            require_once(TMF_MODUL_DIR."/{$dir}/functions.php");
            $s=call_user_func($serv,$this);
            break;
         case 'class':
            # requirements
            foreach( explode(" ",$value) as $base ){
               if( !$base ) continue;
               list($basemod,$baseclass)=explode("/",$base);
               require_once(TMF_MODUL_DIR."/{$basemod}/class/{$baseclass}.php");
            }
            require_once("module/{$dir}/{$service}.php");
            $s=TRUE;
            break;
      };
      return $s;
   }
    
   /*
    * data access
    * 
    */
   function media($src,$dir){
      return TMF_MEDIA_DIR."/$dir/$src";
   }

}

?>
