var CHS = function (config) {
    config = config || {};
    CHS.superclass.constructor.call(this, config);
};
Ext.extend(CHS, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('chs', CHS);

CHS = new CHS();