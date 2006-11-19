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

$tp = $controller->friend('templateprovider',$modul);

$tmpl = $tp->get("header.tpl");

$ip = $controller->friend('imageprovider',$modul);
$imgs = $ip->path();

$sp = $controller->friend('styleprovider',$modul);
$style = $sp->path();

/**
 * replace vars - header.tpl
 */
$tmpl = preg_replace ("/<#L_ACRONYM#>/", $lang['acronym'], $tmpl);
$tmpl = preg_replace ("/<#L_CHARSET#>/", $lang['charset'], $tmpl);
$tmpl = preg_replace ("/<#L_PAGE_TITLE#>/", $config['page_title'], $tmpl);
$tmpl = preg_replace ("/<#L_SITENAME#>/", $config['site_name'], $tmpl);

$tmpl = preg_replace ("/<#IMAGE_PATH#>/", $imgs, $tmpl);
$tmpl = preg_replace ("/<#STYLE_PATH#>/", $style, $tmpl);
// $tmpl = preg_replace ("/<#SITEURL#>/", GNOPASTE_URL, $tmpl);

$license = $controller->service('page/license',$modul,1);
$tmpl = preg_replace ("/<#L_LICENSE#>/",$license,$tmpl);

/**
 * output - header.tpl
 */
$OUT = $tmpl;

?>
