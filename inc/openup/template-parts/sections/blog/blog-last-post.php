<?php
global $post;

//ACF

$data = [
    'type' => 'b2c',
    'blog_post' => get_field('blog_page_post_section', 'option'),
];

B2B_Render_Methods::blog_last_post( $data );

?>


