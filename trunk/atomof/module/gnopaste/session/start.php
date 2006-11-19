<?php

    /** 
    * $Id: index.php 38 2005-08-09 17:55:47Z mosez $
    * vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4:
    *
    * This file is part of GNOPASTE
    *
    * @author   GNOPASTE Development Team <devel@ghcif.de>
    * @since    19/01/2005
    * @version  $Revision: 38 $
    *
    * Copyright (C) 2004-2005 by ghcif.de <devel@ghcif.de>
    *   
    * This program is free software; you can redistribute it and/or modify
    * it under the terms of the GNU General Public License as published by
    * the Free Software Foundation; either version 2 of the License, or
    * (at your option) any later version.
    *
    * This program is distributed in the hope that it will be useful, 
    * but WITHOUT ANY WARRANTY; without even the implied warranty of
    * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    * GNU General Public License for more details.
    *
    * You should have received a copy of the GNU General Public License
    * along with this program; if not, write to the Free Software
    * Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
    */

list($controller,$service,$modul)=$IN;

/**
*  define session und sessionvars
*/
if( !$controller->framework['session'] ) 
    session_start();
$controller->framework['session']=1;

if(!isset($_SESSION['name']))
{
	$_SESSION['name'] = '';
}
if(!isset($_SESSION['tab_length']))
{
	$_SESSION['tab_length'] = '';
}
if(!isset($_SESSION['code_lang']))
{
	$_SESSION['code_lang'] = '';
}
if(!isset($_SESSION['description']))
{
	$_SESSION['description'] = '';
}
if(!isset($_SESSION['code']))
{
	$_SESSION['code'] = '';
}

?>