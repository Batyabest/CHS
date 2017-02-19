<?php

class CHSItemCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'CHSItem';
    public $classKey = 'CHSItem';
    public $languageTopics = array('chs');
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $name = trim($this->getProperty('name'));
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('chs_item_err_name'));
        } elseif ($this->modx->getCount($this->classKey, array('name' => $name))) {
            $this->modx->error->addField('name', $this->modx->lexicon('chs_item_err_ae'));
        }

        return parent::beforeSet();
    }

}

return 'CHSItemCreateProcessor';