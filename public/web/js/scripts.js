/*
 * Title:   Travelo - Travel, Tour Booking HTML5 Template - Custom Javascript file
 * Author:  http://themeforest.net/user/soaptheme
 */

tjq(document).ready(function() {
    tjq('body').on('click', '.md-trigger', function(e) {
        tjq('#modal-1').toggleClass("md-show"); //you can list several class names 
        tjq('#popup-content').html(tjq(this).data("src"));
        e.preventDefault();
    });

    tjq('body').on('click', '#md-close, .md-overlay', function(e) {
        tjq('#modal-1').toggleClass("md-show"); //you can list several class names 
        tjq('#popup-content').html('');
        e.preventDefault();
    });
});