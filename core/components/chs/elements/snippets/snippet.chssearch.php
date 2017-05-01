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
$query = $modx->getOption('query', $_POST, '', true); // Получаем поисковый запрос с простого поиска
// Получаем параметры см расгширенного поиска
$rsearch = $modx->getOption('rsearch', $_POST, '', true);
$search_name = $modx->getOption('search_name', $_POST, '', true);
$search_family = $modx->getOption('search_family', $_POST, '', true);
$search_organization = $modx->getOption('search_organization', $_POST, '', true);
$search_city = $modx->getOption('search_city', $_POST, '', true);

//print "<pre>";
//print_r($_POST);
//print "</pre>";

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

else if ($rsearch == 1) {
	$pdoFetch->setConfig(array(
		'class' => 'chsFizik',
		'loadModels' => 'chs',
		'select' => '*',
		'return' => 'data',
		'where' => array(
			'active' => $active,
			'name:LIKE' => $search_name,
			'family:LIKE' => $search_family,
			'organization:LIKE' => $search_organization,
			'city_name:LIKE' => $search_city,
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
			'name:LIKE' => $query,
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