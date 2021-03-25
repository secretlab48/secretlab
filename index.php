<?php get_header(); ?>

	<main role="main">
        <div class="page-content">
            <section>

                <div class="page-template has-not-sidebar">

                    <div class="page-template__content">

                        <div class="post-archive-heading">
                            <?php
                                $title = $description = '';
                                $current_cat = false;
                                if ( is_category() ) {
                                    $current_cat = get_category( get_query_var( 'cat' ) );
                                    $title = $current_cat->name;
                                    $description = $current_cat->description;
                                }
                                else if ( is_home() || is_front_page() ) {
                                    $title = __( 'blog', 'tpl' );
                                    $description = __( 'description', 'tpl' );
                                }
                            ?>
                            <h1><?php echo $title ?></h1>
                            <div class="post-archive-category__description"><?php echo $description; ?></div>
                        </div>

                        <?php
                            $terms = $terms = get_terms( array( 'taxonomy' => 'category', 'hide_empty' => false, 'exclude' => array( 1 ) ) );
                            if ( count( $terms ) > 0 ) {
                                $lang = $locale == 'ru_RU' ? '/ru' : '';
                                echo '<div class="posts-archive-cats-box">';
                                echo '<div class="post-archive-cat-item-box"><a class="post-archive-cat-item" href="' . site_url() .  $lang . '/blog">' . __( 'all', 'trl' ) . '</a></div>';
                                foreach ( $terms as $i => $term ) {
                                    $active_class = ( $current_cat && ( $current_cat->term_id == $term->term_id ) ) ? ' active-category' : '';
                                    echo '<div class="post-archive-cat-item-box"><a class="post-archive-cat-item' . $active_class . '" href="' . get_term_link( $term->term_id, 'category' ) . '">' . $term->name . '</a></div>';
                                }
                                echo '</div>';
                            }
                        ?>

                        <div class="posts-archive-items-box">
                            <div class="post-archive-item-box__grid-sizer"></div>
                            <?php get_template_part('loop'); ?>
                        </div>

                        <?php get_template_part('pagination'); ?>

                    </div>

                </div>

            </section>
        </div>
	</main>

<?php get_footer(); ?>
