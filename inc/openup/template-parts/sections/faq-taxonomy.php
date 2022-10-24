<?php
/**
 *  Partial: Sections
 *
 *  Partial for loading Sections via file name using a class extending
 *  ACF's flexible content field.
 *
 * @see       inc/acf/acf-sections.php - Sections class
 * @see       inc/fields/* - Defined fields and Sections
 */

if (!defined('ABSPATH')) exit;

$terms = get_field('taxonomy');
if($terms):

$faq_arg_term = array(
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'faq_type',
            'field' => 'term_id',
            'terms' => $terms,
        )
    )
);

$faq_query = new WP_Query($faq_arg_term); ?>

<section class="s-faq">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="JS-faq-search-container">
                    <?php if ($faq_query->have_posts()): ?>
                        <div class="c-accordion">
                            <?php while ($faq_query->have_posts()) : $faq_query->the_post(); ?>
                                <?php get_template_part('template-parts/components/accordion-post'); ?>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>