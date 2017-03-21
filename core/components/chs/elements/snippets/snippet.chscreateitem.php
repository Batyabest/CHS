<?php
/** @var array $scriptProperties */
/** @var chs $CHS */
$CHS = $modx->getService('chs', 'chs', $modx->getOption('chs_core_path', null, $modx->getOption('core_path') . 'components/chs/') . 'model/chs/', $scriptProperties);
/** @var pdoFetch $pdoFetch */
$pdoFetch = $modx->getService('pdoFetch');

if (!($CHS instanceof CHS) || !($pdoFetch instanceof pdoFetch)) return '';

/* Ajax проверка на заполненность полей */
if (!empty($_POST['name'])) {
	$processor = 'web/create';
	$processorProps = array('processors_path' => $modx->getOption('core_path') . 'components/chs/processors/');
	$response = $modx->runProcessor($processor, $_POST, $processorProps);

	return $AjaxForm->success('Спасибо, данные занесены успешно');
}