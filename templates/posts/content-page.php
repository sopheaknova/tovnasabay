<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Page thumbnail and title.
		the_title( '<header class="entry-header content-padding-side"><h2 class="entry-title">', '</h2></header><!-- .entry-header -->' );
	?>

	<div class="entry-content content-padding-side">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->