<?php
if (!defined('ABSPATH')) exit;

$check_in_title = get_field('check-in_title');
$check_in_description = get_field('check-in_description');
$check_in_link = get_field('check-in_link');
?>

<section class="s-checkin s-wave s-wave--primary-green">
    <div class="s-wave__inner-wrapper">
        <svg class="s-wave__icon icon-top">
            <use xlink:href="#wave-top-type-3"></use>
        </svg>
        <svg class="s-wave__icon icon-bottom">
            <use xlink:href="#wave-bottom-type-3"></use>
        </svg>
    </div>
    <div class="container">
        <div class="row justify-content-between">
            <div class="s-checkin__img-container">
                <img src="/wp-content/themes/openup/img/global/woman.svg" alt=""/>
            </div>
            <div class="col-md-6 col-lg-5">
                <div class="s-checkin__title-container">
                    <?php if ($check_in_title) : ?>
                        <h2 class="o-banner__title pr-lg-3 pr-xl-5">
                            <?php echo $check_in_title; ?>
                        </h2>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <?php if ($check_in_description) : ?>
                    <div class="o-banner__description c-wysiwyg">
                        <?php echo $check_in_description; ?>
                    </div>
                <?php endif; ?>
                <div class="s-checkin__btn">
                    <?php if ($check_in_link) : ?>
                        <a class="c-btn c-btn-primary--blue"
                           href="<?php echo $check_in_link['url']; ?>"
                           target="<?php echo $check_in_link['target']; ?>">
                            <?php echo $check_in_link['title']; ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
