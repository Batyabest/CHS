CHS.panel.Home = function (config) {
    config = config || {};
    Ext.apply(config, {
        baseCls: 'modx-formpanel',
        layout: 'anchor',
        /*
         stateful: true,
         stateId: 'chs-panel-home',
         stateEvents: ['tabchange'],
         getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
         */
        hideMode: 'offsets',
        items: [{
            xtype: 'modx-tabs',
            defaults: {border: false, autoHeight: true},
            border: false,
            hideMode: 'offsets',
            items: [{
                title: _('chs_items'),
                layout: 'anchor',
                items: [{
                    html: _('chs_intro_msg'),
                    cls: 'panel-desc',
                }, {
                    xtype: 'chs-grid-items',
                    cls: 'main-wrapper',
                }]
            }]
        }]
    });
    CHS.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(CHS.panel.Home, MODx.Panel);
Ext.reg('chs-panel-home', CHS.panel.Home);
