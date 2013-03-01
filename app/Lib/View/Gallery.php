<section>
	<article>
		<h1>Gallery</h1>
		<p>Check out the pictures below for a glimpse of last year&apos;s Easter Celebration. </p>
		<div class="slideshow clearfix">
			<img src="/img/gallery/150/1.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/2.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/3.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/4.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/5.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/6.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/7.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/8.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/9.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/10.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/11.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/12.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/13.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/14.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/15.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/16.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/17.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/18.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/19.jpg" width="150" height="150" alt="Easter Celebration 2012" />
			<img src="/img/gallery/150/20.jpg" width="150" height="150" alt="Easter Celebration 2012" />
		</div>
		<div class="slideshow-large" style="display: none">
			<div class="slideshow-large-image">
				<div class="slideshow-popup">
					<a class="button close" href="#">&times;</a>
					<a class="button next" href="#">Next</a>
					<a class="button prev" href="#">Prev</a>
				</div>
				<div class="slideshow-background"></div>
			</div>
		</div>
	</article>
</section>

<div class="background">
	<div class="bg14"></div>
</div>

<script>
	$('.slideshow-popup a.close, .slideshow-background').click(function() {
		$('.slideshow-large').fadeOut();
	});
	$('.slideshow img').click(function() {
		var src = $(this).attr('src');
		var large = src.replace('/150/', '/800/');
		$('.slideshow-popup img').remove();
		var img = new Image();
		img.src = large;
		img.onload = function() {
			$('.slideshow-large').fadeIn();
		}
		$('.slideshow-popup').append(img).data('showing', src);
	});
	$('body').keyup(function(event) {
		if (!$('.slideshow-large').is(':visible')) {
			return;
		}
		var showing = $('.slideshow-popup').data('showing');
		switch (event.which) {
			case 37:
			case 72:
				var next = $('.slideshow img[src="'+showing+'"]').prev();
				if (next.length == 0) {
					next = $('.slideshow img:last-child');
				}
			break;
			case 39:
			case 76:
				var next = $('.slideshow img[src="'+showing+'"]').next();
				if (next.length == 0) {
					next = $('.slideshow img:first-child');
				}
			break;
			case 27:
				$('.slideshow-popup a.close').click();
			break;
		}
		next.click();
	});
	$('.next').click(function() {
		var e = new $.Event('keyup', {which: 39});
		$('body').trigger(e);
	});
	$('.prev').click(function() {
		var e = new $.Event('keyup', {which: 37});
		$('body').trigger(e);
	});
</script>