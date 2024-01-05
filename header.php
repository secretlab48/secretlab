<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?></title>

        <link href="<?php echo get_template_directory_uri(); ?>/assets//img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-PRHRRNM');</script>
        <!-- End Google Tag Manager -->

        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <script>
            window.onload = function() {
                let el = document.querySelector('.fakeLoader');
                el.style.display = 'none';
            }
        </script>

		<?php

            $lang = apply_filters( 'wpml_current_language', NULL );
            wp_head();

        ?>

	</head>
	<body <?php body_class(); ?>>

        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PRHRRNM"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        <div class="fakeLoader" style="background-color: #f5f6fa; /*! display: none; */"><div class="fl fl-spinner spinner6"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div></div>

		<div class="site-wrapper">

                <div class="logo-box">
                    <div class="menu-manage"><span></span><span></span><span></span></div>
                </div>

                <div class="content-wrapper">

                    <header class="header-element" role="banner">

                        <div class="header-box">

                            <div class="menu-box">

                                <?php echo do_shortcode('[wpml_language_selector_widget]'); ?>

                                <nav class="top-menu-box">
                                    <div class="top-menu-manage"></div>
                                    <?php
                                    wp_nav_menu( array( 'menu' => 'top-menu-' . $lang, 'container' => null, 'menu_class' => 'top-menu' ) );
                                    ?>
                                </nav>
                            </div>

                        </div>

                        <nav class="main-menu-container">
                            <div class="main-menu-row row">
                                <div class="main-menu-col left-col col-2">
                                    <?php wp_nav_menu( array( 'menu' => 'main-menu-' . $lang, 'container' => null, 'menu_class' => 'main-menu' ) ); ?>
                                </div>
                                <div class="main-menu-col right-col col-2">
                                    <div class="contact-block-box">
                                        <div class="contact-block">
                                            <div class="cb-title"><?php _e( 'phone', 'udft' ); ?></div>
                                            <div class="cb-link"><a href="tel:+380687255071">+38(068)725 50 71</a></div>
                                        </div>
                                        <div class="contact-block">
                                            <div class="cb-title"><?php _e( 'email', 'udft' ); ?></div>
                                            <div class="cb-link"><a href="mailto:sales@secretlab.com.ua">sales@secretlab.com.ua</a></div>
                                        </div>
                                        <div class="contact-block">
                                            <?php echo udft_site_socials(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="main-menu-bg"></div>
                        </nav>

                    </header>


