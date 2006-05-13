<?php

/*
 * To protect some services from unwanted execution.
 * Siplest way to use another action is to overwrite this file with
 * the wanted handler.
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

define('APP_START_URL','/atomof/index.php'); # default page

# protect some services from unwanted execution
if(!is_array($IN))
    header("Location: ".APP_START_URL);

exit(0);

?>
