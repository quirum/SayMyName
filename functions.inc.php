<?php /* $Id: $ */
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed');}


if ( (isset($amp_conf['ASTVARLIBDIR'])?$amp_conf['ASTVARLIBDIR']:'') == '') {
	$astlib_path = "/var/lib/asterisk";
} else {
	$astlib_path = $amp_conf['ASTVARLIBDIR'];
}
$tts_astsnd_path = $astlib_path."/sounds/ttsng/";


if ( $tts_agi = file_exists($astlib_path."/agi-bin/saymynamene.agi") ) {
	//tts_findengines();
} else {
	$tts_agi_error = _("AGI script not found");
}

// returns a associative arrays with keys 'destination' and 'description'
function saymynamene_destinations() {
	$results = \FreePBX::SayMyNameNe()->listTTS();

	// return an associative array with destination and description
	if (isset($results) && $results){
		foreach($results as $result){
				$extens[] = array('destination' => 'ext-saymynamene,'.$result['id'].',1', 'description' => $result['name']);
		}

		return $extens;
	} else {
		return null;
	}
}

function saymynamene_getdestinfo($dest) {
	global $amp_conf;
		if (substr(trim($dest),0,8) == 'ext-saymynamene,') {
			$tts = explode(',',$dest);
				$tts = $tts[1];
				$thistts = saymynamene_get($tts);
				if (empty($thistts)) {
					return array();
				} else {
						return array('description' => sprintf(_("Say My Name with Dial: %s"),$thistts['name']),
							'edit_url' => 'config.php?display=saymynamene&view=form&id='.urlencode($tts),
							);
				}
	} else {
			return false;
		}
}

function saymynamene_get_config($p_var) {
	global $ext;

	switch($p_var) {
		case "asterisk":
			$contextname = 'ext-saymynamene';
			if ( is_array($tts_list = \FreePBX::SayMyNameNe()->listTTS()) ) {
				foreach($tts_list as $item) {
					$tts = saymynamene_get($item['id']);
					$ttsid = $tts['id'];
					$ttsname= $tts['name'];
					$ttstext_it = $tts['text_IT'];
					$ttstext_en = $tts['text_EN'];
					$ttsgoto = $tts['goto'];
					$textnotfound_it = $tts['textnotfound_IT'];
					$textnotfound_en = $tts['textnotfound_EN'];
					$textbusy_it = $tts['textbusy_IT'];
					$textbusy_en = $tts['textbusy_EN'];
					$textbusynf_it = $tts['textbusyNF_IT'];
					$textbusynf_en = $tts['textbusyNF_EN'];
					$silence_t = $tts['silence_t'];
					$drop_t = $tts['drop_t'];
					$fade_t = $tts['fade_t'];
					$music = $tts['music'];
					$ttsengine = $tts['engine'];
					$ttspath = ttsng_get_ttsengine_path($ttsengine);
					$ext->add($contextname, $ttsid, '', new ext_noop('TTS SayMyNameNe: '.$ttsname));
					$ext->add($contextname, $ttsid, '', new ext_chanisavail('SIP/2${CDR(did):-2}'));
					$ext->add($contextname, $ttsid, '', new ext_noop('AVAILCHAN: ${AVAILCHAN}, AVAILORIGCHAN: ${AVAILORIGCHAN}, AVAILSTATUS: ${AVAILSTATUS}, AVAILCAUSECODE: ${AVAILCAUSECODE}',5));
					$ext->add($contextname, $ttsid, '', new ext_answer());
					$ext->add($contextname, $ttsid, '', new ext_setmusiconhold($music));
					$ext->add($contextname, $ttsid, '', new ext_agi('saymynamene.agi,"'.$ttstext_it.'","'.$textnotfound_it.'",' .
																	'"'.$ttstext_en.'","'.$textnotfound_en.'",' .
																	'"'.$textbusy_it.'","'.$textbusy_en.'",' .
																	'"'.$textbusynf_it.'","'.$textbusynf_en.'",${AVAILSTATUS},2${CDR(did):-2},' .
																	$silence_t.','.$drop_t.','.$fade_t.',' .
																	$music.','.$ttsengine.','.$ttspath['path']));
					$ext->add($contextname, $ttsid, '', new ext_setmusiconhold('default'));
					$ext->add($contextname, $ttsid, 'nextstep', new ext_goto($ttsgoto));
				}
			}
		break;
	}
}

function saymynamene_get_ttsengine_path($engine) {
	if (function_exists('ttsengines_get_engine_path')) {
		return ttsengines_get_engine_path($engine);
	} else {
		return "/invalid/filename";
	}
}

function saymynamene_list() {
	dbug('tts_list has been moved in to BMO Tts->listTTS()');
	return \FreePBX::SayMyNameNe()->listTTS();
}

function saymynamene_get($p_id) {
	global $db;

	$sql = "SELECT id, name, text_IT, goto, textnotfound_IT, text_EN, textnotfound_EN, 
			textbusy_EN, textbusy_IT, textbusyNF_IT, textbusyNF_EN, 
			silence_t, drop_t, fade_t, music, engine FROM saymynamene WHERE id=$p_id";
	$res = $db->getRow($sql, DB_FETCHMODE_ASSOC);
	return $res;
}

function saymynamene_del($p_id) {
	$dbh = \FreePBX::Database();
	$sql = 'DELETE FROM saymynamene WHERE id = ?';
	$stmt = $dbh->prepare($sql);
	return $stmt->execute(array($p_id));
}

function saymynamene_add(	$p_name, $p_text_it, $p_goto, $p_textnotfound_it, $p_text_en, $p_textnotfound_en, $p_textbusy_en, $p_textbusy_it,
						$p_textbusynf_en, $p_textbusynf_it, $p_silence_t, $p_drop_t, $p_fade_t,	$p_moh, $p_engine) {
	global $db;

	$tts_list = \FreePBX::SayMyNameNe()->listTTS();
	if (is_array($tts_list)) {
		foreach ($tts_list as $tts) {
			if ($tts['name'] === $p_name) {
				echo "<script>javascript:alert('"._("This name already exists")."');</script>";
				return false;
			}
		}
	}
	$results = sql(	"INSERT INTO saymynamene SET name=".sql_formattext($p_name) .
					" , text_IT=".sql_formattext($p_text_it).", goto=".sql_formattext($p_goto) .
					" , textnotfound_IT=".sql_formattext($p_textnotfound_it) .
					" , text_EN=".sql_formattext($p_text_en) .
					" , textnotfound_EN=".sql_formattext($p_textnotfound_en) .
					" , textbusy_EN=".sql_formattext($p_textbusy_en) .
					" , textbusy_IT=".sql_formattext($p_textbusy_it) .
					" , textbusyNF_EN=".sql_formattext($p_textbusynf_en) .
					" , textbusyNF_IT=".sql_formattext($p_textbusynf_it) .
					" , silence_t=".sql_formattext($p_silence_t) .
					" , drop_t=".sql_formattext($p_drop_t) .
					" , fade_t=".sql_formattext($p_fade_t) .
					" , music=".sql_formattext($p_moh) .
					" , engine=".sql_formattext($p_engine));

	return $db->insert_id();
}

function saymynamene_update(	$p_id, $p_name, $p_text_it, $p_goto, $p_textnotfound_it, $p_text_en, $p_textnotfound_en, 
							$p_textbusy_en, $p_textbusy_it, $p_textbusynf_en, $p_textbusynf_it, 
							$p_silence_t, $p_drop_t, $p_fade_t, $p_moh, $p_engine) {
	$results = sql(	"UPDATE saymynamene SET name=".sql_formattext($p_name) .
					", text_IT=".sql_formattext($p_text_it).", goto=".sql_formattext($p_goto) .
					", textnotfound_IT=".sql_formattext($p_textnotfound_it) .
					", text_EN=".sql_formattext($p_text_en) .
					", textnotfound_EN=".sql_formattext($p_textnotfound_en) .
					", textbusy_EN=".sql_formattext($p_textbusy_en) .
					", textbusy_IT=".sql_formattext($p_textbusy_it) .
					", textbusyNF_EN=".sql_formattext($p_textbusynf_en) .
					", textbusyNF_IT=".sql_formattext($p_textbusynf_it) .
					", silence_t=".sql_formattext($p_silence_t) .
					", drop_t=".sql_formattext($p_drop_t) .
					", fade_t=".sql_formattext($p_fade_t) .
					", music=".sql_formattext($p_moh) .
					", engine=".sql_formattext($p_engine)." WHERE id=".$p_id);
}

?>
