<?php

/**
 * Google Tracking Codes
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

// Google Analytics
function <%= opts.functionPrefix %>_google_analytics( $ID ) {
	ob_start(); ?>

	<!-- Google Analytics -->
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', '<?php echo $ID; ?>', 'auto');
	ga('send', 'pageview');
	</script>
	<!-- End Google Analytics -->

	<?php echo ob_get_clean();
}

// Google Analytics Async
function <%= opts.functionPrefix %>_google_analytics_async( $ID ) {
	ob_start(); ?>

	<!-- Google Analytics -->
	<script>
	window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
	ga('create', '<?php echo $ID; ?>', 'auto');
	ga('send', 'pageview');
	</script>
	<script async src='https://www.google-analytics.com/analytics.js'></script>
	<!-- End Google Analytics -->

	<?php echo ob_get_clean();
}

// Google Tag Manager Header
function <%= opts.functionPrefix %>_google_tag_header( $ID ) {
	ob_start(); ?>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','<?php echo $ID; ?>');</script>
	<!-- End Google Tag Manager -->

	<?php echo ob_get_clean();
}

// Google Tag Manager Footer
function <%= opts.functionPrefix %>_google_tag_footer( $ID ) {
	ob_start(); ?>

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $ID; ?>"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<?php echo ob_get_clean();
}
