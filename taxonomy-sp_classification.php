<?php
/**
 * The template for displaying Archive pages
 */
?>

<?php get_header(); ?>
    <?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
    
	<?php do_action( 'sp_start_content_wrap_html' ); ?>
    <div id="main" class="main">
        
    <?php if ( have_posts() ) : ?>

            <header class="page-header content-padding-side">
                <?php $term_meta = get_option( 'taxonomy_' . $term->term_id ); ?>
                <h2 class="title"><?php echo $term->name; ?></h2>
            </header><!-- .page-header --> 

            <?php 
                while ( have_posts() ) : the_post(); ?>
                <div class="sp-wrap-post-thumb content-padding-side">
                    <div class="sp-post-thumb one-fourth">
                        <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail( 'medium' ); ?></a>
                    </div>
                    <div class="sp-post-info three-fourth last">
                        <h3 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                        <?php $listing_meta = get_post_meta( $post->ID ); ?>
                        <span><?php echo $listing_meta['sp_lt_address'][0]; ?></span>
                        <?php 
                            $comm_lines = unserialize($listing_meta['sp_lt_comm_line'][0]);
                            if ( !empty($comm_lines) ) :
                                $out = '<ul class="comm-line">';
                                foreach ($comm_lines as $comm_line ) {
                                    $comm_type = $comm_line['sp_lt_comm_type'];
                                    $comm_value = $comm_line['sp_lt_comm_value']; 

                                    if ( $comm_type == 'e-mail' ) {
                                        $out .= '<li><span class="attr">' . $comm_type . '</span><span class="value"><a href="mailto:' . $comm_value . '">' . $comm_value . '</a></span></li>'; 
                                    } elseif ( $comm_type == 'website' ) {
                                        $out .= '<li><span class="attr">' . $comm_type . '</span><span class="value"><a href="http://' . $comm_value . '" target="_blank">' . $comm_value . '</a></span></li>'; 
                                    } else {
                                        $out .= '<li><span class="attr">' . $comm_type . '</span><span class="value">' . $comm_value . '</span></li>';
                                    }
                                }
                                $out .= '</ul>';
                                echo $out;
                            endif;
                        ?>
                    </div>
                </div>
            <?php endwhile;
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