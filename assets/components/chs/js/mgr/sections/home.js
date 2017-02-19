CHS.page.Home = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'chs-panel-home',
            renderTo: 'chs-panel-home-div'
        }]
    });
    CHS.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(CHS.page.Home, MODx.Component);
Ext.reg('chs-page-home', CHS.page.Home);