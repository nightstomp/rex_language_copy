<?php

// GET PARAMS
////////////////////////////////////////////////////////////////////////////////
$myself     = rex_request('page', 'string');
$faceless   = rex_request('faceless', 'string');
$subpage    = rex_request('subpage', 'string');

// Build Subnavigation 
$subpages = $REX['ADDON']['pages'][$myself];

// REX BACKEND LAYOUT TOP
require $REX['INCLUDE_PATH'] . '/layout/top.php';

// TITLE & SUBPAGE NAVIGATION
rex_title($I18N_LC->msg('addon_name').' <span class="addonversion">'.$REX['ADDON']['version'][$myself].'</span>', $subpages);


if(is_object($REX['USER']) AND $REX['USER']->isAdmin()) { // just run if admin
	  
	  // INCLUDE REQUESTED SUBPAGE
	  if(!$subpage) {
	    $subpage = 'content_copy';  /* DEFAULT SUBPAGE */
	  }
	  
	  require $REX['INCLUDE_PATH'] . '/addons/'.$myself.'/pages/'.$subpage.'.inc.php';

} else {
	echo rex_warning($I18N_LC->msg('no_rights'));
}

// REX BACKEND LAYOUT BOTTOM
require $REX['INCLUDE_PATH'] . '/layout/bottom.php';