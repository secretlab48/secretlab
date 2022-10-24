<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package openup
 */

get_header();
?>


            <?php if ( have_posts() ) : ?>



                <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();


                    //get_template_part( 'template-parts/content', get_post_type() );

                endwhile;





            endif;
            ?>



<?php get_footer(); ?>
