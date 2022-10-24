<?php
// ajax search
add_action('wp_ajax_nopriv_faq_ajax_search', 'faq_ajax_search');
add_action('wp_ajax_faq_ajax_search', 'faq_ajax_search');


function faq_ajax_search()
{
    global $wp;
    $post_type = $_POST['post_type'];
    $search_key = $_POST['post_key'];
    $search_term_id = $_POST['post_term'];
    $terms_array = explode(" ", $search_term_id);


    $faq_arg_term = array();


    if (isset($post_type) && isset($search_key) && !isset($search_term_id) ) :
        $faq_arg_term = array(
            'post_type' => $post_type,
            'post_status' => 'publish',
            's' => $search_key,
            'posts_per_page' => -1,
        );

    elseif (isset($post_type) && isset($search_key) && !empty($terms_array)):
        $faq_arg_term = array(
            'post_type' => $post_type,
            'post_status' => 'publish',
            's' => $search_key,
            'posts_per_page' => -1,
            'tax_query' => [
                [
                    'taxonomy' => 'faq_type',
                    'field'    => 'id',
                    'terms'    => $terms_array,
                ]
            ],
        );
    endif;

    $faq_query = new WP_Query($faq_arg_term);
    if ($faq_query->have_posts()): ?>
        <div class="c-search-filter__list-wrap u-bg-primary-skin">
            <ul class="c-search-filter__list">
                <?php while ($faq_query->have_posts()) : $faq_query->the_post(); ?>
                    <li class="c-search-filter__list-item JS-faq-list-item">
                        <a class="JS-faq-list-link u-color-primary-dark-blue"
                           data-faq-post-id="<?php echo get_the_ID() ?>"
                           href="javascript:void(0);"><?php echo get_the_title() ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    <?php endif;

    wp_die();
}


// ajax to selected post
add_action('wp_ajax_nopriv_faq_to_selected_post', 'faq_ajax_to_selected_post');
add_action('wp_ajax_faq_to_selected_post', 'faq_ajax_to_selected_post');

function faq_ajax_to_selected_post()
{
    $post_id = $_POST['post_id'];

    $faq_arg_term = array();

    if (isset($post_id)) :
        $faq_arg_term = array(
            'post_type' => 'faq',
            'post_status' => 'publish',
            'p' => $post_id,
        );
    endif;

    $faq_query = new WP_Query($faq_arg_term);
    if ($faq_query->have_posts()): ?>
        <div class="c-accordion">
            <?php while ($faq_query->have_posts()) : $faq_query->the_post(); ?>
                <?php get_template_part('template-parts/components/accordion-post'); ?>
            <?php endwhile; ?>
        </div>
    <?php endif;

    wp_die();

}

// ajax remove search resulte
add_action('wp_ajax_nopriv_faq_remove_search_resulte', 'faq_remove_search_resulte');
add_action('wp_ajax_faq_to_faq_remove_search_resulte', 'faq_remove_search_resulte');


function faq_remove_search_resulte()
{

}