<?php

//ACF

$data[ 'title' ] = get_field('blog_hero_title_b2b', 'options');
$data [ 'description' ] = get_field('blog_hero_description_b2b', 'options');

B2B_Render_Methods::blog_hero( $data );

?>