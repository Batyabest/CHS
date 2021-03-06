<?php

class CHSOfficeItemEnableProcessor extends modObjectProcessor
{
    public $objectType = 'CHSItem';
    public $classKey = 'CHSItem';
    public $languageTopics = array('chs');
    //public $permission = 'save';


    /**
     * @return array|string
     */
    public function process()
    {
        if (!$this->checkPermissions()) {
            return $this->failure($this->modx->lexicon('access_denied'));
        }

        $ids = $this->modx->fromJSON($this->getProperty('ids'));
        if (empty($ids)) {
            return $this->failure($this->modx->lexicon('chs_item_err_ns'));
        }

        foreach ($ids as $id) {
            /** @var CHSItem $object */
            if (!$object = $this->modx->getObject($this->classKey, $id)) {
                return $this->failure($this->modx->lexicon('chs_item_err_nf'));
            }

            $object->set('active', true);
            $object->save();
        }

        return $this->success();
    }

}

return 'CHSOfficeItemEnableProcessor';
