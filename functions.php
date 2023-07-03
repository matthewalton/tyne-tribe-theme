<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

define( 'TYNE_TRIBE_DOMAIN', 'tynetribe');
define( 'TYNE_TRIBE_VERSION', '1.0.0' );

if ( ! function_exists( 'tynetribe_setup' ) ) {
	/**
	 * @return void
	 */
    function tynetribe_setup(): void
    {

	    register_nav_menus( [ 'header-menu' => esc_html__( 'Header', TYNE_TRIBE_DOMAIN ) ] );
	    register_nav_menus( [ 'footer-menu' => esc_html__( 'Footer', TYNE_TRIBE_DOMAIN ) ] );

        add_post_type_support('page', 'excerpt');

		add_theme_support('post-thumbnails');
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'script',
                'style',
            ]
        );
        add_theme_support(
            'custom-logo',
            [
                'height' => 58,
                'width' => 200,
                'flex-height' => true,
                'flex-width' => true,
            ]
        );

        /*
         * Editor Style.
         */
        add_editor_style('classic-editor.css');

        /*
         * Gutenberg wide images.
         */
        add_theme_support('align-wide');
    }

	add_action( 'after_setup_theme', 'tynetribe_setup' );
}

if ( ! function_exists( 'tynetribe_styles' ) ) {
	/**
	 * @return void
	 */
    function tynetribe_styles(): void
    {
        wp_enqueue_style(
            'tyne-tribe',
            get_template_directory_uri() . '/assets/css/style.css',
            [],
            TYNE_TRIBE_VERSION
        );
    }

	add_action( 'wp_enqueue_scripts', 'tynetribe_styles' );
}

if ( ! function_exists( 'tynetribe_scripts' ) ) {
	/**
	 * @return void
	 */
	function tynetribe_scripts(): void
	{
		wp_enqueue_script(
			'bootstrap',
			get_template_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
			[],
			TYNE_TRIBE_VERSION,
			true
		);

		wp_enqueue_script(
			'color-switcher',
			get_template_directory_uri() . '/assets/js/color-switcher.min.js',
			[],
			TYNE_TRIBE_VERSION,
			true
		);
	}

	add_action( 'wp_enqueue_scripts', 'tynetribe_scripts' );
}


if ( ! function_exists( 'tynetribe_menu_classes' ) ) {
	/**
	 * @param $classes
	 * @param $item
	 * @param $args
	 *
	 * @return array
	 */
	function tynetribe_menu_classes($classes, $item, $args): array
	{
		if (property_exists($args, 'list_item_class')) {
			$classes[] =  $args->list_item_class;
		}

		return $classes;
	}

	add_filter('nav_menu_css_class', 'tynetribe_menu_classes', 10, 3);
}

if ( ! function_exists( 'tynetribe_menu_link_class' ) ) {
	/**
	 * @param $atts
	 * @param $item
	 * @param $args
	 *
	 * @return mixed
	 */
	function tynetribe_menu_link_class($atts, $item, $args) {
		if (property_exists($args, 'link_class')) {
			$atts['class'] = $args->link_class;
		}

		return $atts;
	}

	add_filter( 'nav_menu_link_attributes', 'tynetribe_menu_link_class', 10, 3 );
}

if ( ! function_exists( 'tynetribe_register_navwalker' ) ) {
	/**
	 * Register Custom Navigation Walker
	 */
	function tynetribe_register_navwalker(): void
	{
		require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
	}

	add_action( 'after_setup_theme', 'tynetribe_register_navwalker' );
}
