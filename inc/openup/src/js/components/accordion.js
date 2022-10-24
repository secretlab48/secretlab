if ($(".JS-accordion--btn").length !== 0) {
	$(document).on('click', '.JS-accordion--btn', function () {
		$(this).parent().siblings('.JS-accordion').find('.JS-accordion--btn').removeClass('active');
		$(this).siblings('.JS-accordion--content:visible').slideUp(300);
		$(this).toggleClass('active');
		if ($(this).hasClass('active')) {
			$(this).next().slideDown(300);
		}
		$(this).parent().siblings('.JS-accordion').find('.JS-accordion--content').slideUp(300);
	});

}
