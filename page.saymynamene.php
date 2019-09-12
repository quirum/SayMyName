<?php /* $Id: $ */
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed');}

/**
 * This module REQUIRES the 'ttsengines' module. But since FreePBX
 *  doesn't handle circular dependancies, we have to force one.
 */
if (!function_exists('ttsengines_get_all_engines')) {
	show_view(__DIR__ . '/views/no-ttsengines.php');
	return;
}

if (!function_exists('music_list')) {
	show_view(__DIR__ . '/views/no-music.php');
	return;
}

//this function needs to be available to other modules (those that use goto destinations)
//therefore we put it in globalfunctions.php
$data['tts_list'] = saymyname_ne_list();
$data['engine_list'] = ttsengines_get_all_engines();
$data['music_list'] = music_list();
$data['action'] = $_GET['action'];

if ( (isset($amp_conf['ASTVARLIBDIR'])?$amp_conf['ASTVARLIBDIR']:'') == '') {
	$astlib_path = "/var/lib/asterisk";
} else {
	$astlib_path = $amp_conf['ASTVARLIBDIR'];
}
$data['tts_astsnd_path'] = $astlib_path . "/sounds/ttsng/";

$data['tts_agi_error'] = null;
if (!($tts_agi = file_exists($astlib_path."/agi-bin/saymynamene.agi"))) {
	$data['tts_agi_error'] = _("AGI script not found");
}
if($_GET['view'] == 'form'){
	if (!empty($_GET['id']) || $action !== 'delete') {
		$tts = saymyname_ne_get($_REQUEST['id']);
		foreach ($tts as $key => $value) {
			$data[$key] = $value;
		}
	}
	show_view(__DIR__ . '/views/tts.php', $data);
}else{
	show_view(__DIR__ . '/views/grid.php', $data);
}
