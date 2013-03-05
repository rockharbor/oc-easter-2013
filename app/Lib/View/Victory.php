<section>
	<article class="clearfix">
		<?php
		if (isset($error)): ?>
		<p class="error"><?php echo $error; ?></p>
		<?php else: ?>
		<div class="image-container full">
			<img src="/uploads/<?php echo $result->filename; ?>" alt="Victory" />
		</div>
		<p>
			<?php echo $result->note; ?><br />
			<?php
			$message = rawurlencode($result->note.' #heavencrashesin ');
			$page = rawurlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
			$pagetitle = rawurlencode('OC Easter 2013');
			?>
			<a href="http://twitter.com/home?status=<?php echo $message.$page; ?>" target="_blank" class="twitter">Twitter</a>
			<a href="http://www.facebook.com/sharer.php?u=<?php echo $page; ?>&t=<?php echo $pagetitle; ?>" target="_blank" class="facebook">Facebook</a>
			<a href="/victory/view/<?php echo $result->filename; ?>?download=1" class="download">Download</a>
		</p>
		<?php endif; ?>
	</article>
</section>

<div class="background">
	<div class="bg19"></div>
</div>
