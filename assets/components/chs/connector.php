<?php
if (file_exists(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php')) {
    /** @noinspection PhpIncludeInspection */
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
}
else {
    require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.core.php';
}
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var CHS $CHS */
$CHS = $modx->getService('chs', 'CHS', $modx->getOption('chs_core_path', null,
        $modx->getOption('core_path') . 'components/chs/') . 'model/chs/'
);
$modx->lexicon->load('chs:default');

// handle request
$corePath = $modx->getOption('chs_core_path', null, $modx->getOption('core_path') . 'components/chs/');
$path = $modx->getOption('processorsPath', $CHS->config, $corePath . 'processors/');
$modx->getRequest();

/** @var modConnectorRequest $request */
$request = $modx->request;
$request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));