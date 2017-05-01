<?php

class chsFizikRemoveProcessor extends modObjectRemoveProcessor
{
    public $objectType = 'chsFizik';
    public $classKey = 'chsFizik';
    public $languageTopics = array('chs');
    //public $permission = 'create';

    /**
     * @return bool
     */
    // Если нужно вывести переданные в процессор параметры, раскоментируй блок

    /*public function process() {

        print_r($this->getProperties());
        die();
    }*/

    public function beforeRemove() {
        if (!$this->modx->user->id) return 'Вам нужно авторизоваться';
        if ($this->object->get('uid') != $this->modx->user->id)
            return 'Вы не можете удалять чужие записи';
        return true;
    }


}

return 'chsFizikRemoveProcessor';