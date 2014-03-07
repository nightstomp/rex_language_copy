<?php
	/**
	 * Language Copy
	 *
	 * @link https://github.com/nightstomp/rex_language_copy
	 *
	 * @author Thomas Göllner, Hirbod Mirjavadi info[at]nightstomp.com
	 *
	 * @package redaxo4.3.x, redaxo4.4.x, redaxo4.5.x
	 * @version 2.0
	 */

	// ADDON IDENTIFIER
	$mypage = "rex_language_copy";

	// ADDON VERSION
	////////////////////////////////////////////////////////////////////////////////
	$REX['ADDON'][$mypage]['VERSION'] = array
	(
	'VERSION' => 2,
	'MINORVERSION' => 0,
	'SUBVERSION' => 1
	);

	$I18N_LC = new i18n($REX['LANG'],$REX['INCLUDE_PATH']."/addons/".$mypage."/lang");

	// unique id
	$REX['ADDON']['rxid'][$mypage] = '1150';
	// foldername
	$REX['ADDON']['page'][$mypage] = $mypage;    
	$REX['ADDON']['version'][$mypage] = implode('.', $REX['ADDON'][$mypage]['VERSION']);
	$REX['ADDON']['author'][$mypage] = 'Thomas Göllner, Hirbod Mirjavadi';
	$REX['ADDON']['name'][$mypage] = $I18N_LC->msg('addon_name');
	$REX['ADDON']['perm'][$mypage] = 'rex_language_copy[]';
	$REX['ADDON']['perm'][$mypage] = 'admin[]';


	// CREATE LANG OBJ FOR THIS ADDON
	if($REX['REDAXO'] && rex_request('page') == $mypage){

		  $REX['ADDON']['pages'][$mypage] = array(
		    array('', $I18N_LC->msg('copy_content')),
		    array('meta_copy', $I18N_LC->msg('copy_meta'))
		  );
	}


?>
