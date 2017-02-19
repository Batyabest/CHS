<?php

if ($object->xpdo) {
    /* @var modX $modx */
    $modx =& $object->xpdo;

    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
            $modelPath = $modx->getOption('chs_core_path' ,null,$modx->getOption('core_path').'components/chs/').'model/';
            $modx->addPackage('chs',$modelPath);

            $manager = $modx->getManager();
            $objects = array (
                'chsFizik',
                'chsYurik',
            );
            foreach ($objects as $object) {
                $manager->createObjectContainer($object);
            }
            break;

        case xPDOTransport::ACTION_UPGRADE:
            break;

        case xPDOTransport::ACTION_UNINSTALL:
            break;
    }
}
return true;