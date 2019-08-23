<?php
/**
 * @package Ryu
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'clear' ); ?>>
	<div class="ryuki-entry-wrap wrap">
		<header class="ryuki-entry-header">
			<?php echo '<span class="categories-links">' . esc_html__( 'The Latest', 'ryuki' ) . '</span>'; ?>
			<?php the_title( '<h1 class="ryuki-entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="ryuki-entry-summary">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ryuki' ) ); ?>
		</div><!-- .entry-summary -->
	</div><!-- .entry-wrap -->
</article><!-- #post-## -->