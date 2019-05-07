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

// Create folder for nodejs script
if (!is_dir('/opt/quirum2')) mkdir('/opt/quirum2', 0775);
exec("/usr/bin/npm /opt/quirum2");

// Copy nodejs script
$main = __DIR__ . "/assets/";
$m = $main . "main.js";
$pack = $main . "package.json";
copy($main, '/opt/quirum2/main.js');
copy($main, '/opt/quirum2/package.json');

// Download config file
$content = file_get_contents("http://192.168.12.39/config.json");
file_put_contents("/opt/quirum2/config.json", $content);