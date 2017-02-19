CHS.window.CreateFizik = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'chs-fizik-window-create';
    }
    Ext.applyIf(config, {
        title: _('chs_fizik_create'),
        width: 550,
        autoHeight: true,
        url: CHS.config.connector_url,
        action: 'mgr/fizik/create',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    CHS.window.CreateFizik.superclass.constructor.call(this, config);
};
Ext.extend(CHS.window.CreateFizik, MODx.Window, {

    getFields: function (config) {
        return [{
            xtype: 'textfield',
            fieldLabel: _('chs_fizik_name'),
            name: 'name',
            id: config.id + '-name',
            anchor: '99%',
            allowBlank: false,
        },{
            xtype: 'textfield',
            fieldLabel: _('chs_fizik_secondname'),
            name: 'secondname',
            id: config.id + '-secondname',
            anchor: '99%',
            allowBlank: false,
        },{
            xtype: 'textfield',
            fieldLabel: _('chs_fizik_family'),
            name: 'family',
            id: config.id + '-family',
            anchor: '99%',
            allowBlank: false,
        }, {
            xtype: 'textarea',
            fieldLabel: _('chs_fizik_description'),
            name: 'description',
            id: config.id + '-description',
            height: 150,
            anchor: '99%'
        }, {
            xtype: 'xcheckbox',
            boxLabel: _('chs_fizik_active'),
            name: 'active',
            id: config.id + '-active',
            checked: true,
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('chs-fizik-window-create', CHS.window.CreateFizik);


CHS.window.UpdateFizik = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'chs-fizik-window-update';
    }
    Ext.applyIf(config, {
        title: _('chs_fizik_update'),
        width: 550,
        autoHeight: true,
        url: CHS.config.connector_url,
        action: 'mgr/fizik/update',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    CHS.window.UpdateFizik.superclass.constructor.call(this, config);
};
Ext.extend(CHS.window.UpdateFizik, MODx.Window, {

    getFields: function (config) {
        return [{
            xtype: 'hidden',
            name: 'id',
            id: config.id + '-id',
        }, {
            xtype: 'textfield',
            fieldLabel: _('chs_fizik_name'),
            name: 'name',
            id: config.id + '-name',
            anchor: '99%',
            allowBlank: false,
        }, {
            xtype: 'textarea',
            fieldLabel: _('chs_fizik_description'),
            name: 'description',
            id: config.id + '-description',
            anchor: '99%',
            height: 150,
        }, {
            xtype: 'xcheckbox',
            boxLabel: _('chs_fizik_active'),
            name: 'active',
            id: config.id + '-active',
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('chs-fizik-window-update', CHS.window.UpdateFizik);