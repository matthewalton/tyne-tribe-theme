<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$site_name = get_bloginfo( 'name' );
$header_nav_menu = wp_nav_menu( [
	'theme_location' => 'header-menu',
    'menu_class' => 'nav nav-underline me-auto mb-2 mb-lg-0',
	'list_item_class' => 'nav-item',
    'link_class' => 'nav-link',
	'echo' => false,
] );
?>

<header id="site-header" class="site-header navbar fixed-top navbar-expand-lg bg-primary shadow" role="banner" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
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

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeaderMenuCollapse" aria-controls="navbarHeaderMenuCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarHeaderMenuCollapse">
            <?php
            if ($header_nav_menu) {
                // PHPCS - escaped by WordPress with "wp_nav_menu"
                echo $header_nav_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }

            get_search_form();
            ?>
        </div>
    </div>
</header>

<div class="position-absolute end-0 bottom-0 translate-middle">
    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme">
            <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
            <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#sun-fill"></use></svg>
                    Light
                    <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="dark" aria-pressed="true">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
                    Dark
                    <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#circle-half"></use></svg>
                    Auto
                    <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
                </button>
            </li>
        </ul>
    </div>
</div>
