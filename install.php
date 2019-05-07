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
