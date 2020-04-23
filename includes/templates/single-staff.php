<?php
get_header();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('list_post'); ?>>
	<header class="entry-header">
		<?php
		if ( is_single() ) :
//			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
//		?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail('small', array('class' => 'rounded-circle'));
		}
		else {
			the_excerpt();
		}

		?>
	</div><!-- .entry-content -->
<!--	<footer class="entry-footer">-->
    <a href="<?php echo get_permalink(); ?>"><button class="btn_readmore right"><?php echo esc_html__( 'Читать далее', 'theme_otip_vstu' )?></button></a>
</article><!-- #post-## -->
<?php
get_footer();
