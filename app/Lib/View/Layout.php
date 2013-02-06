<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?> | OC Easter 2013</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="/css/reset.css" />
		<link rel="stylesheet" href="/css/styles.css" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
		<script>
			$(document).on('click', 'form[data-ajax]', function() {
				var el = $(this);
				var context = this;
				$.ajax({
					url: el.prop('action'),
					type: el.prop('method'),
					success: function(data, status, xhr) {
						window[el.data('ajax')].apply(context, [
							data, status, xhr
						]);
					}
				})
				return false;
			});
		</script>
	</head>
	<body>
		<?php echo $content; ?>
	</body>
</html>