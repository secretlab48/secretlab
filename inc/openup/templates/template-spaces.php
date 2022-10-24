<?php /* Template Name: Spaces */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php get_template_part('template-parts/organisms/flexible-content-page'); ?>
            <section class="o-main-hero o-main-hero--ellipsis u-bg-primary-dark-blue u-color-primary-white">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-6">
                            <h1 class="o-main-hero__title">Spaces to OpenUp</h1>
                            <div class="o-main-hero__description">
                                <?php echo __( 'Onze psychologen organiseren online live spaces om je te helpen met je mentale gezondheid. Live space gemist? Je kunt altijd aan de slag met onze on-demand masterclasses.', 'openup' ); ?>
                            </div>
                            <div class="o-main-hero__btn--wrap">
                                <div class="o-main-hero__btn">
                                    <a class="c-btn c-btn-primary--white" href="#">Live spaces</a>
                                </div>
                                <div class="o-main-hero__btn">
                                    <a class="c-btn c-btn-primary--blue" href="#"><?php echo __( 'On demand', 'openup' ); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="o-main-hero__spaces-card">
                                <div class="o-main-hero__spaces-card-wave"></div>
                                <div class="o-main-hero__spaces-card-img">
                                    <img src="<?php echo get_template_directory_uri() ?>/img/global/spaces-icon1.png" alt="">
                                </div>
                                <h6>Group session</h6>
                                <div class="o-main-hero__spaces-card-description">In a group of max. 20 people we discuss on a theme on mental health</div>
                            </div>
                            <div class="o-main-hero__spaces-card">
                                <div class="o-main-hero__spaces-card-wave"></div>
                                <div class="o-main-hero__spaces-card-img">
                                    <img src="<?php echo get_template_directory_uri() ?>/img/global/spaces-icon2.png" alt="">
                                </div>
                                <h6>Group session</h6>
                                <div class="o-main-hero__spaces-card-description">In a group of max. 20 people we discuss on a theme on mental health</div>
                            </div>
                            <div class="o-main-hero__spaces-card">
                                <div class="o-main-hero__spaces-card-wave"></div>
                                <div class="o-main-hero__spaces-card-img">
                                    <img src="<?php echo get_template_directory_uri() ?>/img/global/spaces-icon3.png" alt="">
                                </div>
                                <h6>Group session</h6>
                                <div class="o-main-hero__spaces-card-description">In a group of max. 20 people we discuss on a theme on mental health</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer(); ?>