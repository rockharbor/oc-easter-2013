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
	function touchHandler(event) {
		var touches = event.changedTouches,
		first = touches[0],
		type = "";

		switch(event.type) {
		case "touchstart": type = "mousedown"; break;
		case "touchmove":  type="mousemove"; break;
		case "touchend":   type="mouseup"; break;
		default: return;
		}
		var simulatedEvent = document.createEvent("MouseEvent");
		simulatedEvent.initMouseEvent(type, true, true, window, 1,
			first.screenX, first.screenY,
			first.clientX, first.clientY, false,
			false, false, false, 0, null
		);

		first.target.dispatchEvent(simulatedEvent);
		event.preventDefault();
	}

	var draggable = $('.draggable')[0];
	draggable.addEventListener("touchstart", touchHandler, true);
	draggable.addEventListener("touchmove", touchHandler, true);
	draggable.addEventListener("touchend", touchHandler, true);
	draggable.addEventListener("touchcancel", touchHandler, true);

	$('.draggable').draggable({
		containment: 'parent',
		drag: function(event, ui) {
			$('[name=x]').val(ui.position.left);
			$('[name=y]').val(ui.position.top);
		}
	});
</script>