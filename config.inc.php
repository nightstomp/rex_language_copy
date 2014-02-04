<?php
	/**
	 * Language Copy
	 *
	 * @link https://github.com/nightstomp/rex_language_copy
	 *
	 * @author Thomas Göllner, Hirbod Mirjavadi info[at]nightstomp.com
	 *
	 * @package redaxo4.3.x, redaxo4.4.x, redaxo4.5.x
	 * @version 3.0.4
	 */

	// ADDON IDENTIFIER
	$mypage = "rex_language_copy";

	// ADDON VERSION
	////////////////////////////////////////////////////////////////////////////////
	$REX['ADDON'][$myself]['VERSION'] = array
	(
	'VERSION' => 1,
	'MINORVERSION' => 5,
	'SUBVERSION' => 0
	);

	// unique id
	$REX['ADDON']['rxid'][$mypage] = '1150';
	// foldername
	$REX['ADDON']['page'][$mypage] = $mypage;    
	$REX['ADDON']['version'][$myself] = implode('.', $REX['ADDON'][$myself]['VERSION']);
	$REX['ADDON']['author'][$myself] = 'Thomas Göllner, Hirbod Mirjavadi';
	$REX['ADDON']['name'][$mypage] = 'Language Copy';
	$REX['ADDON']['perm'][$mypage] = 'rex_language_copy[]';
	$REX['PERM'][] = 'rex_language_copy[]';

	// CREATE LANG OBJ FOR THIS ADDON
	if($REX['REDAXO']){
		$I18N_LC = new i18n($REX['LANG'],$REX['INCLUDE_PATH']."/addons/$mypage/lang");
	}


?>