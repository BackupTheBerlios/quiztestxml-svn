<?php

/*
 * Development class with debbuging output.
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

require_once 'core/tmf.php';

define('APP_START_URL','index.php'); # default page

class DebugApp extends tmf_controller {
   var $controller;
   
   function DebugApp( $para ){
       parent::tmf_controller($para);
   }

   function service($service,$dir=FALSE,$background=FALSE){
       echo "DEBUG: $service".($dir?", $dir":"").($background?",1":",0")."\n";
       return parent::service($service,$dir,$background);
   }

   function run_services(){
       $args=func_get_args();
       echo "RUN SERVICES";
       print_r($args);
       return call_user_func_array("parent::run_services",$args);
   }
    
   function setup_hierarchy($modul){
       parent::setup_hierarchy($modul);
       echo "DEBUG: [",implode(", ",$this->hierarchy),"]\n";
   }

   function service_args($service,$default=array()){
       list($mod,$val)=$this->needs($service);
       echo "DEBUG: ARGS - service => $service, modul => $mod, values => ["
            . join(", ",$val),"]";
       return array_merge(array('modul'=>$mod),$default,$val);
   }
    
   function run(){ $this->output_from_modul(); }
}

class WebApp extends DebugApp {

}

?>
