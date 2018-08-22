(function($) {
    $('.topbar__icon').click(function() {
        $('.menu').toggleClass('in');
        $('body').toggleClass('menu');
    });
    $('.menu__account .avatar').click(function() {
        $('.menu__user').toggleClass('in');
        $('body').toggleClass('menu_actived');
    });
    $('#account').click(function() {
        $('.menu__user').removeClass('in');
        $('body').removeClass('menu_actived');
    });
    $('#delete-avatar').click(function(e) {
        e.preventDefault();
        if(confirm('Vous êtes sûr de vouloir faire cela ?')) {
            window.location = $(this).attr('href');
        }
    });
    $('.reply').click(function(e) {
        e.preventDefault();
        var $this = $(this);
        var comment = $this.parents('.comment');
        var form = $('#comment-form');
        var parent_id = $this.data('id');
        comment.after(form);
        form.slideDown();
        $('#parent_id').val(parent_id);
    });

    $('.notifications>a:first-child').click(function(e) {
        e.preventDefault();
        var $this = $(this).parent().find('.menu__notification');
        $this.toggleClass('in');
    });

    $('#btn-link').click(function(e) {
        e.preventDefault();
        if(confirm('Sûr ?')) {
            window.location = $(this).attr('href');
        }
    });

    $('a#show_cat').click(function(e) {
        e.preventDefault();
    });

})(jQuery);


$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > 400) {
        $('#back_to_top').fadeIn();
    } else {
        $('#back_to_top').fadeOut();
    }
});
$(document).ready(function() {
    $("#back_to_top").click(function(event) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });

});