<?php

/*
 * Main class for web applications.
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

class WebApp {
   var $controller;

   function WebApp( $para ){
      $this->controller = new tmf_controller( $para );
   }

   function run(){ $this->controller->output_from_modul(); }
}

?>
