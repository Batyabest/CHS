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
            html: '<h2>' + _('chs') + '</h2>',
            cls: '',
            style: {margin: '15px 0'}
        }, {
            xtype: 'modx-tabs',
            defaults: {border: false, autoHeight: true},
            border: true,
            hideMode: 'offsets',
            items: [{
                title: _('chs_fiziks'),
                layout: 'anchor',
                items: [{
                    html: _('chs_fizik_intro'),
                    cls: 'panel-desc',
                }, {
                    xtype: 'chs-grid-fiziks',
                    cls: 'main-wrapper',
                }]
            }]
        }]
    });
    CHS.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(CHS.panel.Home, MODx.Panel);
Ext.reg('chs-panel-home', CHS.panel.Home);
