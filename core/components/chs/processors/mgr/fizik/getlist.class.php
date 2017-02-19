<?php

class chsFizikGetListProcessor extends modObjectGetListProcessor
{
    public $objectType = 'chsFizik';
    public $classKey = 'chsFizik';
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'ASC';
    //public $permission = 'list';


    /**
     * We do a special check of permissions
     * because our objects is not an instances of modAccessibleObject
     *
     * @return boolean|string
     */
    public function beforeQuery()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

        return true;
    }


    /**
     * @param xPDOQuery $c
     *
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $query = trim($this->getProperty('query'));
        if ($query) {
            $c->where(array(
                'name:LIKE' => "%{$query}%",
                'OR:description:LIKE' => "%{$query}%",
            ));
        }

        return $c;
    }


    /**
     * @param xPDOObject $object
     *
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        $array = $object->toArray();
        $array['actions'] = array();

        // Edit
        $array['actions'][] = array(
            'cls' => '',
            'icon' => 'icon icon-edit',
            'title' => $this->modx->lexicon('chs_fizik_update'),
            //'multiple' => $this->modx->lexicon('chs_fiziks_update'),
            'action' => 'updateFizik',
            'button' => true,
            'menu' => true,
        );

        if (!$array['active']) {
            $array['actions'][] = array(
                'cls' => '',
                'icon' => 'icon icon-power-off action-green',
                'title' => $this->modx->lexicon('chs_fizik_enable'),
                'multiple' => $this->modx->lexicon('chs_fiziks_enable'),
                'action' => 'enableFizik',
                'button' => true,
                'menu' => true,
            );
        } else {
            $array['actions'][] = array(
                'cls' => '',
                'icon' => 'icon icon-power-off action-gray',
                'title' => $this->modx->lexicon('chs_fizik_disable'),
                'multiple' => $this->modx->lexicon('chs_fiziks_disable'),
                'action' => 'disableFizik',
                'button' => true,
                'menu' => true,
            );
        }

        // Remove
        $array['actions'][] = array(
            'cls' => '',
            'icon' => 'icon icon-trash-o action-red',
            'title' => $this->modx->lexicon('chs_fizik_remove'),
            'multiple' => $this->modx->lexicon('chs_fiziks_remove'),
            'action' => 'removeFizik',
            'button' => true,
            'menu' => true,
        );

        return $array;
    }

}

return 'chsFizikGetListProcessor';