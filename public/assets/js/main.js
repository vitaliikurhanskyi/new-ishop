$(document).ready(function () {
	$('.open-search').click(function (e) {
		e.preventDefault();
		$('#search').addClass('active');
	});
	$('.close-search').click(function () {
		$('#search').removeClass('active');
	});

	$(window).scroll(function () {
		if ($(this).scrollTop() > 200) {
			$('#top').fadeIn();
		} else {
			$('#top').fadeOut();
		}
	});

	$('#top').click(function () {
		$('body, html').animate({ scrollTop: 0 }, 700);
	});

	$('.sidebar-toggler .btn').click(function () {
		$('.sidebar-toggle').slideToggle();
	});

	$('.thumbnails').magnificPopup({
		type: 'image',
		delegate: 'a',
		gallery: {
			enabled: true
		},
		removalDelay: 500,
		callbacks: {
			beforeOpen: function () {
				this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				this.st.mainClass = this.st.el.attr('data-effect');
			}
		}
	});

	// language
	$('#languages button').on('click', function (e) {
		const lang_code = $(this).data('langcode');
		window.location = PATH + '/language/change?lang=' + lang_code;
	});

	// cart
	$('.add-to-cart').on('click', function (event) {
		event.preventDefault();
		const id = $(this).data('id');
		const quantity = $('#input-quantity').val() ? $('#input-quantity').val() : 1;
		const $this = $(this);

		$.ajax({
			url: 'cart/add',
			type: 'GET',
			data: {id: id, quantity: quantity},
			success: function(response) {
				console.log(response);
			},
			error: function () {
				alert('Error');
			}
		});

	});

	console.log(JSTRANSLATE.js_error);

});
