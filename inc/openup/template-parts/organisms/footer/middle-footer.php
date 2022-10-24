<?php

if (!defined('ABSPATH')) exit;

global $post;

$page_type = is_object( $post ) ? get_field( 'page_type', $post->ID ) : 'b2c';
$page_type = ( ! empty( $page_type ) && $page_type == 'b2b' ) ? 'b2b' : 'b2c';
global $post, $openup_data;

$page_type = $openup_data[ 'page_type' ];

?>
<div class="o-footer__middle">
    <div class="container">
        <div class="row">
            <div class="middle-footer-1">
                <?php
                $footer_menu = get_field( 'footer_menu' );
                if ( ! empty( $footer_menu ) && $footer_menu != 0 ) {
                    $menu_html = wp_nav_menu( [ 'menu' => $footer_menu, 'container_class' => 'menu-second-menu-container', 'echo' => false ] );
                    $menu = '<section id="nav_menu-3" class="widget widget_nav_menu"><h2 class="widget-title">' . __( 'Direct naar', 'openup' ) . '</h2>' . $menu_html . '</section>';
                    echo $menu;
                }
                else {
                    $widget_name = ( $page_type == 'b2c' ) ? 'footer-1' : 'b2b-footer-1';
                    if (is_active_sidebar( $widget_name ) ) {
                        dynamic_sidebar( $widget_name );
                    }
                }
                ?>
                <div class="o-footer__cookie-btn" onclick="Cookiebot.show()">
                    <?php echo __( 'Cookievoorkeuren', 'openup' ); ?>
                </div>
            </div>
            <div class="col middle-footer-2">
                <div>
                    <?php
                    if ( $page_type == 'b2c' ) {
                        if (is_active_sidebar('footer-2')) {
                            dynamic_sidebar('footer-2');
                        }
                    }
                    else if ( $page_type == 'b2b' ) {
                        if ( is_active_sidebar('b2b-footer-2') ) {
                            dynamic_sidebar('b2b-footer-2');
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col middle-footer-3">
                <div>
                    <?php
                    if ( $page_type == 'b2c' ) {
                        if (ICL_LANGUAGE_CODE == 'nl') {
                            get_template_part('template-parts/components/newsletter-code');
                        } else if (ICL_LANGUAGE_CODE == 'en') {
                            get_template_part('template-parts/components/newsletter-code-en');
                        } else if (ICL_LANGUAGE_CODE == 'de') {
                            get_template_part('template-parts/components/newsletter-code-de');
                        } else if (ICL_LANGUAGE_CODE == 'fr') {
                            get_template_part('template-parts/components/newsletter-code-fr');
                        } else if (ICL_LANGUAGE_CODE == 'es') {
                            get_template_part('template-parts/components/newsletter-code-es');
                        }
                    } else if ( $page_type == 'b2b' ) {
                        if (ICL_LANGUAGE_CODE == 'nl') {
                            get_template_part('template-parts/components/footer-forms-b2b/newsletter-code-b2b');
                        } else if (ICL_LANGUAGE_CODE == 'en') {
                            get_template_part('template-parts/components/footer-forms-b2b/newsletter-code-b2b-en');
                        } else if (ICL_LANGUAGE_CODE == 'de') {
                            get_template_part('template-parts/components/footer-forms-b2b/newsletter-code-b2b-de');
                        } else if (ICL_LANGUAGE_CODE == 'fr') {
                            get_template_part('template-parts/components/footer-forms-b2b/newsletter-code-b2b-fr');
                        } else if (ICL_LANGUAGE_CODE == 'es') {
                            get_template_part('template-parts/components/footer-forms-b2b/newsletter-code-b2b-es');
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>