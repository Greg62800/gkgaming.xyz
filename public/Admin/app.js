(function($) {

    var body = $('body');
    var topbar__icon = $('.topbar__icon');
    var dropdown = $('.dropdown');
    var dropdown_link = $('.dropdown>a:first-child');

    topbar__icon.click(function () {
        body.toggleClass('in');
    });

    dropdown_link.click(function (e) {
        e.preventDefault();
        var drop = $(this).parent('.dropdown');
        var $this = $(this).parent().find('.dropdown-menu');
        $this.toggleClass('in');
        drop.toggleClass('menu_open');
    });

})(jQuery);
