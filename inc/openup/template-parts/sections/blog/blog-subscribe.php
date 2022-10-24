<?php

$data = [];
$data[ 'title' ] = get_field('blog_page_subscribe_title', 'options');
$data[ 'description' ] = get_field('blog_page_subscribe_description', 'options');
$data[ 'form-paths' ] = [
    'nl' => 'newsletter-code',
    'en' => 'newsletter-code-en',
    'de' => 'newsletter-code-de',
    'fr' => 'newsletter-code-fr',
    'es' => 'newsletter-code-es',
];

B2B_Render_Methods::blog_subscribe( $data );

?>