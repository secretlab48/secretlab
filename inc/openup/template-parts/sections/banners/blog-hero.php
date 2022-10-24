<?php

//ACF

$data[ 'title' ] = get_field('blog_hero_title', 'options');
$data [ 'description' ] = get_field('blog_hero_description', 'options');

B2B_Render_Methods::blog_hero( $data );

?>