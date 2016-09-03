<?php

/**
 * The main template file
 *
 * @package <%= opts.themeName %>
 * @since 0.1.0
 */

get_header(); ?>

            <div class="content-sidebar container">
                <main class="content" role="main">
                
                    <?php if( is_home() && ! is_front_page() ) : ?>
                        <h1 class="page-title"><?php single_post_title(); ?></h1>
                    <?php endif; ?>
                    
                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ): the_post(); ?>
                            
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            
                                <?php if( has_post_thumbnail() ) : ?>
                                    <div class="entry-featured">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="entry-wrap">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a></h2>
                                        
                                        <div class="entry-meta">
                                            <time><?php the_date(); ?></time>
                                            <span><?php the_author(); ?></span>
                                        </div>
                                    </header>
                                    
                                    <div class="entry-content">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    
                                    <footer class="entry-footer">
                                        <?php the_tags(); ?>
                                    </footer>
                                </div>
                            </article><!-- #post-<?php the_ID(); ?> -->
                            
                        <?php endwhile; ?>
                        
                        <?php the_posts_pagination(); ?>
                        
                    <?php endif; ?>
                    
                </main><!-- .content -->
                
                <?php get_sidebar(); ?>
                
            </div><!-- .content-sidebar.container -->

<?php get_sidebar( 'footer' ); ?>
<?php get_footer();
