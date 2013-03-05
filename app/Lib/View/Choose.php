<section>
	<article>
		<h1>Choose a Photo</h1>
		<div class="choose-photos clearfix">
			<?php
			$images = array('1','2','3','4');
			foreach ($images as $image):
				$name = "default_story_image_$image.jpg";
				$path = "/img/$name";
			?>
			<form method="post" action="/victory/upload" enctype="multipart/form-data" data-ajax="replaceContent">
				<input type="hidden" name="file" value="<?php echo $name; ?>" />
				<input type="image" src="<?php echo $path; ?>" />
			</form>
			<?php endforeach; ?>
		</div>
	</article>
</section>
