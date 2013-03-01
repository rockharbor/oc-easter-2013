<section>
	<article>
		<h1>Share your <span class="hic">Heaven Crashing In</span> Story</h1>
		<p>Do you have a story of heaven crashing into the world?</p>
		<p>Claim victory and share a post below.</p>
		<p>[All stories are moderated and could take a few hours before being published.]</p>
		<p>
			<a class="upload-slide-up button" href="/victory/upload">Share Your Victory</a>
		</p>
		<div class="clearfix" style="padding-top: 10px">
			<?php foreach ($results as $result): ?>
			<div class="image-container">
				<img src="/img/grey.png" data-original="/uploads/<?php echo $result->filename; ?>" />
				<?php if (!empty($result->note)): ?>
				<p><?php echo $result->note; ?></p>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
		</div>
	</article>
</section>
<div class="content auto upload-slide">
</div>

<div class="background">
	<div class="bg19"></div>
</div>

<script>
	(function($) {
		$('.image-container img').lazyload();

		var el = $('.upload-slide');
		// set up slide
		el.hide().css({
			top: 'auto',
			bottom: -el.height()
		});

		// load content
		$.ajax({
			url: $('.upload-slide-up').prop('href'),
			type: 'get'
		}).done(function(response) {
			el.html(response);
			el.css('bottom', -el.outerHeight());
			el.show();
		});

		// for toggling
		$('.upload-slide-up').click(function() {
			if (parseInt(el.css('bottom')) < 0) {
				el.css('bottom', 0);
			} else {
				el.css('bottom', -el.outerHeight());
			}
			return false;
		});
	})(jQuery);
</script>