<?php get_header(); ?>

<main role="main">
    <!-- section -->
    <section>

        <div class="page-template has-sidebar-right">

            <div class="page-template__content">

                <?php if (have_posts()): while (have_posts()) : the_post(); ?>

                    <!-- article -->
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <!-- post title -->
                        <h1 class="page-title"><?php the_title(); ?></h1>
                        <!-- /post title -->

                        <!-- post details -->
                        <span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
                        <span class="author"><?php _e( 'Published by', 'tpl' ); ?> <?php the_author_posts_link(); ?></span>
                        <!-- /post details -->

                        <?php the_content(); // Dynamic Content ?>

                        <?php the_tags( __( 'Tags: ', 'tpl' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>

                        <p><?php _e( 'Categorised in: ', 'tpl' ); the_category(', '); // Separated by commas ?></p>

                        <?php /*comments_template();*/ ?>

                    </article>
                    <!-- /article -->

                <?php endwhile; ?>

                <?php else: ?>

                    <!-- article -->
                    <article>

                        <h1><?php _e( 'Sorry, nothing to display.', 'tpl' ); ?></h1>

                    </article>
                    <!-- /article -->

                <?php endif; ?>

            </div>

            <div class="page-template__sidebar">

                <!-- post thumbnail -->
                <?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
                    <div class="single-post__thumb has-pass blue">
                        <?php the_post_thumbnail( 'single-post-picture' ); // Fullsize image for the single post ?>
                    </div>
                <?php endif; ?>
                <!-- /post thumbnail -->

                <div class="sidebar-box">
                    <?php dynamic_sidebar( 'single-post-widget' ); ?>
                </div>

            </div>

        </div>

    </section>
    <!-- /section -->
</main>

<?php get_footer(); ?>
