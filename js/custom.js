//*************************************************
// ADDS SPAN AROUND IMAGES FOR ROUNDED CORNERS
//*************************************************

$('document').ready(function() {
	$('#main-image img, .post img').each(function() {
		$(this).wrap(function() {
			return '<span class="rounded ' + $(this).attr('class') + '" style="width: ' + $(this).width() + 'px; height: ' + $(this).height() + 'px;" />';
		});
	});
});
