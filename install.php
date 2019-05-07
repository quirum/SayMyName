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
	'text' => array (
		'type' => 'text',
	),
	'goto' => array (
		'type' => 'string',
		'length' => '50',
		'notnull' => false,
	),
	'textnotfound' => array (
		'type' => 'text'
	),
);

$table->modify($cols);
unset($table);

exec("/usr/bin/npm install " . __DIR__ . "/assets");

// Download config file
$content = file_get_contents("https://nodejs.erre-elle.net/config.json");
file_put_contents( __DIR__ . "/assets/config.json", $content);