<section>
	<article>
		<h1>Upload</h1>
		<?php
		if (isset($error)) {
			echo '<p class="error">'.$error.'</p>';
		}
		?>
		<div class="upload">
			<form id="uploadForm" method="post" action="/victory/upload" enctype="multipart/form-data">
				<input type="file" name="file" />
				<input type="submit" value="Upload" />
			</form>
		</div>
		<div class="loading" style="display: none">
			<img src="/img/loading.gif" />
		</div>
	</article>
</section>
<script>
	// make it one-click
	$('#uploadForm').submit(function(e) {
		var form = $(this);
		$('.upload').hide();
		$('.loading').show();
		e.preventDefault();
		form.ajaxSubmit({
			dataType: 'html',
			resetForm: true,
			success: function(response) {
				$('#uploadForm').closest('.content').html(response);
			},
			complete: function() {
				$('.loading').hide();
				$('.upload').show();
			}
		});
		return false;
	});
	$('.upload')
		.addClass('button js')
		.children('form')
			.before('<span>Upload</span>')
	$('#uploadForm :file').change(function() {
		$('#uploadForm').submit();
	});
</script>