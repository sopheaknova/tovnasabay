<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if ( is_single() ) : ?>
	<header class="entry-header content-padding-side">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-meta">
			<?php
				if ( 'post' == get_post_type() )
					sp_meta_posted_on();
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
	<?php else : ?>
		<div class="sp-wrap-post-thumb content-padding-side">
			<div class="sp-post-thumb">
				<a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo the_post_thumbnail('large'); ?></a>
			</div>
			<div class="sp-post-info">
				<h3 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				<div class="entry-meta"><?php echo esc_html( get_the_date() ); ?></div>
				<div class="sp-excerpt"><?php the_excerpt(); ?></div>
			</div>
		</div>

	<?php endif; ?>

	


	<?php if ( is_single() ) : ?>
	<div class="entry-content content-padding-side">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', SP_TEXT_DOMAIN ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

</article><!-- #post-## -->
