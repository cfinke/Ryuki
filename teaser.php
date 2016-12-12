<?php
/**
 * @package Ryu
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'clear' ); ?>>
	<div class="entry-wrap wrap clear">
		<header class="entry-header">
			<?php echo '<span class="categories-links">' . esc_html__( 'The Latest', 'ryuki' ) . '</span>'; ?>
			<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
		</header><!-- .entry-header -->

		<?php if ( '' != get_the_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'ryuki' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="<?php the_ID(); ?>" class="ryu-featured-thumbnail">
				<?php the_post_thumbnail( 'ryu-featured-thumbnail' ); ?>
			</a>
		<?php endif; ?>

		<div class="entry-summary">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ryuki' ) ); ?>
		</div><!-- .entry-summary -->
	</div><!-- .entry-wrap -->
</article><!-- #post-## -->