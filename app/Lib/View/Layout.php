<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?> | OC Easter 2013</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="initial-scale=1.0,width=device-width,maximum-scale=1.0,user-scalable=0" />
		<link rel="stylesheet" href="/css/reset.css" />
		<link rel="stylesheet" href="/js/mediaelement/build/mediaelementplayer.min.css" />
		<link rel="stylesheet" href="/css/styles.css" />
		<link rel="stylesheet" href="/css/mobile.css" media="screen and (max-width: 500px)" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
		<script src="/js/modernizr.js"></script>
		<script src="/js/form/jquery.form.js"></script>
		<script src="/js/touchswipe/jquery.touchSwipe.min.js"></script>
		<script src="/js/mediaelement/build/mediaelement-and-player.min.js"></script>
		<script>
			$(document).ready(function() {
				$(document).on('click', 'form[data-ajax]', function() {
					var el = $(this);
					var context = this;
					$.ajax({
						url: el.prop('action'),
						type: el.prop('method'),
						success: function(data, status, xhr) {
							window[el.data('ajax')].apply(context, [
								data, status, xhr
							]);
						}
					})
					return false;
				});
				$('nav button').click(function() {
					var top = $('nav').position().top;
					if (top < 0) {
						$('nav').css('top', 0);
					} else {
						$('nav').css('top', -$('nav').height());
					}
				});
			});
		</script>
	</head>
	<body>
		<nav>
			<button>Menu</button>
			<ul>
				<li><a href="/">Home</a></li>
				<li><a href="/pages/what-is-heaven-crashing-in">What is <span class="hic">Heaven Crashing In</span>?</a></li>
				<li><a href="/victory/view">Share a <span class="hic">Heaven Crashing In</span> Story</a></li>
				<li>
					<a href="/pages/easter-celebration">Easter Celebration</a>
					<ul>
						<li><a href="/pages/what-to-expect">What to Expect</a></li>
						<li><a href="/pages/gallery">Gallery</a></li>
						<li><a href="/pages/why-celebrate">Why Celebrate</a></li>
						<li><a href="/pages/kids">Kids</a></li>
						<li><a href="/pages/directions">Directions</a></li>
						<li><a href="/pages/sponsor-a-seat">Sponsor a Seat</a></li>
						<li><a href="/pages/church-directory">Church Directory</a></li>
					</ul>
				</li>
			</ul>
		</nav>
		<div class="content">
			<?php echo $content; ?>
		</div>
	</body>
</html>