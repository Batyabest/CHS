<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
/** @var array $scriptProperties */
/** @var chs $CHS */
$CHS = $modx->getService('chs', 'chs', $modx->getOption('chs_core_path', null, $modx->getOption('core_path') . 'components/chs/') . 'model/chs/', $scriptProperties);
/** @var pdoFetch $pdoFetch */
$pdoFetch = $modx->getService('pdoFetch');

if (!($CHS instanceof CHS) || !($pdoFetch instanceof pdoFetch)) return '';

/*if (!$modx->user->isAuthenticated($modx->context->key)) {
	return $modx->lexicon('chs_err_auth_req');
}*/

// Получаем свойства и, если нужно, модернизируем их
$tpl = $modx->getOption('tpl', $scriptProperties);
$limit = $modx->getOption('limit', $scriptProperties);
$uid = $modx->getOption('uid', $scriptProperties, $modx->user->get('id'));
if (!empty($_GET['rid'])) {
	$rid = $_GET['rid'];
}
$showAll = $modx->getOption('showAll', $scriptProperties);
$editItem = $modx->getOption('editItem', $scriptProperties);
$active = $modx->getOption('active', $scriptProperties);



if ($showAll != 1) {
	$pdoFetch->setConfig(array(
		'class' => 'chsFizik',
		'loadModels' => 'chs',
		'select' => '*',
		'return' => 'data',
		'where' => array(
			'uid' => $uid,
			'active' => $active,
		),
		'limit' => $limit,
	));
}


else {

	$pdoFetch->setConfig(array(
		'class' => 'chsFizik',
		'loadModels' => 'chs',
		'select' => '*',
		'return' => 'data',
		'where' => array(
			'active' => $active,
		),
		'limit' => $limit,
	));

}

$rows = $pdoFetch->run();
	$modx->toPlaceholder('count', count($rows), 'chs');
	foreach ($rows as $row) {
		$output .= $pdoFetch->getChunk($tpl, $row);
	}

return $output;