<?php

/**
 * The template containing the sidebar areas
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */
?>

                <aside class="sidebar" role="complementary">
                    <?php dynamic_sidebar( 'sidebar' ); ?>
                </aside><!-- .sidebar -->
                
            </div><!-- .content-sidebar wrap -->
            
            <div class="footer">
                <div class="wrap">
                    <?php dynamic_sidebar( 'footer-1' ); ?>
                    <?php dynamic_sidebar( 'footer-2' ); ?>
                    <?php dynamic_sidebar( 'footer-3' ); ?>
                </div>
            </div><!-- .footer -->
