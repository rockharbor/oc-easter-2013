<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?> | OC Easter 2013</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="initial-scale=1.0,width=device-width,maximum-scale=1.0,user-scalable=0" />
		<?php if (!DEBUG): ?>
		<link rel="stylesheet" href="/css/styles.min.css" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
		<script src="/js/scripts.min.js"></script>
		<?php else: ?>
		<link rel="stylesheet" href="/css/reset.css" />
		<link rel="stylesheet" href="/js/mediaelement/build/mediaelementplayer.min.css" />
		<link rel="stylesheet" href="/css/styles.css" />
		<link rel="stylesheet" href="/css/mobile.css" media="screen and (max-width: 500px)" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
		<script src="/js/modernizr.js"></script>
		<script src="/js/form/jquery.form.js"></script>
		<script src="/js/touchswipe/jquery.touchSwipe.min.js"></script>
		<script src="/js/lazyload/jquery.lazyload.min.js"></script>
		<script src="/js/mediaelement/build/mediaelement-and-player.min.js"></script>
		<script src="/js/init.js"></script>
		<?php endif; ?>
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