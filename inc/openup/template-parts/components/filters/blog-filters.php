<?php

global $wpdb;

$data = [];
$data[ 'params' ] = [ 'cat', 'themas', 'author' ];
$data[ 'categories' ] = get_categories(array(
    'taxonomy' => 'category',
    'hide_empty' => true,
));

$data[ 'thema_areas' ] = get_categories(array(
    'taxonomy' => 'thema_areas-taxonomy',
    'hide_empty' => true,
));

$data[ 'authors' ] = get_categories(array(
    'taxonomy' => 'author-taxonomy',
    'hide_empty' => true,
));

$data[ 'urlBlog' ] = get_post_type_archive_link('post');

B2B_Render_Methods::blog_filter( $data );

?>