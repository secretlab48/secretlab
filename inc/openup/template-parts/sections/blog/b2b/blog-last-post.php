<?php
global $post;

//ACF

$data = [
    'type' => 'b2b',
    'blog_post' => get_field('blog_page_last_post_b2b', 'option'),
];

B2B_Render_Methods::blog_last_post( $data );

?>

