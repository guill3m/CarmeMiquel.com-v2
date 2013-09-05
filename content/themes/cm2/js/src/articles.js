(function($) {
	$(function() {

		$('.show-hide').click(function(event) {
			event.preventDefault();
			var $target = $(this).attr('data-show');
			$($target).slideToggle(500);
		});

	});
})(jQuery);