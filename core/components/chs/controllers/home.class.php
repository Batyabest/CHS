<?php

/**
 * The home manager controller for CHS.
 *
 */
class CHSHomeManagerController extends modExtraManagerController
{
    /** @var CHS $CHS */
    public $CHS;


    /**
     *
     */
    public function initialize()
    {
        $path = $this->modx->getOption('chs_core_path', null,
                $this->modx->getOption('core_path') . 'components/chs/') . 'model/chs/';
        $this->CHS = $this->modx->getService('chs', 'CHS', $path);
        parent::initialize();
    }


    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return array('chs:default');
    }


    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('chs');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->CHS->config['cssUrl'] . 'mgr/main.css');
        $this->addCss($this->CHS->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
        $this->addJavascript($this->CHS->config['jsUrl'] . 'mgr/chs.js');
        $this->addJavascript($this->CHS->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->CHS->config['jsUrl'] . 'mgr/misc/combo.js');
        $this->addJavascript($this->CHS->config['jsUrl'] . 'mgr/widgets/items.grid.js');
        $this->addJavascript($this->CHS->config['jsUrl'] . 'mgr/widgets/items.windows.js');
        $this->addJavascript($this->CHS->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->CHS->config['jsUrl'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
        CHS.config = ' . json_encode($this->CHS->config) . ';
        CHS.config.connector_url = "' . $this->CHS->config['connectorUrl'] . '";
        Ext.onReady(function() {
            MODx.load({ xtype: "chs-page-home"});
        });
        </script>
        ');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        return $this->CHS->config['templatesPath'] . 'home.tpl';
    }
}