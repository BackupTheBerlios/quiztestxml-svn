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

$lang = &$controller->framework['i18n']->messages;
$prov = $controller->friend('provider',$modul);

$tmpl  = $prov->template->get("form.tpl");

if(isset($_COOKIE['gnopaste_name'])) {
	$_SESSION['name'] = stripslashes(base64_decode($_COOKIE['gnopaste_name']));
}

/**
* supported languages array
*/
$language = array(
    "Plain Text", "C89", "C", "C++", "PHP", "Perl", "Java", "VB", "C#", "Ruby", 
    "Python", "Pascal", "mIRC", "PL/I", "SQL", "XML", "Scheme"
); sort($language);


/**
* select optionen for the supported languages
*/
$lang_option = '';
foreach($language as $optlang)
{
	$lang_option .= '<option value="'.$optlang.'"';
	if(isset($_SESSION['code_lang']) AND trim($_SESSION['code_lang']) == $optlang)
	{
		$lang_option .= ' selected="selected"';
	}
	else
	{
		if($optlang == $config['first_selected_lang'])
		{
			$lang_option .= ' selected="selected"';
		}
	}
	$lang_option .= '>'.$optlang.'</option>';
}


/**
* select optionen for the tab width
*/
$tab_option = '';
for($i = 0; $i <= 9; $i++)
{
	$tab_option .= '<option value="'.$i.'"';
	if(is_numeric($_SESSION['tab_length']) AND trim($_SESSION['tab_length']) == $i)
	{
		$tab_option .= ' selected="selected"';
	}
	else
	{
		if($i == $config['std_tab'])
		{
			$tab_option .= ' selected="selected"';
		}
	}
	$tab_option .= '>'.$i.'</option>';
}

/**
* replace vars - form.tpl
*/
$tmpl = preg_replace ("/<#L_CODELANG#>/", $lang['codelang'], $tmpl);
$tmpl = preg_replace ("/<#L_TAB_WIDTH#>/", $lang['tab_width'], $tmpl);
$tmpl = preg_replace ("/<#L_NAME#>/", $lang['name'], $tmpl);
$tmpl = preg_replace ("/<#L_DESCRIPTION#>/", $lang['description'], $tmpl);
$tmpl = preg_replace ("/<#L_CODE#>/", $lang['code'], $tmpl);
$tmpl = preg_replace ("/<#L_POSTBUTTON#>/", $lang['postbutton'], $tmpl);
$tmpl = preg_replace ("/<#L_SENDING#>/", $lang['sending'], $tmpl);

$tmpl = preg_replace ("/<#S_LANG_OPTION#>/", $lang_option, $tmpl);
$tmpl = preg_replace ("/<#S_TAB_OPTION#>/", $tab_option, $tmpl);
$tmpl = preg_replace ("/<#S_NAME#>/", $_SESSION['name'], $tmpl);
$tmpl = preg_replace ("/<#S_DESCRIPTION#>/", $_SESSION['description'], $tmpl);
$tmpl = preg_replace ("/<#S_CODE#>/", $_SESSION['code'], $tmpl);

$tmpl = preg_replace ("/<#L_USERSETTINGS#>/", $lang['usersettings'], $tmpl);

$OUT=$tmpl;

?>