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
<script>
	// make it one-click
	$('#uploadForm').submit(function(e) {
		e.preventDefault();
		var form = $(this).ajaxSubmit({
			dataType: 'html',
			resetForm: true
		});
		var xhr = form.data('jqxhr');
		xhr.done(function(response) {
			$('#uploadForm').parents('.content').html(response);
		});
	});
	$('.upload')
		.addClass('button js')
		.html(function() {
			return $(this).find(':submit').val() + $(this).html();
		})
	$('#uploadForm :file').change(function() {
		$('#uploadForm').submit();
	})
</script>