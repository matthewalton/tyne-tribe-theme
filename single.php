<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

while ( have_posts() ) : the_post();
?>

	<main id="content" <?php post_class( 'site-main container' ); ?>>

        <div class="page-content">
	        <?php if (has_post_thumbnail()) { ?>
                <div class="text-center">
			        <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'img-fluid', 'alt' => get_the_title()]); ?>
                </div>
	        <?php } ?>

            <div class="py-3 my-5 border-top border-bottom">
                <h1><?php the_title(); ?></h1>
                <span class="d-block"><?php the_date() ?> by <?php the_author(); ?></span>
            </div>

			<?php the_content(); ?>

	        <?php if ($post_tags = get_the_tags()) { ?>
                <div class="d-flex gap-2 mb-3">
			        <?php
			        foreach ($post_tags as $tag) {
				        printf('<span class="badge text-body-tertiary bg-body-tertiary">%s</span>', ucfirst($tag->name));
			        }
			        ?>
                </div>
	        <?php } ?>

            <hr class="my-5">

			<?php wp_link_pages(); ?>
        </div>

		<?php comments_template(); ?>
	</main>

<?php
endwhile;

get_footer();
