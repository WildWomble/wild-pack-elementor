(function ($) {
    $(document).on('click', '.item-facts', function () {
        $('.restaurant-item').removeClass('item-active');
    });
    $('body').on('click', '.restaurant-item', function () {
        $(this).siblings('.item-active').toggleClass('item-active');
        $(this).addClass('item-active');
    });
    $('#language-switch input').on('click', function () {
        let mode = $(this).val();

        $(this).parent().siblings('.lang-active').toggleClass('lang-active');
        $(this).parent().addClass('lang-active');

        if (mode === 'first_lang') {
            $('.first-lang').css('display', 'block');
            $('.second-lang').css('display', 'none');
        } else {
            $('.first-lang').css('display', 'none');
            $('.second-lang').css('display', 'block');
        }
    })
})(jQuery);