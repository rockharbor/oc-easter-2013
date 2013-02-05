<h1>Upload</h1>
<?php
if (isset($error)) {
	echo '<p class="error">'.$error.'</p>';
}
?>
<form method="post" action="/victory/upload" enctype="multipart/form-data">
	<input type="file" name="file" />
	<input type="submit" name="submit" value="Upload" />
</form>