jQuery(document).ready(function($) {
	function HideAll() {
		$('div[id^="<%= opts.functionPrefix %>_meta_box_post_"]').hide();
	};
	
	HideAll();
	
	$('#<%= opts.functionPrefix %>_meta_box_post_' + $('input[name=post_format]:checked').val()).show();
	
	$('#post-formats-select input').change(function() {
		HideAll();
		if ($( '#<%= opts.functionPrefix %>_meta_box_post_' + $( this ).val() ).length) {
			$( '#<%= opts.functionPrefix %>_meta_box_post_' + $( this ).val() ).show();
			
			$('html,body').animate({
				scrollTop: $( '#<%= opts.functionPrefix %>_meta_box_post_' + $( this ).val() ).offset().top
			});
		}
	});
	
	$('.wp-color-picker').wpColorPicker();
	
	$('input[id^="<%= opts.functionPrefix %>_"][id $="_button"]').click(function(e){
		meta_media_frame = wp.media.frames.meta_media_frame = wp.media({
			title: 'Insert Media'
		});
		
		meta_media_frame.open();
		
		meta_media_frame.on('select', function(){
			var media_attachment = meta_media_frame.state().get('selection').first().toJSON();
			$('#' + e.target.id.replace('_button','')).val(media_attachment.url);
		});
	});
});
