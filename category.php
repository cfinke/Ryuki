<?php
/**
 * The homepage template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

// Posts that shouldn't be included in the featured section.
// To start, don't show the most recent post, since it's at the top of the page.
// Then, make sure we don't duplicate posts across the sections.
$exclude_posts = array();

get_header();

?>

	<div id="ryuki-primary" class="ryuki-content-area homepage">
		<div id="ryuki-content" class="ryuki-site-content">
			<div id="sidebar-home" role="complementary">
				<hgroup>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</hgroup>
				<?php dynamic_sidebar( 'sidebar-home' ); ?>
			</div>

			<div class="homepage-post" role="main">
				<?php if ( have_posts() ) : ?>
					<div id="ryuki-featured-categories">
						<div>
							<span class="category-name">
								<a><?php printf( __( 'Category: %s', 'ryu' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></a>
							</span>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'featured-on-homepage' ); ?>
							<?php endwhile; ?>
						</div>
					</div>
				<?php else : ?>
					<?php get_template_part( 'no-results', 'archive' ); ?>
				<?php endif; ?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php if ( have_posts() ) : ?>
		<?php ryu_content_nav( 'nav-below' ); ?>
	<?php endif; ?>
<?php get_footer(); ?>