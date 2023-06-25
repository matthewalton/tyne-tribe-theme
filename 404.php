<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<main id="content" class="site-main">
	<div class="page-content">
		<p><?php echo esc_html__( 'It looks like nothing was found at this location.', TYNE_TRIBE_DOMAIN ); ?></p>
	</div>
</main>

<?php
get_footer();

