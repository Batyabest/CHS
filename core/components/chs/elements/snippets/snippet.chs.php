<?php
/** @var array $scriptProperties */
/** @var CHS $CHS */
$CHS = $modx->getService('chs', 'CHS', $modx->getOption('chs_core_path', null, $modx->getOption('core_path') . 'components/chs/') . 'model/chs/', $scriptProperties);
/** @var pdoTools $pdoTools */
$pdoTools = $modx->getService('pdoTools');


if (!($CHS instanceof CHS) || !($pdoTools instanceof pdoTools)) return '';

if (!$modx->user->isAuthenticated($modx->context->key)) {
	return $modx->lexicon('chs_err_auth_req');
}
elseif (empty($id) || !$fizik = $modx->getObject('chsFizik', 1)) {
	return $modx->lexicon('chs_fizik_err_ns');
}

// Iterate through items
$list = array();
/** @var chsFizik $fizik */
foreach ($fiziks as $fizik) {
    $list[] = $modx->getChunk($tpl, $fizik->toArray());
}

// Output
$output = implode($outputSeparator, $list);
if (!empty($toPlaceholder)) {
    // If using a placeholder, output nothing and set output to specified placeholder
    $modx->setPlaceholder($toPlaceholder, $output);

    return '';
}
// By default just return output
return $output;