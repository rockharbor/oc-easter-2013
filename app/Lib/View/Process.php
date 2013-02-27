<?php
if (isset($error)) {
	echo '<p class="error">'.$error.'</p>';
}
?>
<div class="user-image" style="background: url('/image/<?php echo $tmpname; ?>') no-repeat;">
	<img class="draggable" src="/img/mark.png" title="Drag Me!" />
</div>
<form method="post" action="/victory/process/<?php echo $tmpname; ?>" enctype="multipart/form-data">
	<input type="hidden" name="x" value="0" />
	<input type="hidden" name="y" value="0" />
	<textarea name="note" rows="4" maxlength="140" style="width: 300px;" placeholder="Share your victory"></textarea>
	<br />
	<input class="button" type="submit" name="submit" value="Declare Victory!" />
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