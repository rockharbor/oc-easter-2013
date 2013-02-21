<?php
// for testing paragraph placement, max length ~1500 chars
$testStory = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer non porta magna. Vivamus dignissim volutpat scelerisque. Nulla convallis consectetur nisi eget bibendum. Sed semper adipiscing leo, elementum dictum metus convallis nec. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur est sapien, sagittis ac vehicula ac, laoreet vitae arcu. Quisque congue eleifend molestie. Mauris malesuada tellus ac quam venenatis pulvinar. Integer bibendum sagittis auctor. Nulla quis feugiat mauris. Vestibulum vel lectus nisi. Suspendisse vitae lacus consectetur nisl blandit pellentesque. Integer commodo odio eget quam tincidunt in vulputate lacus facilisis. Maecenas facilisis sem quis orci posuere dapibus. Vivamus quis dui est. Nunc cursus iaculis iaculis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer non porta magna. Vivamus dignissim volutpat scelerisque. Nulla convallis consectetur nisi eget bibendum. Sed semper adipiscing leo, elementum dictum metus convallis nec. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur est sapien, sagittis ac vehicula ac, laoreet vitae arcu. Quisque congue eleifend molestie. Mauris malesuada tellus ac quam venenatis pulvinar. Integer bibendum sagittis auctor. Nulla quis feugiat mauris. Vestibulum vel lectus nisi. Suspendisse vitae lacus consectetur nisl blandit pellentesque. Integer commodo odio eget quam tincidunt in vulputate lacus facilisis.';
$testVideo = '<video src="/img/vid.mp4" controls preload="none"></video>'
?>
<div class="scroll">

	<section id="story1" class="fullsize fullbackground bg1">
		<article>
			<p><?php echo $testStory; ?></p>
		</article>
	</section>

	<section id="story2" class="fullsize fullbackground bg2">
		<article>
			<?php echo $testVideo; ?>
		</article>
	</section>

	<section id="story3" class="fullsize fullbackground bg3">
		<article>
			<?php echo $testVideo; ?>
		</article>
	</section>

	<section id="story4" class="fullsize fullbackground bg4">
		<article>
			<p><?php echo $testStory; ?></p>
		</article>
	</section>

	<section id="story5" class="fullsize fullbackground bg5">
		<article>
			<?php echo $testVideo; ?>
		</article>
	</section>

	<section id="story6" class="fullsize fullbackground bg6">
		<article>
			<?php echo $testVideo; ?>
		</article>
	</section>

	<section id="story7" class="fullsize fullbackground bg7">
		<article>
			<?php echo $testVideo; ?>
		</article>
	</section>

	<section id="story8" class="fullsize fullbackground bg8">
		<article>
			<p><?php echo $testStory; ?></p>
		</article>
	</section>

	<section id="story9" class="fullsize fullbackground bg9">
		<article>
			<?php echo $testVideo; ?>
		</article>
	</section>

	<section id="story10" class="fullsize fullbackground bg10">
		<article>
			<?php echo $testVideo; ?>
		</article>
	</section>

</div>
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
		if (Modernizr.history && $(hash).length > 0) {
			selected = $('.scroll section').index($(hash));
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
			if (updateHistory && Modernizr.history) {
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
			if (!Modernizr.csstransforms3d) {
				tstring = 'translateX('+distance+'px)';
			}
			if (Modernizr.csstransforms && Modernizr.csstransitions) {
				$('.scroll section').css({
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
					$('.scroll').scrollLeft(distance);
				} else {
					$('.scroll').stop().clearQueue().animate({
						scrollLeft: distance
					}, duration);
				}
			}
		}

		if (Modernizr.history) {
			window.addEventListener('popstate', function(e) {
				selected = $('.scroll section').index($(window.location.hash));
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
			w = $('.scroll section').width();
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