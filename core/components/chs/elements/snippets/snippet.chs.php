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
$tpl = $modx->getOption('tpl', $scriptProperties);
$limit = $modx->getOption('limit', $scriptProperties);
$uid = $modx->getOption('uid', $scriptProperties, $modx->user->get('id'));
$rid = $_GET['rid'];
$showAll = $modx->getOption('showAll', $scriptProperties);
$editItem = $modx->getOption('editItem', $scriptProperties);
$active = $modx->getOption('active', $scriptProperties);


if ($showAll == 1) {
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

else {

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

if ($editItem == 1) {
	$pdoFetch->setConfig(array(
		'class' => 'chsFizik',
		'loadModels' => 'chs',
		'select' => '*',
		'return' => 'data',
		'where' => array(
			'id' => $rid
		),
		'limit' => $limit,
	));
}


$rows = $pdoFetch->run();

if (count($rows) == 0) {
	$modx->toPlaceholder('count', count($rows), 'chs');
	$output = "<p>У Вас пока нет ни одной публикации</p>";
}
else if ($editItem == 1) {
	foreach ($rows as $row) {

	}
	$modx->toPlaceholder('id', $row['id'], 'chs');
	$modx->toPlaceholder('uid', $row['uid'], 'chs');
	$modx->toPlaceholder('name', $row['name'], 'chs');
	$modx->toPlaceholder('secondname', $row['secondname'], 'chs');
	$modx->toPlaceholder('family', $row['family'], 'chs');
	$modx->toPlaceholder('city_name', $row['city_name'], 'chs');
	$modx->toPlaceholder('organization', $row['organization'], 'chs');
	$modx->toPlaceholder('number_auto', $row['number_auto'], 'chs');
	$modx->toPlaceholder('description', $row['description'], 'chs');
	$modx->toPlaceholder('image', $row['image'], 'chs');
	$modx->toPlaceholder('phone', $row['phone'], 'chs');
	$modx->toPlaceholder('active', $row['active'], 'chs');
	$output = '';
}
else {
	$modx->toPlaceholder('count', count($rows), 'chs');
	foreach ($rows as $row) {
		$output .= $pdoFetch->getChunk($tpl, $row);
	}
}
return $output;