<?php
get_header();
?>
<main class="container">
	<?php
	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content_single', get_post_format() );

//			the_post_navigation();
//
//			// If comments are open or we have at least one comment, load up the comment template.
//			if ( comments_open() || get_comments_number() ) :
//				comments_template();
//			endif;

	endwhile; // End of the loop.
	?>
</main>

<?php
get_footer();
