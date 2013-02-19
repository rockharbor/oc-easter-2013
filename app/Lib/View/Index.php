<script>
	$(document).ready(function() {
		// let the js do the scrolling
		$('.scroll').css('overflow', 'hidden');
		// hide content
		$('.scroll section article').hide();

		var selected = 0;
		var total = $('.scroll section').length;
		var w = $('.scroll section').width();
		var showDelay = 2000;

		// check if this was linked to and take them to the slide
		var hash = window.location.hash;
		if (window.history.pushState && $(hash).length > 0) {
			selected = $('.scroll section').index($(hash));
			console.log('based on hash '+selected);
		}

		// initialize slide, and update history if this isn't the first
		scrollTo(w * selected);
		showCurrent(selected === 0);

		$('.content').swipe({
			triggerOnTouchEnd : true,
			allowPageScroll: false,
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

		function showCurrent(updateHistory) {
			if (typeof updateHistory === 'undefined') {
				updateHistory = true;
			}
			$('.scroll section:nth-child('+(selected+1)+') article').delay(showDelay).fadeIn();
			if (updateHistory && window.history.pushState) {
				var selectedId = $('.scroll section:nth-child('+(selected+1)+')').prop('id');
				window.history.pushState(null, null, '#'+selectedId);
			}
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

		if (window.history.pushState) {
			window.addEventListener('popstate', function(e) {
				selected = $('.scroll section').index($(window.location.hash));
				scrollTo(w * selected);
				showCurrent(false);
			});
		}

		$('.scroll').scroll(function(e) {
			// seriously #hash, we don't want you to scroll
			e.preventDefault();
			this.scrollLeft = 0;
			return false;
		});

		// configure videos
		$('video')
			.each(function() {
				var w = $(this).width();
				var h = w*9/16;
				$(this).attr('height', h);
			})
			.mediaelementplayer({
				pluginPath: '/js/mediaelement/build/flashmediaelement.swf',
				success: function(media, node) {
					if (media.pluginType !== 'native' && jQuery(node).attr('data-streamfile')) {
						media.setSrc(jQuery(node).attr('data-streamfile'));
						media.load();
					}
				}
			});
	});
</script>