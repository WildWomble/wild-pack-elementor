(function ($) {
	let names = {}, count = 0;
	$('#edm-products input[type="radio"]').each(function() { // find unique names
		names[$(this).attr('name')] = true;
	});
	
	$.each(names, function () { // then count them
		count++;
	});
	
	$('body').on('change', '#edm-products input[type="radio"]', function () {
		if ($('#edm-products input[type="radio"]:checked').length == count) {
			$('#edm-add-to-cart').removeClass('item-hidden');
		}
	});

	$('body').on('click', '#edm-add-to-cart', function () {
        $.ajax({
            type: 'POST',
            url: localize._ajax_url,
            async: false,
            data: {
				_ajax_nonce: localize._ajax_nonce,
				edm_product_id: $('input[name="edm_product_id"]').val(),
				edm_steps: $('input[name="edm_steps"]').val(),
				edm_variations: $('input[type=radio]').serializeArray(),
                action: 'custom_bundle_submit',
            },
            success: (res) => {
				$('#form_edm_addtocart')[0].reset();

				if (res.code != undefined) {
					$('#edm-popup-message').html(res.message);
				}

				$('#edm-add-to-cart').addClass('item-hidden');
				$('#edm-popup').removeClass('item-hidden');

				var fragments = res.fragments;
				if ( fragments ) {
					$.each(fragments, function(key, value) {
						$(key).replaceWith(value);
					});
				}
            }
        });
	})

	$('body').on('click', '#buy-another', function () {
		$(this).parent().parent().addClass('item-hidden');
	})
})(jQuery);