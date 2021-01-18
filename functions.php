<?php

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function my_theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

/**
 * Register widgetized area and update sidebar with default widgets
 */
function ryuki_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Homepage Widget Area', 'ryuki' ),
		'id'            => 'sidebar-home',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'After-Content Widget Area', 'ryuki' ),
		'id'            => 'after-content-widgets',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'ryuki_widgets_init' );

add_action( 'customize_register','ryuki_customize_register' );

function ryuki_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'ryuki_featured_categories', array(
		'title' => __( 'Featured Categories', 'ryuki' ),
		'description' => __( 'Select the categories to feature on the homepage', 'ryuki' ),
		'capability' => 'edit_theme_options',
	) );
	
	$categories = get_categories();
	$choices = array( '0' => __( 'Recent Posts (Default)', 'ryuki' ) );

	foreach ( $categories as $category ) {
		$choices[ $category->term_id ] = $category->name;
	}

	for ( $i = 1; $i <= 3; $i++ ) {
		$wp_customize->add_setting( 'ryuki_featured_category_' . $i, array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
		) );
	
		$wp_customize->add_control( 'ryuki_featured_category_' . $i, array(
			'type' => 'select',
			'section' => 'ryuki_featured_categories',
			'label' => sprintf( __( 'Category #%s', 'ryuki' ), $i ),
			'active_callback' => 'is_front_page',
			'choices' => $choices,
		) );
	}
}

function ryuki_setup() {
	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Adding several sizes for Post Thumbnails
	 */
	add_image_size( 'ryuki-featured-thumbnail', 500, 0 );
}

add_action( 'after_setup_theme', 'ryuki_setup' );
