<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?> | OC Easter 2013</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="initial-scale=1.0,width=device-width,maximum-scale=1.0,user-scalable=0" />
		<link rel="stylesheet" href="/css/styles.min.css" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
		<script src="/js/scripts.min.js"></script>
		<script>
			$(document).ready(function() {
				$(document).on('click', '[data-ajax]', function() {
					var el = $(this);
					var context = this;

					var url, method;
					if (this.tagName.toLowerCase() === 'form') {
						url = el.prop('action');
						method =  el.prop('method');
						data = el.serialize();
					} else {
						url = el.prop('href');
						method = 'GET';
						data = [];
					}

					$.ajax({
						url: url,
						type: method,
						data: data,
						success: function(data, status, xhr) {
							window[el.data('ajax')].apply(context, [
								data, status, xhr
							]);
						}
					})
					return false;
				});

				window.replaceContent = function(data) {
					$(this).closest('.content').html(data);
				}

				// configure videos
				$('video')
					.each(function() {
						var w = $(this).width();
						var h = w*9/16;
						$(this).attr('width', w);
						$(this).attr('height', h);
					})
					.mediaelementplayer({
						pluginPath: '/swf/',
						success: function(media, node) {
							if (media.pluginType !== 'native' && jQuery(node).attr('data-streamfile')) {
								media.setSrc(jQuery(node).attr('data-streamfile'));
								media.load();
							}
						}
					});
				$('nav button').click(function() {
					var top = $('nav').position().top;
					if (top < 0) {
						$('nav').css('top', 0);
						var tstring = 'rotate(180deg)';
						$('nav button').css({
							'-webkit-transform': tstring,
							'-moz-transform': tstring,
							'-ms-transform': tstring,
							'-o-transform': tstring,
							'transform': tstring
						});
						$('video, .mjes-container').hide();
					} else {
						$('nav').css('top', -$('nav').height());
						var tstring = 'rotate(0deg)';
						$('nav button').css({
							'-webkit-transform': tstring,
							'-moz-transform': tstring,
							'-ms-transform': tstring,
							'-o-transform': tstring,
							'transform': tstring
						});
						// hide visible videos
						// see: http://stackoverflow.com/questions/3007797/ipad-iphone-html5-video-loading
						$('video, .mjes-container').show();
					}
				});
			});
		</script>
		<script type="text/javascript">

			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-7415608-5']);
			_gaq.push(['_trackPageview']);

			(function() {
			  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();

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
						<li><a href="https://rockharbor.webconnex.com/easter2013" target="_blank">Sponsor a Seat</a></li>
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