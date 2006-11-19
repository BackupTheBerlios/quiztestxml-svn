<?php
    /** 
    * $Id: en_main.php 36 2005-08-08 21:56:51Z mosez $
    * vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4:
    *
    * This file is part of GNOPASTE
    *
    * @author   GNOPASTE Development Team <devel@ghcif.de>
    * @since    19/01/2005
    * @version  $Revision: 36 $
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

    setlocale(LC_TIME, 'en_US', 'en_GB', 'en', 'eng');
    
	$lang['acronym'] = 'en';
	$lang['charset'] = 'iso-8859-1';
	
	$lang['dateformat'] = 'r';
	
	$lang['usersettings'] = 'Userdata';	
	$lang['name'] = 'Name';
	$lang['codelang'] = 'Scriptlanguage';
	$lang['tab_width'] = 'Tabwidth';
	$lang['date'] = 'Date';
	$lang['ip'] = 'IP';
	$lang['description'] = 'Description';
	$lang['code'] = 'Code';
	$lang['sending'] = 'Send';
	$lang['postbutton'] = 'Add Entry';

	$lang['back_to_main'] = 'Back to Mainpage';
	$lang['saved'] = 'Saved';
	$lang['saved_text'] = 'You can see your Entry at the following URL.';
	$lang['generated'] = 'generated in';
	
	$lang['error'] = 'Error';
	$lang['unknown_id'] = 'Unknown PasteID';
	$lang['bad_id'] = 'Unserialized PasteID';
	$lang['empty_code'] = 'Field Code is empty';

    $lang['user_no_name'] = 'Anonymous';
    $lang['user_no_description'] = 'The user was to lazy to give a description';

$messages=$lang;

?>
