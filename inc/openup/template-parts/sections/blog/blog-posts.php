<?php

$data = [];
$data[ 'post_type' ] = 'post';
$data[ 'filter-template-name' ] = 'blog-filters';
$data[ 'post-template-name' ] = 'post-card';
$data[ 'curent_term' ] = $data[ 'curent_taxonomy' ] = '';

$current_cat = !empty( $_GET['cat'] ) ? $_GET['cat'] : null;
$cur_tax_themas = !empty( $_GET['themas'] ) ? $_GET['themas'] : null;
$cur_tax_author = !empty( $_GET['author'] ) ? $_GET['author'] : null;
$curent_taxonomy = '';
$curent_term = '';
$page = ! empty( $_GET[ 'pg' ] ) ? $_GET[ 'pg' ] : 1;

$post_arg = [
    'post_status' => 'publish',
    'post_type' => 'post',
    'paged' => $page,
    'posts_per_page' => 6,
    'orderby' => 'date',
    'order' => 'DESC'
];

if (!empty($current_cat) && $current_cat !== 'alle_types'):
    $data[ 'curent_taxonomy' ] = 'category';
    $data[ 'curent_term' ] = $current_cat;
elseif (!empty($cur_tax_themas) && $cur_tax_themas !== "alle_themas"):
    $data[ 'curent_taxonomy' ] = 'thema_areas-taxonomy';
    $data[ 'curent_term' ] = $cur_tax_themas;
elseif (!empty($cur_tax_author) && $cur_tax_author !== 'alle_auteurs'):
    $data[ 'curent_taxonomy' ] = 'author-taxonomy';
    $data[ 'curent_term' ] = $cur_tax_author;
endif;

if (isset($current_cat) && $current_cat !== 'alle_types'
    || isset($cur_tax_themas) && $cur_tax_themas !== "alle_themas"
    || isset($cur_tax_author) && $cur_tax_author !== 'alle_auteurs'):
    $post_arg['tax_query'] = array(
        'relation' => 'OR',
        array(
            'taxonomy' => 'thema_areas-taxonomy',
            'field' => 'slug',
            'terms' => $cur_tax_themas,
        ),
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $current_cat,
        ),
        array(
            'taxonomy' => 'author-taxonomy',
            'field' => 'slug',
            'terms' => $cur_tax_author,
        )
    );

endif;

$data[ 'posts_query' ] = new WP_Query($post_arg);

B2B_Render_Methods::blog_posts( $data );

?>

