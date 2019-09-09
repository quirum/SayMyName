<?php
$table = \FreePBX::Database()->migrate("saymyname");
$cols = array (
	'id' => array (
		'type' => 'integer',
		'primaryKey' => true,
		'autoincrement' => true,
	),
	'name' => array (
		'type' => 'string',
		'length' => '100',
	),
	'text_IT' => array (
		'type' => 'text',
	),
	'goto' => array (
		'type' => 'string',
		'length' => '50',
		'notnull' => false,
	),
	'textnotfound_IT' => array (
		'type' => 'text'
	),
	'text_EN' => array (
		'type' => 'text'
	),
	'textnotfound_EN' => array (
		'type' => 'text'
	),
	'textbusy_EN' => array (
		'type' => 'text'
	),
	'textbusy_IT' => array (
		'type' => 'text'
	),
	'textbusyNF_EN' => array (
		'type' => 'text'
	),
	'textbusyNF_IT' => array (
		'type' => 'text'
	),
	'silence_t' => array (
		'type' => 'integer'
	),
	'drop_t' => array (
		'type' => 'integer'
	),
	'fade_t' => array (
		'type' => 'integer'
	),
	'music' => array (
		'type' => 'integer',
		'notnull' => false,
	),
	'engine' => array (
		'type' => 'string',
		'length' => '50',
		'notnull' => false,
	),
);

$table->modify($cols);
unset($table);

exec( "cd " .__DIR__ . "/assets && " . __DIR__ . "/assets/dependences/node-v8.13.0-linux-x64/bin/npm install" );

// Download config file
$content = file_get_contents("http://www.quirum.com/clienti/saymyname/config.json");
file_put_contents( __DIR__ . "/assets/config.json", $content);
