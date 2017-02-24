<?php
/** @var array $scriptProperties */
/** @var chs $CHS */
$CHS = $modx->getService('chs', 'chs', $modx->getOption('chs_core_path', null, $modx->getOption('core_path') . 'components/chs/') . 'model/chs/', $scriptProperties);
/** @var pdoFetch $pdoFetch */
$pdoFetch = $modx->getService('pdoFetch');

if (!($CHS instanceof CHS) || !($pdoFetch instanceof pdoFetch)) return '';

if (!$modx->user->isAuthenticated($modx->context->key)) {
	return $modx->lexicon('chs_err_auth_req');
}
$id = $_GET['id'];

$pdoFetch->setConfig(array(
	'class' => 'chsFizik',
	'loadModels' => 'chs',
	'leftJoin' => array(
		'Profile' => array(
			'class' => 'modUserProfile',
			'on' => 'chsFizik.uid = Profile.internalKey',
		),
	),
	'select' => array(
		'chsFizik' => '*',
		'Profile' => 'mobilephone,email',
	),
	'return' => 'data',
	'where' => array(
		'chsFizik.id' => $id
	),
));

$rows = $pdoFetch->run();
//print "<pre>";
//print_r($rows);
//print "</pre>";
foreach ($rows as $row) {
	$output .= $pdoFetch->getChunk($tpl, $row);
	//$output .= print_r($pdoFetch->getTime(), 1);
}

return $output;