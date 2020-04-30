<?php
get_header();
?>
    <main class="container">
		<?php
		// вывод сотрудников
		$args  = array(
			'orderby' => 'Name',
			'order'   => 'DESC'
		);
		$terms = get_terms( 'tax_staff', $args );
		if ( $terms ) {
			foreach ( $terms as $term ) {
				echo "<h2 class='text-center bb'>{$term->name}</h2>";
				echo '<div class="row">';

				$posts = get_posts( array(
					'post_type' => 'staff',
					'tax_staff' => $term->slug
				) );
				if ( $term->slug == 'lab_assist' ) {
					foreach ( $posts as $post ) {
						setup_postdata( $post );
						echo '<div class="col-sm-6 col-md-4 card card_prepod">';
						if ( has_post_thumbnail() ) {
							$thumbnail_attr = array(
								'class' => "img-fluid text-center mx-auto",
								'alt'   => get_the_title(),
								'altitlet'   => get_the_title()
							);
							the_post_thumbnail( 'Medium', $thumbnail_attr );
						} else {
							echo '<img class="mx-auto" src="https://placehold.it/200x200&text=NO_LOGO" title alt=" ' . get_the_title() . ' ">';
						}
						the_title( '<h5 class="text-center" style="word-spacing: 600px">', '</h5>' );
						echo '</div>';
					}
					wp_reset_postdata();
				} else {
					foreach ( $posts as $post ) {
						setup_postdata( $post );
						echo '<div class="col-sm-6 col-md-4">';
						echo '<a class="card card_prepod" href=" ' . get_permalink() . ' ">';
						if ( has_post_thumbnail() ) {
							$thumbnail_attr = array(
								'class' => "img-fluid text-center mx-auto",
								'alt'   => get_the_title(),
								'altitlet'   => get_the_title()
							);
							the_post_thumbnail( 'Medium', $thumbnail_attr );
						} else {
							echo '<img class="mx-auto" src="https://placehold.it/200x200&text=NO_LOGO" alt=" ' . get_the_title() . ' ">';
						}
						the_title( '<h5 class="text-center" style="word-spacing: 600px">', '</h5>' );
						echo '</a>';
						echo '</div>';
					}
					wp_reset_postdata();
				}
				echo '</div>';
			}
		}
		?>

    </main>
<?php
get_footer();
