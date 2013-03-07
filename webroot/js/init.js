$(document).ready(function() {
	$(document).on('click', '[data-ajax]', function() {
		var el = $(this);
		var context = this;

		var url, method;
		if (this.tagName.toLowerCase() === 'form') {
			url = el.prop('action');
			method =  el.prop('method');
			data = el.serialize();
		} else {
			url = el.prop('href');
			method = 'GET';
			data = [];
		}

		$.ajax({
			url: url,
			type: method,
			data: data,
			success: function(data, status, xhr) {
				window[el.data('ajax')].apply(context, [
					data, status, xhr
				]);
			}
		})
		return false;
	});

	window.replaceContent = function(data) {
		$(this).closest('.content').html(data);
	}

	// configure videos
	$('video')
		.each(function() {
			var w = $(this).width();
			var h = w*9/16;
			$(this).attr('width', w);
			$(this).attr('height', h);
		})
		.mediaelementplayer({
			pluginPath: '/swf/',
			success: function(media, node) {
				if (media.pluginType !== 'native' && jQuery(node).attr('data-streamfile')) {
					media.setSrc(jQuery(node).attr('data-streamfile'));
					media.load();
				}
			}
		});
	$('nav button').click(function() {
		var top = $('nav').position().top;
		if (top < 0) {
			$('nav').css('top', 0);
			var tstring = 'rotate(180deg)';
			$('nav button').css({
				'-webkit-transform': tstring,
				'-moz-transform': tstring,
				'-ms-transform': tstring,
				'-o-transform': tstring,
				'transform': tstring
			});
			$('video, .mjes-container').hide();
		} else {
			$('nav').css('top', -$('nav').height());
			var tstring = 'rotate(0deg)';
			$('nav button').css({
				'-webkit-transform': tstring,
				'-moz-transform': tstring,
				'-ms-transform': tstring,
				'-o-transform': tstring,
				'transform': tstring
			});
			// hide visible videos
			// see: http://stackoverflow.com/questions/3007797/ipad-iphone-html5-video-loading
			$('video, .mjes-container').show();
		}
	});
});