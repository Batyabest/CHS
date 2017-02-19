<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;
    /** @var Office $office */
    if ($Office = $modx->getService('office', 'Office', MODX_CORE_PATH . 'components/office/model/office/')) {

        if (!($Office instanceof Office)) {
            $modx->log(xPDO::LOG_LEVEL_ERROR, '[CHS] Could not register paths for Office component!');

            return true;
        } elseif (!method_exists($Office, 'addExtension')) {
            $modx->log(xPDO::LOG_LEVEL_ERROR,
                '[CHS] You need to update Office for support of 3rd party packages!');

            return true;
        }

        /** @var array $options */
        switch ($options[xPDOTransport::PACKAGE_ACTION]) {
            case xPDOTransport::ACTION_INSTALL:
            case xPDOTransport::ACTION_UPGRADE:
                $Office->addExtension('CHS', '[[++core_path]]components/chs/controllers/office/');
                $modx->log(xPDO::LOG_LEVEL_INFO, '[CHS] Successfully registered CHS as Office extension!');
                break;

            case xPDOTransport::ACTION_UNINSTALL:
                $Office->removeExtension('CHS');
                $modx->log(xPDO::LOG_LEVEL_INFO, '[CHS] Successfully unregistered CHS as Office extension.');
                break;
        }
    }
}

return true;