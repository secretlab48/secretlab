<?php /* Template Name: Spaces single*/

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php get_template_part('template-parts/organisms/flexible-content-page'); ?>
            <section class="o-main-hero o-spaces-hero u-bg-primary-green u-color-primary-white">
                <div class="container">
                    <div class="row justify-content-lg-between o-spaces-hero__row">
                        <div class="col-12 col-lg-5 o-spaces-hero__container u-bg-secondary-green">
                            <div class="o-spaces-hero__history">
                                <span></span>
                                Spaces to OpenUp
                            </div>
                            <h1 class="o-main-hero__title">How to say no</h1>
                            <div class="o-spaces-hero__tag">
                                Group session
                            </div>
                            <ul class="o-spaces-hero__list">
                                <li>
                                    <img src="<?php echo get_template_directory_uri() ?>/img/global/calendar.png"
                                         alt="">
                                    <span>Monday 2 May 2022, 17:00 - 18:00 PM</span>
                                </li>
                                <li>
                                    <img src="<?php echo get_template_directory_uri() ?>/img/global/tag.png" alt="">
                                    <span>Work performance</span>
                                </li>
                                <li>
                                    <img src="<?php echo get_template_directory_uri() ?>/img/global/Union.png" alt="">
                                    <span>English</span>
                                </li>
                                <li>
                                    <img src="<?php echo get_template_directory_uri() ?>/img/global/triangle.png"
                                         alt="">
                                    <a href="#" target="_blank">youtu.be</a>
                                </li>
                            </ul>
                            <div class="o-main-hero__description">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                                </p>
                            </div>
                            <div class="o-spaces-hero__btn--wrap">
                                <div class="o-spaces-hero__btn">
                                    <a class="c-btn c-btn-primary--white" href="#">Add to calendar</a>
                                </div>
                                <div class="o-spaces-hero__btn">
                                    <button class="c-btn c-btn-primary--blue JS-open-modal">Subscribe to space</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8 col-lg-5 o-spaces-hero__media">
                            <div class="o-spaces-hero__img">
                                <img src="<?php echo get_template_directory_uri() ?>/img/team/team1.jpg" width="650"
                                     height="660" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer(); ?>