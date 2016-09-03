<?php

/**
 * The template for displaying single posts
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

get_header(); ?>

            <div class="content-sidebar container">
                <main class="content" role="main">
                    
                    <?php while ( have_posts() ): the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            
                            <?php if( has_post_thumbnail() ) : ?>
                                <div class="entry-featured">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="entry-wrap">
                                <header class="entry-header">
                                    <h1 class="entry-title"><?php the_title(); ?></h1>
                                    
                                    <div class="entry-meta">
                                        <time><?php the_date(); ?></time>
                                        <span><?php the_author(); ?></span>
                                    </div>
                                </header>
                                
                                <div class="entry-content">
                                    <?php the_content(); ?>
                                </div>
                                
                                <footer class="entry-footer">
                                    <?php the_tags(); ?>
                                </footer>
                            </div>
                        </article><!-- #post-<?php the_ID(); ?> -->
                        
                    <?php endwhile; ?>
                    
                </main><!-- .content -->
                
                <?php get_sidebar(); ?>
                
            </div><!-- .content-sidebar.container -->

<?php get_sidebar( 'footer' ); ?>
<?php get_footer();
