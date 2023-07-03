<?php
/**
 * The template for displaying footer.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$site_name = get_bloginfo( 'name' );
$footer_nav_menu = wp_nav_menu( [
	'theme_location' => 'footer-menu',
	'menu_class' => 'nav flex-column',
	'list_item_class' => 'nav-item',
	'link_class' => 'nav-link',
	'echo' => false,
] );
?>

<hr class="my-5">

<footer id="site-footer" class="site-footer sticky-footer pb-5" role="contentinfo">
    <div class="container d-md-flex justify-content-between gap-4">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
		    <?php
		    if (has_custom_logo()) {
			    $custom_logo_id = get_theme_mod( 'custom_logo' );
			    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			    printf('<img src="%s" alt="%s" class="img-fluid" width="200" height="58"></a>', esc_url( $logo[0] ),  $site_name);
		    } else {
			    echo esc_html( $site_name );
		    }
		    ?>
        </a>

        <?php if ( $footer_nav_menu ) { ?>
            <nav class="site-navigation mt-4 mt-md-0">
		        <?php
		        // PHPCS - escaped by WordPress with "wp_nav_menu"
		        echo $footer_nav_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		        ?>
            </nav>
        <?php } ?>
    </div>
</footer>