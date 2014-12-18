$(document).ready(function () {
    var url = site + '/' + ur_class + '/' + url_function;
    
    
    $('ul.nav a').filter(function() {
         return this.href == url;
    }).addClass('active');

    $('.nav-second-level li a.active').filter(function(){
     $('.collapse').addClass('in');
    });

});