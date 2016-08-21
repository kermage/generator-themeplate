<?php

/**
 * The template for displaying the footer
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */
?>

        </div><!-- .site-content -->
        
        <footer class="site-footer" role="contentinfo">
            <div class="wrap">
                <nav class="sitelinks">
                    <?php <%= opts.functionPrefix %>_footer_menu(); ?>
                </nav>
                
                <div class="copyright">
                    Copyright &copy; <%= new Date().getFullYear() %> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>.
                    <span>Designed and developed by <a href="<?php echo AUTHOR_URI; ?>"><?php echo THEME_AUTHOR; ?></a>.</span>
                </div>
            </div>
        </footer><!-- .site-footer -->
        
    <?php wp_footer(); ?>
    </body>
</html>
