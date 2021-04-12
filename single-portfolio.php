<?php

    global $post;

    $fields = get_fields( $post->ID );
    $set = $fields['portfolio_set'][0];

    $thumb = get_the_post_thumbnail_url( $post->ID, 'full' );
    $bg = ( $set['color_type'] == 'lightened' ) ? 'linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ),' : '';
    $fs_style = ( $thumb ) ? ' style="background:' . $bg . ' url(' . $thumb . ')";' : '';

    get_header( );

?>

<main role="main">
    <!-- section -->
    <section>

        <?php if (have_posts()): while (have_posts()) : the_post(); ?>

            <!-- article -->
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <div class="portfolio-first-screen">
                    <div class="pfs-picture-box">
                        <div class="pfs-picture"<?php echo $fs_style; ?>>

                        </div>
                    </div>
                    <h1><?php echo $set['info']['site_title'] ?></h1>
                    <div class="pfs-short-info">
                        <div class="pfs-short-info__description"><?php echo $set['info']['site_text']; ?></div>
                        <div class="pfs-short-info__link"><a rel="nofollow, noindex" target="_blank" href="<?php echo $set['info']['site_link']; ?>"><?php echo $set['info']['site_link']; ?></a></div>
                    </div>
                </div>

                <div class="page-box portfolio-content-box">
                    <div class="page-content portfolio-content">

                        <?php
                            echo '<div class="portfolio-tasks">';
                            foreach( $set['tasks'] as $task ) {
                                echo
                                '<div class="portfolio-task">
                                     <div class="portfolio-task__title"><span>' . $task['task_title'] . '</span></div>
                                     <div class="portfolio-task__description">' . $task['task_description'] . '</div>
                                 </div>';
                            }
                            if ( isset( $set['carousel'] ) && is_array( $set['carousel'] ) && count( $set['carousel'] ) > 0 ) {
                                echo
                                '<div class="portfolio-task">
                                     <div class="portfolio-task__title"><span>Features</span></div>
                                         <div class="portfolio-task__description">
                                             <div class="portfolio-features swiper-container">
                                                 <div class="portfolio-features-service swiper-wrapper">';
                                $pagination_items = '';
                                foreach ( $set['carousel'] as $i => $item ) {
                                    $activeClass = ( $i == 0 ) ? ' active' : '';
                                    $img = $item['image']['sizes']['portfolio_carousel'];
                                    echo
                                    '<div class="portfolio-feature-box swiper-slide">
                                         <a href="' . $item['image']['url'] . '" class="feature-image" data-effect="mfp-zoom-in"><img src="' . $img . '"></a>
                                         <div class="feature-title">' . $item['title'] . '</div>
                                         <div class="feature-description">' . $item['description'] . '</div>
                                     </div>';
                                    $pagination_items .= '<div class="swiper-pagination-item swiper-pagination-clickable' . $activeClass . '">0' . ( $i + 1 ) . '</div>';
                                }
                                echo
                                                 '</div>
                                             </div>
                                             <div class="swiper-pagination-custom">' .
                                                 $pagination_items .
                                             '</div>
                                         </div>
                                     </div>
                                </div>';
                            }
                            echo '</div>';
                            the_content();
                        ?>

                    </div>
                </div>


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

    </section>
    <!-- /section -->
</main>

<?php get_footer(); ?>
