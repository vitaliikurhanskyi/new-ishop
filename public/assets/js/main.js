$(function() {

	// CART

	function showCart(cart) {
		$('#cart-modal .modal-cart-content').html(cart);
		const myModalEl = document.querySelector('#cart-modal');
		const modal = bootstrap.Modal.getOrCreateInstance(myModalEl);
		modal.show();

		if($('.cart-qty').text()) {
			$('.count-items').text($('.cart-qty').text());
		} else {
			$('.count-items').text('0');
		}
	}

	// Delete product from cart
	$('#cart-modal .modal-cart-content').on('click', '.del-item', function(e){
		e.preventDefault();
		const id = $(this).data('id');
		$.ajax({
			url: 'cart/delete',
			type: 'GET',
			data: {id: id},
			success: function(res) {
				showCart(res);
			},
			error: function() {
				alert(JSTRANSLATE.js_error_remove);
			}
		});
	});

	// Delete everything from the basket
	$('#cart-modal .modal-cart-content').on('click', '#clear-cart', function(e){
		$.ajax({
			url: 'cart/clear',
			type: 'GET',
			success: function(res) {
				showCart(res);
				$('.add-to-cart').each(function (index){
					$(this).find('i').removeClass('fa-solid fa-cart-plus').addClass('fa-shopping-cart');
				});
			},
			error: function() {
				alert('delete error');
			}
		});
	});

	// show basket
	$('#get-cart').on('click', function(e){
		e.preventDefault();
		$.ajax({
			url: 'cart/show',
			type: 'GET',
			success: function (res) {
				showCart(res);
			},
			error: function () {
				alert(JSTRANSLATE.js_error);
			}
		});
	});

	// add to basket
	$('.add-to-cart').on('click', function (e) {
		e.preventDefault();
		const id = $(this).data('id');
		const quantity = $('#input-quantity').val() ? $('#input-quantity').val() : 1;
		const $this = $(this);
		$.ajax({
			url: 'cart/add',
			type: 'GET',
			data: {id: id, quantity: quantity},
			success: function (res) {
				showCart(res);
				$this.find('i').removeClass('fa-shopping-cart').addClass('fa-solid fa-cart-plus');
			},
			error: function () {
				alert(JSTRANSLATE.js_error);
			}
		});
	});

	// CART

	$('.open-search').click(function(e) {
		e.preventDefault();
		$('#search').addClass('active');
	});
	$('.close-search').click(function() {
		$('#search').removeClass('active');
	});

	$(window).scroll(function() {
		if ($(this).scrollTop() > 200) {
			$('#top').fadeIn();
		} else {
			$('#top').fadeOut();
		}
	});

	$('#top').click(function() {
		$('body, html').animate({scrollTop:0}, 700);
	});

	$('.sidebar-toggler .btn').click(function() {
		$('.sidebar-toggle').slideToggle();
	});

	$('.thumbnails').magnificPopup({
		type:'image',
		delegate: 'a',
		gallery: {
			enabled: true
		},
		removalDelay: 500,
		callbacks: {
			beforeOpen: function() {
				this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				this.st.mainClass = this.st.el.attr('data-effect');
			}
		}
	});

	//CHANGE LANGUAGE BTN

	$('#languages button').on('click', function () {
		const lang_code = $(this).data('langcode');
		window.location = PATH + '/language/change?lang=' + lang_code;
	});

});