<script>
	(function($) {
		// let the js do the scrolling
		$('.scroll').css('overflow', 'hidden');
		// hide content
		$('.scroll section article').hide();

		// initialize first slide
		$('.scroll section:first-child article').delay(showDelay).fadeIn();

		var selected = 0;
		var total = $('.scroll section').length;
		var w = $('.scroll section').width();
		var showDelay = 2000;

		$('.content').swipe({
			triggerOnTouchEnd : true,
			swipeStatus: function (event, phase, direction, distance) {
				w = $('.scroll section').width();

				switch (phase) {
					case 'move':
						$('.scroll section article').fadeOut();
						if (direction == 'left') {
							scrollTo((w * selected) + distance, 0);
						} else if (direction == 'right') {
							scrollTo((w * selected) - distance, 0);
						}
						break;
					case 'end':
						if (direction == 'left') {
							next();
						} else if (direction == 'right') {
							prev();
						}
						break;
					default:
						scrollTo(w * selected);
						showCurrent();
				}
			}
		});

		function next() {
			selected = Math.min(selected+1, total-1);
			scrollTo(w * selected);
			showCurrent();
		}

		function prev() {
			selected = Math.max(selected-1, 0);
			scrollTo(w * selected);
			showCurrent();
		}

		function showCurrent() {
			$('.scroll section:nth-child('+(selected+1)+') article').delay(showDelay).fadeIn();
		}

		function scrollTo(distance, duration) {
			if (distance < 0) {
				distance = 0;
			}
			if (distance > (total-1) * w) {
				distance = (total-1) * w;
			}
			distance *= -1;
			if (typeof duration === 'undefined') {
				duration = 500;
			}
			var dstring = Number(duration / 1000) + 's';
			var tstring = 'translate3d('+distance+'px, 0px, 0px)';
			$('.scroll section').css({
				'-webkit-transition-duration': dstring,
				'-moz-transition-duration': dstring,
				'-ms-transition-duration': dstring,
				'-o-transition-duration': dstring,
				'transition-duration': dstring,
				'-webkit-transform': tstring,
				'-moz-transform': tstring,
				'-ms-transform': 'translateX('+distance+'px)',
				'-o-transform': 'translateX('+distance+'px)',
				'transform': tstring
			});
		}
	})(jQuery);
</script>