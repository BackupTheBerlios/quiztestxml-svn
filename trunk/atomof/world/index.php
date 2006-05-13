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


	$root_path = '';
	$index_realpath = $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF']).'/';
	include($root_path.'includes/common.php');


	/**
	* root real path
	*/
	define('REAL_PATH', dirname(__FILE__) . '/');


	/**
	* root relative path
	*/
    define('RELATIVE_PATH', ((dirname($_SERVER['PHP_SELF']) == '/') ? (dirname($_SERVER['PHP_SELF'])) : (dirname($_SERVER['PHP_SELF']) . '/')) . '');
	
    /**
	* project url
	*/
	define('GNOPASTE_URL', 'http://' . $_SERVER['SERVER_NAME'] . RELATIVE_PATH);


	if(@file_exists($index_realpath.'layouts/'.$config['layout'].'/header.tpl'))
	{
		/**
		* load templatefile - header.tpl
		*/
		$filename = $index_realpath.'layouts/'.$config['layout'].'/header.tpl';
		
		$file_data = "";
		$fpread = @fopen($filename, 'r');
		while(!feof($fpread))
		{
			$file_data .= fgets($fpread, 4096);
		}
		fclose($fpread);

		/**
		* replace vars - header.tpl
		*/
		$file_data = preg_replace ("/<#L_ACRONYM#>/", $lang['acronym'], $file_data);
		$file_data = preg_replace ("/<#L_CHARSET#>/", $lang['charset'], $file_data);
		$file_data = preg_replace ("/<#L_PAGE_TITLE#>/", $config['page_title'], $file_data);
		$file_data = preg_replace ("/<#L_SITENAME#>/", $config['site_name'], $file_data);
		$file_data = preg_replace ("/<#RELATIVE_PATH#>/", RELATIVE_PATH, $file_data);
		$file_data = preg_replace ("/<#SITEURL#>/", GNOPASTE_URL, $file_data);

		/**
		* output - header.tpl
		*/
		echo($file_data);
	}
	else
	{
		/**
		* error - header.tpl doesnt exist
		*/
		die('Failed to load header.tpl');
	}

	if(isset($_GET['id']))
	{
		if(preg_match('/^[a-fA-F\d]{10}$/', $_GET['id']))
		{
			$sql = 'SELECT * FROM '.$tbl_prefix.'pastes WHERE cryptid = "'.$_GET['id'].'";';
			$query = mysql_query($sql) OR die(mysql_error());

			if(mysql_num_rows($query) > 0)
			{
				/**
				* output - begin
				*/
				
				include($root_path.'includes/highlight.php');
				
				while($row = mysql_fetch_assoc($query))
				{
					if(@file_exists($index_realpath.'layouts/'.$config['layout'].'/output.tpl'))
					{
						/**
						* load templatefile - output.tpl
						*/
						$filename = $index_realpath.'layouts/'.$config['layout'].'/output.tpl';

						$file_data = "";
						$fpread = @fopen($filename, 'r');
						while(!feof($fpread))
						{
							$file_data .= fgets($fpread, 4096);
						}
						fclose($fpread);

						/**
						* code highlighting
						*/
						$parsedname = stripslashes($row['name']);
                        
                        $parsedname = ($parsedname == '0') ? ($lang['user_no_name']) : ($parsedname);
						
						$parseddate = date($lang['dateformat'], $row['time']);
						
						$description = stripslashes($row['description']);
						$description = preg_replace("/\n/", "<br />\n", $description);

                        $description = ($description == '0') ? ($lang['user_no_description']) : ($description);
						
						$code = stripslashes(htmlspecialchars($row['code']));
						$codelang = $row['code_lang'];

						$code = preg_replace("/  /", "&nbsp; ", $code);
						$code = preg_replace("/</", "&lt;", $code);
						$code = preg_replace("/>/", "&gt;", $code);
						$code = syntax_highlight($code, $codelang);
						
						$code = str_replace("\t", str_repeat('&nbsp;', $row['tab_length']), $code);
				
						$explode = explode("\n", $code);
						
						$parsedcode = '';
						$i = 0;
						foreach($explode AS $value)
						{
							$classnumber = $i % 2;
							if(trim($value) != '') {
								$parsedcode .= "<li class=\"rowstyle" . $classnumber . "\">" . $value . "</li>\n";
							} else {
								$parsedcode .= "<li class=\"rowstyle" . $classnumber . "\">&nbsp;</li>\n";
							}

							$i++;
						}
						
						/**
						* replace vars - output.tpl
						*/
						$file_data = preg_replace ("/<#L_USERSETTINGS#>/", $lang['usersettings'], $file_data);
						
						$file_data = preg_replace ("/<#L_NAME#>/", $lang['name'], $file_data);
						$file_data = preg_replace ("/<#S_NAME#>/", $parsedname, $file_data);
						
						$file_data = preg_replace ("/<#L_CODELANG#>/", $lang['codelang'], $file_data);
						$file_data = preg_replace ("/<#S_CODELANG#>/", $row['code_lang'], $file_data);
					
						$file_data = preg_replace ("/<#L_TAB_WIDTH#>/", $lang['tab_width'], $file_data);
						$file_data = preg_replace ("/<#S_TAB_WIDTH#>/", $row['tab_length'], $file_data);
					
						$file_data = preg_replace ("/<#L_DATE#>/", $lang['date'], $file_data);
						$file_data = preg_replace ("/<#S_DATE#>/", $parseddate, $file_data);
						
						$file_data = preg_replace ("/<#L_IP#>/", $lang['ip'], $file_data);
						$file_data = preg_replace ("/<#S_IP#>/", $row['ip'], $file_data);
						
						$file_data = preg_replace ("/<#L_DESCRIPTION#>/", $lang['description'], $file_data);
						$file_data = preg_replace ("/<#S_DESCRIPTION#>/", $description, $file_data);
						
						$file_data = preg_replace ("/<#L_CODE#>/", $lang['code'], $file_data);
						$file_data = str_replace ("<#S_CODE#>", $parsedcode, $file_data);
						
						/**
						* output - output.tpl
						*/
						echo($file_data);
					}
					else
					{
						/**
						* error - output.tpl doesnt exist
						*/
						die('Failed to load output.tpl');
					}
				}
				
				/**
				* output - end
				*/
			}
			else
			{
				/**
				* error - unknown id
				*/
				
				if(@file_exists($index_realpath.'layouts/'.$config['layout'].'/info.tpl'))
				{
					/**
					* load templatefile - info.tpl
					*/
					$filename = $index_realpath.'layouts/'.$config['layout'].'/info.tpl';

					$file_data = "";
					$fpread = @fopen($filename, 'r');
					while(!feof($fpread))
					{
						$file_data .= fgets($fpread, 4096);
					}
					fclose($fpread);

					/**
					* replace vars - info.tpl
					*/
					$file_data = preg_replace ("/<#L_INFOTITLE#>/", $lang['error'], $file_data);
					$file_data = preg_replace ("/<#L_INFOTEXT#>/", $lang['unknown_id'], $file_data);
					$file_data = preg_replace ("/<#L_INFOLINK#>/", $lang['back_to_main'], $file_data);

					$file_data = preg_replace ("/<#A_INFOLINK#>/", 'index.php', $file_data);

					/**
					* output - info.tpl
					*/
					echo($file_data);
				}
				else
				{
					/**
					* error - info.tpl doesnt exist
					*/
					die('Failed to load info.tpl');
				}
			}
		}
		else
		{
			/**
			* error - unserialized id
			*/

			if(@file_exists($index_realpath.'layouts/'.$config['layout'].'/info.tpl'))
			{
				/**
				* load templatefile - info.tpl
				*/
				$filename = $index_realpath.'layouts/'.$config['layout'].'/info.tpl';

				$file_data = "";
				$fpread = @fopen($filename, 'r');
				while(!feof($fpread))
				{
					$file_data .= fgets($fpread, 4096);
				}                                                                       
				fclose($fpread);                                                                

				/**
				* replace vars - info.tpl
				*/                                                                                                      
				$file_data = preg_replace ("/<#L_INFOTITLE#>/", $lang['error'], $file_data);
				$file_data = preg_replace ("/<#L_INFOTEXT#>/", $lang['bad_id'], $file_data);
				$file_data = preg_replace ("/<#L_INFOLINK#>/", $lang['back_to_main'], $file_data);

				$file_data = preg_replace ("/<#A_INFOLINK#>/", 'index.php', $file_data);
																				
				/**
				* output - info.tpl
				*/                                                                                                                                              
				echo($file_data);
			}
			else
			{
				/**
				* error - info.tpl doesnt exist
				*/                 
				die('Failed to load info.tpl');
			}  
		}
	}
	else
	{
		if(isset($_POST['submit']))
		{
            /**
			* processing - begin
			*/

			$_SESSION['code_lang'] = trim($_POST['code_lang']);
			$_SESSION['tab_length'] = trim($_POST['tab_length']);
			$_SESSION['name'] = trim($_POST['name']);
			$_SESSION['description'] = $_POST['description'];
			$_SESSION['code'] = @$_POST['code'];
																
			if(trim($_SESSION['code']) == '')
			{
				/**
				* error - no code
				*/

				if(@file_exists($index_realpath.'layouts/'.$config['layout'].'/info.tpl'))
				{
					/**
					* load templatefile - info.tpl
					*/
					$filename = $index_realpath.'layouts/'.$config['layout'].'/info.tpl';

					$file_data = "";
					$fpread = @fopen($filename, 'r');
					while(!feof($fpread))
					{
						$file_data .= fgets($fpread, 4096);
					}                                                                       
					fclose($fpread);                                                                

					/**
					* replace vars - info.tpl
					*/                                                                                                      
					$file_data = preg_replace ("/<#L_INFOTITLE#>/", $lang['error'], $file_data);
					$file_data = preg_replace ("/<#L_INFOTEXT#>/", $lang['empty_code'], $file_data);
					$file_data = preg_replace ("/<#L_INFOLINK#>/", $lang['back_to_main'], $file_data);

					$file_data = preg_replace ("/<#A_INFOLINK#>/", 'index.php', $file_data);
																
					/**
					* output - info.tpl
					*/                                                                                                                                              
					echo($file_data);
				}
				else
				{
					/**
					* error - info.tpl doesnt exist
					*/                 
					die('Failed to load info.tpl');
				}  
			}
			else
			{
				$codelang = (in_array($_SESSION['code_lang'], $language)) ? ($_SESSION['code_lang']) : ('Plain Text');
				$tablength = (is_numeric($_SESSION['tab_length']) AND $_SESSION['tab_length'] >= 0 AND $_SESSION['tab_length'] <= 9) ? ($_SESSION['tab_length']) : ($config['std_tab']);
				$name = ($_SESSION['name'] == '') ? (0) : (addslashes(htmlspecialchars($_SESSION['name'])));
				$description = (trim($_SESSION['description']) == '') ? (0) : (addslashes(htmlspecialchars($_SESSION['description'])));
				$code = addslashes($_SESSION['code']);

				$crypt_id = substr(md5(microtime()),0,10);

				$sql = 'INSERT INTO '.$tbl_prefix.'pastes (cryptid, name, description, code, tab_length, code_lang, time, ip) VALUES ("'.$crypt_id.'", "'.$name.'", "'.$description.'", "'.$code.'", "'.$tablength.'", "'.$codelang.'", UNIX_TIMESTAMP(), "'.$_SERVER['REMOTE_ADDR'].'");';
				mysql_query($sql) OR die(mysql_error());

                $cookiename = ($name == '0') ? ('') : ($name);
				setcookie('gnopaste_name', base64_encode($cookiename), time()+3600, '/', $_SERVER['SERVER_NAME'], 0);

				if(@file_exists($index_realpath.'layouts/'.$config['layout'].'/info.tpl'))
				{
					/**
					* load templatefile - info.tpl
					*/
					$filename = $index_realpath.'layouts/'.$config['layout'].'/info.tpl';

					$file_data = "";
					$fpread = @fopen($filename, 'r');
					while(!feof($fpread))
					{
						$file_data .= fgets($fpread, 4096);
					}                                                                       
					fclose($fpread);                                                                

					/**
					* replace vars - info.tpl
					*/                                                                                                      
					$file_data = preg_replace ("/<#L_INFOTITLE#>/", $lang['saved'], $file_data);
					$file_data = preg_replace ("/<#L_INFOTEXT#>/", $lang['saved_text'], $file_data);
					$file_data = preg_replace ("/<#L_INFOLINK#>/", 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'?id='.$crypt_id, $file_data);

					$file_data = preg_replace ("/<#A_INFOLINK#>/", $_SERVER['REQUEST_URI'].'?id='.$crypt_id, $file_data);
																				
					/**
					* output - info.tpl
					*/                                                                                                                                              
					echo($file_data);
				}
				else
				{
					/**
					* error - info.tpl doesnt exist
					*/                 
					die('Failed to load info.tpl');
				}  

				session_destroy();
			}
		
			/**
			* processing - end
			*/
		}
		else
		{
			/**
			* form - begin
			*/
			
			if(@file_exists($index_realpath.'layouts/'.$config['layout'].'/form.tpl'))
			{
				if(isset($_COOKIE['gnopaste_name'])) {
					$_SESSION['name'] = stripslashes(base64_decode($_COOKIE['gnopaste_name']));
				}
				
				/**
				* load templatefile - form.tpl
				*/
				$filename = $index_realpath.'layouts/'.$config['layout'].'/form.tpl';
				
				$file_data = "";
				$fpread = @fopen($filename, 'r');
				while(!feof($fpread)) 
				{
					$file_data .= fgets($fpread, 4096);
				}
				fclose($fpread);

				/**
				* replace vars - form.tpl
				*/
				$file_data = preg_replace ("/<#L_CODELANG#>/", $lang['codelang'], $file_data);
				$file_data = preg_replace ("/<#L_TAB_WIDTH#>/", $lang['tab_width'], $file_data);
				$file_data = preg_replace ("/<#L_NAME#>/", $lang['name'], $file_data);
				$file_data = preg_replace ("/<#L_DESCRIPTION#>/", $lang['description'], $file_data);
				$file_data = preg_replace ("/<#L_CODE#>/", $lang['code'], $file_data);
				$file_data = preg_replace ("/<#L_POSTBUTTON#>/", $lang['postbutton'], $file_data);
				$file_data = preg_replace ("/<#L_SENDING#>/", $lang['sending'], $file_data);
				
				$file_data = preg_replace ("/<#S_LANG_OPTION#>/", $lang_option, $file_data);
				$file_data = preg_replace ("/<#S_TAB_OPTION#>/", $tab_option, $file_data);
				$file_data = preg_replace ("/<#S_NAME#>/", $_SESSION['name'], $file_data);
				$file_data = preg_replace ("/<#S_DESCRIPTION#>/", $_SESSION['description'], $file_data);
				$file_data = preg_replace ("/<#S_CODE#>/", $_SESSION['code'], $file_data);
				
				$file_data = preg_replace ("/<#L_USERSETTINGS#>/", $lang['usersettings'], $file_data);

				/**
				* output - form.tpl
				*/
				echo($file_data);
			}
			else
			{
				/**
				* error - form.tpl doesnt exist
				*/
				die('Failed to load form.tpl');
			}
		
			/**
			* form - end
			*/
		}
	}

	if(@file_exists($index_realpath.'layouts/'.$config['layout'].'/footer.tpl'))
	{
		/**
		* load templatefile  - form.tpl
		*/
		$filename = $index_realpath.'layouts/'.$config['layout'].'/footer.tpl';
		
		$file_data = "";
		$fpread = @fopen($filename, 'r');
		while(!feof($fpread))
		{
			$file_data .= fgets($fpread, 4096);
		}
		fclose($fpread);

		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$endtime = $mtime;
		$gentime = round(($endtime - $starttime), 3).'s';

		/**
		* replace vars - footer.tpl
		*/
		$file_data = preg_replace ("/<#L_FOOTER#>/", stripslashes($config['copyright']), $file_data);
		$file_data = preg_replace ("/<#GENERATED_IN#>/", $lang['generated'].' '.$gentime, $file_data);
		$file_data = preg_replace ("/<#GNOPASTE_VERSION#>/", $config['gnopaste_version'], $file_data);
		
		/**
		* output - footer.tpl
		*/
		echo($file_data);
	}
	else
	{
		/**
		* error - footer.tpl doesnt exist
		*/
		die('Failed to load footer.tpl');
	}


	/**
	* stop buffering
	*/
	$contents = ob_get_contents();
	ob_end_clean();

	echo($contents);
?> 
