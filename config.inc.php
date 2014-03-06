<?php
	/**
	 * Language Copy
	 *
	 * @link https://github.com/nightstomp/rex_language_copy
	 *
	 * @author Thomas Göllner, Hirbod Mirjavadi info[at]nightstomp.com
	 *
	 * @package redaxo4.3.x, redaxo4.4.x, redaxo4.5.x
	 * @version 1.5.2
	 */

	// ADDON IDENTIFIER
	$mypage = "rex_language_copy";

	// ADDON VERSION
	////////////////////////////////////////////////////////////////////////////////
	$REX['ADDON'][$mypage]['VERSION'] = array
	(
	'VERSION' => 1,
	'MINORVERSION' => 5,
	'SUBVERSION' => 2
	);

	// unique id
	$REX['ADDON']['rxid'][$mypage] = '1150';
	// foldername
	$REX['ADDON']['page'][$mypage] = $mypage;    
	$REX['ADDON']['version'][$mypage] = implode('.', $REX['ADDON'][$mypage]['VERSION']);
	$REX['ADDON']['author'][$mypage] = 'Thomas Göllner, Hirbod Mirjavadi';
	$REX['ADDON']['name'][$mypage] = 'Language Copy';
	$REX['ADDON']['perm'][$mypage] = 'rex_language_copy[]';
	$REX['PERM'][] = 'rex_language_copy[]';

	// CREATE LANG OBJ FOR THIS ADDON
	if($REX['REDAXO']){
		$I18N_LC = new i18n($REX['LANG'],$REX['INCLUDE_PATH']."/addons/$mypage/lang");
	}


?>
