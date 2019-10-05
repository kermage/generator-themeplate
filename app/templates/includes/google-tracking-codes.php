<?php

/**
 * Google Tracking Codes
 *
 * @package ThemePlate
 * @since 0.1.0
 */

// phpcs:disable WordPress.WP.EnqueuedResources.NonEnqueuedScript

// Google Analytics
if ( ! function_exists( 'themeplate_google_analytics' ) ) {
	function themeplate_google_analytics( $id ) {
		ob_start();
		?>

		<!-- Google Analytics -->
		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', '<?php echo esc_html( $id ); ?>', 'auto');
		ga('send', 'pageview');
		</script>
		<!-- End Google Analytics -->

		<?php
		echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

// Google Analytics Async
if ( ! function_exists( 'themeplate_google_analytics_async' ) ) {
	function themeplate_google_analytics_async( $id ) {
		ob_start();
		?>

		<!-- Google Analytics -->
		<script>
		window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
		ga('create', '<?php echo esc_html( $id ); ?>', 'auto');
		ga('send', 'pageview');
		</script>
		<script async src='https://www.google-analytics.com/analytics.js'></script>
		<!-- End Google Analytics -->

		<?php
		echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

// Google Analytics Global Site Tag
if ( ! function_exists( 'themeplate_google_analytics_gtag' ) ) {
	function themeplate_google_analytics_gtag( $id ) {
		ob_start();
		?>

		<!-- Global Site Tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_html( $id ); ?>"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', '<?php echo esc_html( $id ); ?>');
		</script>

		<?php
		echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

// Google Tag Manager <head>
if ( ! function_exists( 'themeplate_google_tag_head' ) ) {
	function themeplate_google_tag_head( $id ) {
		ob_start();
		?>

		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','<?php echo esc_html( $id ); ?>');</script>
		<!-- End Google Tag Manager -->

		<?php
		echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

// Google Tag Manager <body>
if ( ! function_exists( 'themeplate_google_tag_body' ) ) {
	function themeplate_google_tag_body( $id ) {
		ob_start();
		?>

		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_html( $id ); ?>"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

		<?php
		echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
