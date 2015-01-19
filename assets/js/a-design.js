$(document).ready(function () {
    var url = site + '/' + ur_class + '/' + url_function;
        
    $('ul.nav a').filter(function() {
         return this.href == url;
    }).addClass('active');

    $('.nav-second-level').filter(function('li a.active'){
     $('.collapse').addClass('in').parent().addClass('active');;
    });

    //grocery fix bug
    $('.chzn-container').css('width', '100%');
    $('.chzn-drop').css('width', '99.8%');
    $('.chzn-search input').css('width', '100%');
});