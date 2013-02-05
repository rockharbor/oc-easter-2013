<?php
if (isset($error)) {
	echo '<p class="error">'.$error.'</p>';
}
?>
<div style="background: url(/image/<?php echo $tmpname; ?>) no-repeat; width: 300px; height: 300px">
	<img class="draggable" src="/img/mark.png" title="Drag Me!" />
</div>
<form method="post" action="/victory/process/<?php echo $tmpname; ?>" enctype="multipart/form-data">
	<input type="hidden" name="x" value="0" />
	<input type="hidden" name="y" value="0" />
	<textarea rows="4" maxlength="140" placeholder="Share your victory"></textarea>
	<input type="submit" name="submit" value="Declare Victory!" />
</form>
<script>
	$('.draggable').draggable({
		containment: 'parent',
		drag: function(event, ui) {
			$('[name=x]').val(ui.position.left);
			$('[name=y]').val(ui.position.top);
		}
	});
</script>