<?php
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed');}

global $db;

if ( (isset($amp_conf['ASTVARLIBDIR'])?$amp_conf['ASTVARLIBDIR']:'') == '') {
	$astlib_path = "/var/lib/asterisk";
	$script_path = "";
} else {
	$astlib_path = $amp_conf['ASTVARLIBDIR'];
}

if ( file_exists($astlib_path."/agi-bin/saymynamene.agi") ) {
	if ( !unlink($astlib_path."/agi-bin/saymynamene.agi") ) {
		echo _("SayMyNameNe AGI script cannot be removed.");
	}
}

echo "dropping table saymyname_ne..";
sql("DROP TABLE IF EXISTS `saymyname_ne`");
echo "done<br>\n";

