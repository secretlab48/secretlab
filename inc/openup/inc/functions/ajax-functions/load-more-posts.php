<?php

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

function load_more_posts()
{

    $cur_taxonomy = $_POST['taxonomy'];
    $cur_term = $_POST['term'];
    $post_type = $_POST['post_type'];
    $post_per_page = ( $post_type == 'post' ) ? 6 : 3;
    $entity_template = ( $post_type == 'business_post' ) ? 'business-post-card' : 'post-card';

    $args = array(
        'post_status' => 'publish',
        'post_type' => array($post_type),
        'posts_per_page' => $post_per_page,
        'paged' => $_POST['page'] + 1,
        'orderby' => 'date',
        'order' => 'DESC'
    );

    if (!empty($cur_taxonomy) && !empty($cur_term)):
        $args['tax_query'] = array(
            array(
                'taxonomy' => $cur_taxonomy,
                'field' => 'slug',
                'terms' => $cur_term,
            )
        );

    endif;

    $query = new WP_Query($args);

    if ($query->have_posts()):
        while ($query->have_posts()):
            $query->the_post(); ?>
            <div class="col-md-6 col-lg-4 JS--posts--item">
                <?php get_template_part('template-parts/components/' . $entity_template ); ?>
            </div>
        <?php endwhile;
        wp_reset_postdata();
    endif;
    wp_die();

}


/* Function ajax load more faq */

add_action('wp_ajax_faq_load_more', 'faq_load_more');
add_action('wp_ajax_nopriv_faq_load_more', 'faq_load_more');
function faq_load_more()
{
    $page_id = $_POST["pageId"];
    $page_filter = $_POST["pageFilter"];
    $post_ids = implode(",", $_POST["postId"]);
    $post_ids = explode( ',', $post_ids );
    $terms = [];
    for ($i = 0; $i <= 10; $i++) {
        $terms[] = get_post_meta($page_id, 'flexible_content_page_' . $i . '_' . 'faq_section_taxonomy', true);
    }
    $terms = array_values(array_filter($terms));
    $terms_query = (!empty($page_filter)) ? $page_filter : $terms[0];
    $tax_query = array(
        array(
            'taxonomy' => 'faq_type',
            'field' => 'term_id',
            'terms' => $terms_query,
        )
    );
    $faq_arg_term = array(
        'post_type' => 'faq',
        'posts_per_page' => 5,
        'tax_query' => $tax_query,
        'orderby' => 'date',
        'order' => 'DESC',
        'post__not_in' => $post_ids
    );
    $faq_query = new WP_Query($faq_arg_term);


    if ($faq_query->have_posts()): ?>
        <?php
        $faqs = $faq_query->posts;
        foreach ($faqs as $faq) {
            get_template_part('template-parts/components/accordion-post', null, ['post' => $faq]);
        }
        ?>

    <?php endif;

    die();
}




