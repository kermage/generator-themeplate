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
});
