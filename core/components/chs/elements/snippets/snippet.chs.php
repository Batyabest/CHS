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

// Получаем свойства и, если нужно, модернизируем их
$tpl = $modx->getOption('tpl', $scriptProperties, 'FileItemTpl');
$limit = $modx->getOption('limit', $scriptProperties);
$uid = $modx->getOption('uid', $scriptProperties, $modx->user->get('id'));
$showAll = $modx->getOption('showAll', $scriptProperties);


//print "<pre>";
//print_r($limit);
//print "</pre>";

if ($showAll == 1) {
	$pdoFetch->setConfig(array(
		'class' => 'chsFizik',
		'loadModels' => 'chs',
		'select' => '*',
		'return' => 'data',
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
			'uid' => $uid
		),
		'limit' => $limit,
	));

}
$rows = $pdoFetch->run();

//print "<pre>";
//print_r(count($rows));
//print "</pre>";
$modx->toPlaceholder('count',count($rows),'chs');
foreach ($rows as $row) {
	$output .= $pdoFetch->getChunk($tpl, $row);
}

return $output;