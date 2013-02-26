<?php
// for testing paragraph placement, max length ~1500 chars
$testStory = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer non porta magna. Vivamus dignissim volutpat scelerisque. Nulla convallis consectetur nisi eget bibendum. Sed semper adipiscing leo, elementum dictum metus convallis nec. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur est sapien, sagittis ac vehicula ac, laoreet vitae arcu. Quisque congue eleifend molestie. Mauris malesuada tellus ac quam venenatis pulvinar. Integer bibendum sagittis auctor. Nulla quis feugiat mauris. Vestibulum vel lectus nisi. Suspendisse vitae lacus consectetur nisl blandit pellentesque. Integer commodo odio eget quam tincidunt in vulputate lacus facilisis. Maecenas facilisis sem quis orci posuere dapibus. Vivamus quis dui est. Nunc cursus iaculis iaculis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer non porta magna. Vivamus dignissim volutpat scelerisque. Nulla convallis consectetur nisi eget bibendum. Sed semper adipiscing leo, elementum dictum metus convallis nec. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur est sapien, sagittis ac vehicula ac, laoreet vitae arcu. Quisque congue eleifend molestie. Mauris malesuada tellus ac quam venenatis pulvinar. Integer bibendum sagittis auctor. Nulla quis feugiat mauris. Vestibulum vel lectus nisi. Suspendisse vitae lacus consectetur nisl blandit pellentesque. Integer commodo odio eget quam tincidunt in vulputate lacus facilisis.';
$testVideo = '<video src="/img/vid.mp4" controls preload="none"></video>';
?>
<section class="scroll">

	<article id="story1">
		<p><?php echo $testStory; ?></p>
	</article>

	<article id="story2">
		<?php echo $testVideo; ?>
	</article>

	<article id="story3">
		<?php echo $testVideo; ?>
	</article>

	<article id="story4">
		<p><?php echo $testStory; ?></p>
	</article>

	<article id="story5">
		<?php echo $testVideo; ?>
	</article>

	<article id="story6">
		<?php echo $testVideo; ?>
	</article>

	<article id="story7">
		<p><?php echo $testStory; ?></p>
	</article>

	<article id="story8">
		<?php echo $testVideo; ?>
	</article>

	<article id="story9">
		<?php echo $testVideo; ?>
	</article>

	<article id="story10">
		<?php echo $testVideo; ?>
	</article>

</div>

<div class="multi background">
<div
	class="bg1"></div><div
	class="bg2"></div><div
	class="bg3"></div><div
	class="bg4"></div><div
	class="bg5"></div><div
	class="bg6"></div><div
	class="bg7"></div><div
	class="bg8"></div><div
	class="bg9"></div><div
	class="bg10"></div>
</div>

<script>
	$(document).ready(function() {
		// let the js do the scrolling
		$('.background').css('overflow', 'hidden');
		// hide content
		$('.scroll article').hide();

		var selected = 0;
		var total = $('.background div').length;
		var w = getWidth();
		var showDelay = 2000;

		// check if this was linked to and take them to the slide
		var hash = window.location.hash;
		if (Modernizr.history && $(hash).length > 0) {
			selected = $('.scroll article').index($(hash));
		}

		// initialize slide, and update history if this isn't the first
		scrollTo(w * selected);
		showCurrent(selected === 0);

		$('.scroll').swipe({
			triggerOnTouchEnd : true,
			allowPageScroll: 'vertical',
			swipeStatus: function (event, phase, direction, distance) {
				w = getWidth();

				switch (phase) {
					case 'move':
						$('video').mediaelementplayer().each(function() {
							this.pause();
						});
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
					case 'cancel':
						scrollTo(w * selected);
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

		function getWidth() {
			return $('.background div').width();
		}

		function showCurrent(updateHistory) {
			if (typeof updateHistory === 'undefined') {
				updateHistory = true;
			}
			$('.scroll article:not(:nth-child('+(selected+1)+'))').fadeOut();
			$('.scroll article:nth-child('+(selected+1)+')').delay(showDelay).fadeIn();
			if (updateHistory && Modernizr.history) {
				var selectedId = $('.scroll article:nth-child('+(selected+1)+')').prop('id');
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
			if (!Modernizr.csstransforms3d) {
				tstring = 'translateX('+distance+'px)';
			}
			if (Modernizr.csstransforms && Modernizr.csstransitions) {
				$('.background div').css({
					'-webkit-transition-duration': dstring,
					'-moz-transition-duration': dstring,
					'-ms-transition-duration': dstring,
					'-o-transition-duration': dstring,
					'transition-duration': dstring,
					'-webkit-transform': tstring,
					'-moz-transform': tstring,
					'-ms-transform': tstring,
					'-o-transform': tstring,
					'transform': tstring
				});
			} else {
				distance *= -1;
				if (duration === 0) {
					$('.background').scrollLeft(distance);
				} else {
					$('.background').stop().clearQueue().animate({
						scrollLeft: distance
					}, duration);
				}
			}
		}

		if (Modernizr.history) {
			window.addEventListener('popstate', function(e) {
				selected = $('.scroll article').index($(window.location.hash));
				scrollTo(w * selected);
				showCurrent(false);
			});
		}

		$('.scroll').scroll(function(e) {
			if (Modernizr.csstransforms && Modernizr.csstransitions) {
				// seriously #hash, we don't want you to scroll
				e.preventDefault();
				this.scrollLeft = 0;
				return false;
			}
		});

		$(window).resize(function() {
			w = getWidth();
			scrollTo(w * selected);
			showCurrent();
		});

		// configure videos
		$('video')
			.each(function() {
				var w = $(this).width();
				var h = w*9/16;
				$(this).attr('width', w);
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