/**
 * Created by michelchouinard on 14-12-08.
 */
$(function(){

    $('.carousel').carousel({
        interval: 5000
    });

    $(document).on(
        'click',
        '.navbar-collapse.in',
        function(e) {
            if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
                $(this).collapse('hide');
            }
        }
    );

});
