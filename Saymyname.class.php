<?php
// vim: set ai ts=4 sw=4 ft=php:
namespace FreePBX\modules;

class SayMyName extends \FreePBX_Helpers implements \BMO {

	public function __construct($freepbx = null) {
		$this->freepbx = $freepbx;
		$this->db = $freepbx->Database;
	}

	public function install() {

	}
	public function uninstall() {

	}
	public function backup(){

	}
	public function restore($backup){

	}
	public function doConfigPageInit() {
		$request = array(
			'action',
			'id',
			'goto0',
			'name',
			'text_IT',
			'textnotfound_IT',
			'text_EN',
			'textnotfound_EN',
			'textbusy_EN',
			'textbusy_IT',
			'textbusyNF_EN',
			'textbusyNF_IT',
			'silence_t',
			'drop_t',
			'fade_t',
			'music',
			'engine'
		);
		$vars = array();
		$goto = null;

		foreach($request as $key) {
			$vars[$key] = isset($_REQUEST[$key]) ? $_REQUEST[$key] : null;
		}

		if (isset($vars['goto0']) && isset($_REQUEST[$vars['goto0']."0"])) {
			$goto = $_REQUEST[$vars['goto0']."0"];
		}

		switch ($vars['action']) {
			case "add":
				$_REQUEST['id'] = \saymyname_add(	$vars['name'], $vars['text_IT'], $goto, $vars['textnotfound_IT'], 
													$vars['text_EN'], $vars['textnotfound_EN'], 
													$vars['textbusy_EN'], $vars['textbusy_IT'], 
													$vars['textbusyNF_EN'], $vars['textbusyNF_IT'], $vars['silence_t'],
													$vars['drop_t'], $vars['fade_t'], $vars['music'], $vars['engine']);
				\needreload();
			break;
			case "delete":
				\saymyname_del($vars['id']);
				$_REQUEST['id'] = null;
				\needreload();
			break;
			case "edit":
				\saymyname_update(	$vars['id'], $vars['name'], $vars['text_IT'], $goto, $vars['textnotfound_IT'], 
									$vars['text_EN'], $vars['textnotfound_EN'], 
									$vars['textbusy_EN'], $vars['textbusy_IT'], 
									$vars['textbusyNF_EN'], $vars['textbusyNF_IT'], $vars['silence_t'],
									$vars['drop_t'], $vars['fade_t'], $vars['music'], $vars['engine']);
				\needreload();
			break;
		}
	}
	public function listTTS(){
		$sql = "SELECT * FROM saymyname ORDER BY name";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$res = $stmt->fetchall(\PDO::FETCH_ASSOC);
		if(!$res) {
			return array();
		}
		return $res;
	}
	public function getActionBar($request) {
		$buttons = array();
		switch($request['view']) {
			case 'form':
				$buttons = array(
					'delete' => array(
						'name' => 'delete',
						'id' => 'delete',
						'value' => _("Delete")
					),
					'reset' => array(
						'name' => 'reset',
						'id' => 'reset',
						'value' => _("Reset")
					),
					'submit' => array(
						'name' => 'submit',
						'id' => 'submit',
						'value' => _("Submit")
					)
				);
				break;
			default:
				break;
		}
		return $buttons;
	}
	public function getRightNav($request) {
		if(!empty($_GET['view']) && $_GET['view'] == 'form'){
	  	return load_view(__DIR__."/views/rnav.php",array());
		}
	}
	public function ajaxRequest($req, &$setting) {
		switch ($req) {
			case 'getJSON':
				return true;
			break;
			default:
				return false;
			break;
		}
	}
	public function ajaxHandler(){
		switch ($_REQUEST['command']) {
			case 'getJSON':
				switch ($_REQUEST['jdata']) {
					case 'grid':
						return $this->listTTS();
					break;

					default:
						return false;
					break;
				}
			break;

			default:
				return false;
			break;
		}
	}
}
