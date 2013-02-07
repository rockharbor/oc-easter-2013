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
			resetForm: true,
			success: function(response) {
				$('#uploadForm').closest('.content').html(response);
			}
		});
		return false;
	});
	$('.upload')
		.addClass('button js')
		.children('form')
			.before('<span>'+$('#uploadForm').find(':submit').val()+'</span>')
	$('#uploadForm :file').change(function() {
		$('#uploadForm').submit();
	});
</script>