<?php

$data = [];
$data[ 'title' ] = get_field('blog_page_subscribe_title_b2b', 'options');
$data[ 'description' ] = get_field('blog_page_subscribe_description_b2b', 'options');
$data[ 'form-paths' ] = [
        'nl' => 'footer-forms-b2b/newsletter-code-b2b',
        'en' => 'footer-forms-b2b/newsletter-code-b2b-en',
        'de' => 'footer-forms-b2b/newsletter-code-b2b-de',
        'fr' => 'footer-forms-b2b/newsletter-code-b2b-fr',
        'es' => 'footer-forms-b2b/newsletter-code-b2b-es',
];

B2B_Render_Methods::blog_subscribe( $data );

?>
