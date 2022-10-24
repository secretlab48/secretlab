<?php

global $wpdb;

$data = [];
$data[ 'params' ] = [ 'business_posts_types_tax', 'business_posts_themas_tax', 'business_posts_author_tax' ];
$data[ 'categories' ] = get_categories(array(
    'taxonomy' => 'business_posts_types_tax',
    'hide_empty' => true,
));

$data[ 'thema_areas' ] = get_categories(array(
    'taxonomy' => 'business_posts_themas_tax',
    'hide_empty' => true,
));

$data[ 'authors' ] = get_categories(array(
    'taxonomy' => 'business_posts_author_tax',
    'hide_empty' => true,
));

$data[ 'urlBlog' ] = get_post_type_archive_link('business_post');

B2B_Render_Methods::blog_filter( $data );

?>
