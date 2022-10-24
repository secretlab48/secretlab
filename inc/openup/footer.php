<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package openup
 */

if (!defined('ABSPATH')) exit;

global $post;
$hide_footer = ( isset( $post->post_type ) && $post->post_type == 'ebook' ) ? get_field( 'hide_footer', $post->ID ) : false;
?>

</div><!-- #content -->
<?php if (is_404()
    || is_page_template('templates/template-chat-bedankt.php')
    || is_page_template('templates/template-video-bedankt.php')
    || is_page_template('templates/template-consult-booking.php')
    || is_page_template('templates/template-boek-consult-post.php')
    || is_page_template('templates/template-consult.php')
    || $hide_footer ): ?>

<?php else: ?>
    <footer class="o-footer">
        <?php get_template_part('template-parts/organisms/footer/top-footer'); ?>
        <?php get_template_part('template-parts/organisms/footer/middle-footer'); ?>
        <?php get_template_part('template-parts/organisms/footer/bottom-footer'); ?>
        <?php get_template_part('template-parts/organisms/footer/popup-footer'); ?>
        <?= (is_singular('post') || is_singular( 'space' ) ) ? get_template_part('template-parts/components/share-buttons-post') : '' ?>
    </footer>
    <?php echo ( is_singular( 'space' ) ) ? get_template_part('template-parts/organisms/footer/spaces-subscribe-popup') : '' ?>
<?php endif; ?>
<?php get_template_part('template-parts/components/svg/svg-icon'); ?>

</div><!-- #page -->

<?php if (is_single() || is_singular( 'space' )): ?>
    <script async src="https://static.addtoany.com/menu/page.js"></script>
<?php endif; ?>
<?php wp_footer(); ?>

</body>

</html>
