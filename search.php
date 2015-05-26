<?php
/**
 * The template for displaying Archive pages
 */
?>

<?php get_header(); ?>
    
    <?php global $wp_query; ?>

	<?php do_action( 'sp_start_content_wrap_html' ); ?>
    <div id="main" class="main">
        
    <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <h1 class="page-title">
                    <?php _e('For the term', SP_TEXT_DOMAIN); ?> "<span><?php echo get_search_query(); ?></span>".
                </h1>
            </header><!-- .page-header --> 

            <?php 
                
                // Start the Loop.
                while ( have_posts() ) : the_post();
            ?>
                    <!-- /*
                     * Include the post format-specific template for the content. If you want to
                     * use this in a child theme, then include a file called called content-___.php
                     * (where ___ is the post format) and that will be used instead.
                     */ -->
                    <div class="sp-wrap-post-thumb content-padding-side">
                    <div class="sp-post-thumb one-fourth">
                        <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail( 'medium' ); ?></a>
                    </div>
                    <div class="sp-post-info three-fourth last">
                        <h3 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                        <div class="entry-meta"><?php echo esc_html( get_the_date() ); ?></div>
                        <div class="sp-excerpt"><?php the_excerpt(); ?></div>
                    </div>
                </div>

            <?php   endwhile;
            
                    // Pagination
                    if(function_exists('wp_pagenavi'))
                        wp_pagenavi();
                    else 
                        echo sp_pagination();
            ?> 
    <?php 
        else : 
            get_template_part( 'templates/contents/no-results' );
        endif; 
    ?>
    
    </div> <!-- #main -->
    <?php get_sidebar(); ?>
    <?php do_action( 'sp_end_content_wrap_html' ); ?>
<?php get_footer(); ?>