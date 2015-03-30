$(document).ready(function () {
    var url = site + '/' + ur_class + '/' + url_function;
        
    $('ul.sidebar-menu a').filter(function() {
         return this.href == url;
    }).parent().addClass('active');

    $('.treeview li.active').parent().parent().addClass('active');
    $('.treeview .level-2 li.active').parent().parent().parent().parent().addClass('active');

    //grocery fix bug
    $('.chzn-container').css('width', '100%');
    $('.chzn-drop').css('width', '100%');
    $('.chzn-search input').css('width', '100%');
});