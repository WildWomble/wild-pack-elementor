(function ($) {
    $(document).on('click', '.item-facts', function () {
        $('.restaurant-item').removeClass('item-active');
    });
    $('body').on('click', '.restaurant-item', function () {
        $(this).siblings('.item-active').toggleClass('item-active');
        $(this).addClass('item-active');
    });
})(jQuery);