<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

    <main id="content" <?php post_class( 'site-main container' ); ?>>
        <?php if ( is_home() ) { ?>
            <?php
	        $current_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	        $current_page = max( 1, $current_page );

	        $per_page     = get_option( 'posts_per_page' );
	        $offset_start = 0;
	        $offset       = ( $current_page - 1 ) * $per_page + $offset_start;
            ?>

            <?php if ($current_page === 1) { ?>
                <?php
                $featured_posts = new WP_Query([
			        'tax_query' => [
				        [
					        'taxonomy'  => 'post_tag',
					        'field'      => 'slug',
					        'terms'     => 'featured'
				        ]
			        ]
		        ]);
                ?>
		        <?php if ($featured_posts->have_posts()) { ?>
                    <div class="row">
				        <?php $count = 0; ?>
				        <?php while ($featured_posts->have_posts() && $count === 0) : $featured_posts->the_post() ?>
					        <?php if ($count === 0) { ?>
                                <div class="col-12 mb-4">
                                    <div class="p-4 p-md-5 rounded text-body-emphasis bg-body-tertiary">
								        <?php if (has_post_thumbnail()) { ?>
                                            <div class="col-lg-6">
										        <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'img-fluid', 'alt' => get_the_title()]); ?>
                                            </div>
								        <?php } ?>
                                        <div class="col-lg-6">
                                            <h1 class="display-4 fst-italic"><?php the_title(); ?></h1>
                                            <p class="lead my-3"><?php the_excerpt(); ?></p>
                                            <div class="media align-items-center mt-auto">
                                                <div class="media-body text-muted font-size-1">
											        <?php the_date(); ?>
                                                </div>
                                            </div>
                                            <p class="lead mb-0"><a href="<?php the_permalink(); ?>" class="text-body-emphasis fw-bold">Continue reading...</a></p>
                                        </div>
                                    </div>
                                </div>
					        <?php } else { ?>
                                <div class="col-md-6 mb-4">
                                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                        <div class="col p-4 d-flex flex-column position-static">
                                            <strong class="d-inline-block mb-2 text-primary-emphasis">World</strong>
                                            <h3 class="mb-0"><?php the_title(); ?></h3>
                                            <div class="mb-1 text-body-secondary"><?php the_date(); ?></div>
                                            <p class="card-text mb-auto"><?php the_excerpt(); ?></p>
                                            <a href="<?php the_permalink(); ?>" class="icon-link gap-1 icon-link-hover stretched-link">
                                                Continue reading
                                                <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
                                            </a>
                                        </div>
								        <?php if (has_post_thumbnail()) { ?>
                                            <div class="col-auto d-none d-lg-block">
										        <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'img-fluid', 'alt' => get_the_title()]); ?>
                                            </div>
								        <?php } ?>
                                    </div>
                                </div>
					        <?php } ?>
					        <?php $count++; ?>
				        <?php endwhile; ?>
                    </div>
		        <?php } ?>

		        <?php wp_reset_query(); ?>
            <?php } ?>

            <?php
            $older_posts = new WP_Query([
		        'posts_per_page' => $per_page,
		        'orderby'        => 'date',
		        'order'          => 'desc',
		        'offset'         => $offset,
		        'tax_query' => [
			        [
				        'taxonomy' => 'post_tag',
				        'field' => 'slug',
				        'terms' => 'featured',
				        'operator' => 'NOT IN'
			        ]
		        ]
	        ]);
            ?>
            <?php if ($older_posts->have_posts()) { ?>
                <div class="row g-5">
                    <?php while ($older_posts->have_posts()) : $older_posts->the_post() ?>
                        <div class="col-md-8">
                            <article class="blog-post">
                                <h2 class="display-5 link-body-emphasis mb-1"><?php the_title(); ?></h2>
                                <p class="blog-post-meta">
                                    <?php the_date(); ?> by <a href=""></a>
                                </p>

                                <p class="lead my-3"><?php the_excerpt(); ?></p>
                            </article>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php } ?>

            <?php wp_reset_query(); ?>

            <nav class="blog-pagination" aria-label="Pagination">
	            <?php previous_posts_link( 'Older' ); ?>
                <a class="btn btn-outline-primary rounded-pill" href="#">Older</a>
                <a class="btn btn-outline-secondary rounded-pill">Newer</a>
	            <?php next_posts_link( 'Newer' ); ?>
            </nav>
        <?php } else { ?>
	        <?php the_content(); ?>
        <?php } ?>
    </main>

<?php
get_footer();
