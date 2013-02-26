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
			<?php echo $result->note; ?>
		</p>
		<?php endif; ?>
	</article>
</section>

<div class="background">
	<div class="bg19" />
</div>
