<?php
/**
 * @package Ryu
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'featured-on-homepage' ); ?>>
	<div class="entry-wrap wrap clear">
		<?php
		
		if ( function_exists( 'get_the_image' ) ) {
			$image = get_the_image();
		}
		else if ( '' != get_the_post_thumbnail() ) {
			$image = the_post_thumbnail( 'ryu-featured-thumbnail' );
		}
		
		if ( $image ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'ryuki' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="<?php the_ID(); ?>">
				<?php echo $image; ?>
			</a>
		<?php endif; ?>

		<?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' ); ?>
	</div><!-- .entry-wrap -->
</article><!-- #post-## -->