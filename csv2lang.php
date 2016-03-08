#!/usr/bin/php
<?php

$options = getopt(
	'f:o:ic:t:',
	array(
		'file:',
		'output:',
		'ignore-first-line',
	)
);

$input_file  = $options['f'] ?: $options['file'];
$output_file = $options['o'] ?: $options['output'];
if (isset($options['i'])) {
	$ignore_first_line = $options['i'];
} elseif (isset($options['ignore-first-line'])) {
	$ignore_first_line = $options['ignore-first-line'];
} else {
	$ignore_first_line = false;
}

$col_chaines2langue = $options['c'] ?: 1;
$col_traductions    = $options['t'] ?: 2;

if ((! $input_file) or (! file_exists($input_file)) or (! $output_file)) {

	die('error : bad args');
}

$handle = fopen($input_file, 'r');

$csv = array();

while ($ligne = fgetcsv($handle)) {
	$csv[] = $ligne;
}

fclose($handle);

if ($ignore_first_line) {
	array_shift($csv);
}

$header = '<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP

if (!defined(\'_ECRIRE_INC_VERSION\')) {
	return;
}

$GLOBALS[$GLOBALS[\'idx_lang\']] = array(
';

$footer = ');
';

$handle = fopen($output_file, 'w');

fwrite($handle, $header);

foreach ($csv as $ligne) {
	fwrite(
		$handle,
		sprintf(
			"\t'%s' => '%s',\n",
			$ligne[$col_chaines2langue],
			str_replace("'", "\'", $ligne[$col_traductions])
		)
	);
}

fwrite($handle, $footer);

fclose($handle);
