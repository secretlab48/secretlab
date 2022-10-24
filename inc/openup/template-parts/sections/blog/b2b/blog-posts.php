<?php

$data = [];
$data[ 'post_type' ] = 'business_post';
$data[ 'filter-template-name' ] = 'b2b/blog-filters';
$data[ 'post-template-name' ] = 'business-post-card';
$data[ 'curent_term' ] = $data[ 'curent_taxonomy' ] = '';

$current_cat = !empty( $_GET['business_posts_types_tax'] ) ? $_GET['business_posts_types_tax'] : null;
$cur_tax_themas = !empty( $_GET['business_posts_themas_tax'] ) ? $_GET['business_posts_themas_tax'] : null;
$cur_tax_author = !empty( $_GET['business_posts_author_tax'] ) ? $_GET['business_posts_author_tax'] : null;
$curent_taxonomy = '';
$curent_term = '';
$page = ! empty( $_GET[ 'pg' ] ) ? $_GET[ 'pg' ] : 1;
$data[ 'page' ] = $page;

$post_arg = [
    'post_status' => 'publish',
    'post_type' => 'business_post',
    'paged' => $page,
    'posts_per_page' => 6,
    'orderby' => 'date',
    'order' => 'DESC'
];

if (!empty($current_cat) && $current_cat !== 'alle_types'):
    $data[ 'curent_taxonomy' ] = 'business_posts_types_tax';
    $data[ 'curent_term' ] = $current_cat;
elseif (!empty($cur_tax_themas) && $cur_tax_themas !== "alle_themas"):
    $data[ 'curent_taxonomy' ] = 'business_posts_themas_tax';
    $data[ 'curent_term' ] = $cur_tax_themas;
elseif (!empty($cur_tax_author) && $cur_tax_author !== 'alle_auteurs'):
    $data[ 'curent_taxonomy' ] = 'business_posts_author_tax';
    $data[ 'curent_term' ] = $cur_tax_author;
endif;

if (isset($current_cat) && $current_cat !== 'alle_types'
    || isset($cur_tax_themas) && $cur_tax_themas !== "alle_themas"
    || isset($cur_tax_author) && $cur_tax_author !== 'alle_auteurs'):
    $post_arg['tax_query'] = array(
        'relation' => 'OR',
        array(
            'taxonomy' => 'business_posts_themas_tax',
            'field' => 'slug',
            'terms' => $cur_tax_themas,
        ),
        array(
            'taxonomy' => 'business_posts_types_tax',
            'field' => 'slug',
            'terms' => $current_cat,
        ),
        array(
            'taxonomy' => 'business_posts_author_tax',
            'field' => 'slug',
            'terms' => $cur_tax_author,
        )
    );

endif;

$data[ 'posts_query' ] = new WP_Query( $post_arg );

B2B_Render_Methods::blog_posts( $data );

?>



