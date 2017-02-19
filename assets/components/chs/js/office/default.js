Ext.onReady(function () {
    CHS.config.connector_url = OfficeConfig.actionUrl;

    var grid = new CHS.panel.Home();
    grid.render('office-chs-wrapper');

    var preloader = document.getElementById('office-preloader');
    if (preloader) {
        preloader.parentNode.removeChild(preloader);
    }
});