#!/usr/bin/php
<?php

// nécessaire à causes des m*rdes que les SPIPiens aiment bien mettre en début de fichier
define('_ECRIRE_INC_VERSION', 'prout');

$options = getopt(
	'f:o:',
	array(
		'file:',
		'output:'
	)
);

$input_file  = $options['f'] ?: $options['file'];
$output_file = $options['o'] ?: $options['output'];

if ((! $input_file) or (! file_exists($input_file)) or (! $output_file)) {

	die('error : bad args');
}

$GLOBALS['idx_lang'] = 'lang2csv';
$GLOBALS['lang2csv'] = array();
include $input_file;
$traductions = $GLOBALS['lang2csv'];

$tableau_csv = array();

foreach ($traductions as $cle => $trad) {
	$tableau_csv[] = array(
		'module' => basename($input_file),
		'chaine_langue' => $cle,
		'texte' => $trad,
	);
}

$handle = fopen($output_file, 'w');

fputcsv($handle, array('module', 'chaîne de langue', 'texte'));

foreach ($tableau_csv as $ligne) {
	fputcsv($handle, $ligne);
}

fclose($handle);
