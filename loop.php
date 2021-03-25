<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-archive-item-box' ); ?>>

        <div class="post-archive-item">

            <!-- post thumbnail -->
            <?php if ( has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-archive__thumbnail">
                    <?php the_post_thumbnail( 'portfolio_archive' );  ?>
                </a>
            <?php endif; ?>
            <!-- /post thumbnail -->

            <!-- post title -->
            <h2>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-archive__h2"><?php the_title(); ?></a>
            </h2>
            <!-- /post title -->

            <span class="post-archive__date"><?php the_time('j F, Y'); ?></span>

            <div class="post-archive__excerpt">
                <?php the_excerpt(); ?>
            </div>

        </div>

	</article>
	<!-- /article -->

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'tpl' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
