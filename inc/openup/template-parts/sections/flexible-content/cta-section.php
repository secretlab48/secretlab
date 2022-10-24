<?php
$cta_text = get_sub_field('cta_section_title');
$cta_link = get_sub_field('cta_section_link');
$cta_section_color = get_sub_field('cta_section_color');
$title_color = get_sub_field('cta_section_title_color');
$wave_color = get_sub_field('cta_section_wave_color');

?>

<section class="s-team-cta s-wave s-wave--primary-green" style="background-color:<?php echo $cta_section_color?>">
    <div class="s-wave__inner-wrapper"> 
        <svg class="s-wave__icon icon-bottom" style="color:<?php echo $wave_color; ?>">
            <use xlink:href="#wave-bottom-type-2"></use>
        </svg>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="s-team-cta__content d-flex flex-column flex-lg-row  justify-content-lg-between align-items-start align-items-lg-center">
                    <?php if ($cta_text):?>
                        <h5 class="s-team-cta__title u-color-primary-white" style="color:<?php echo $title_color?>">
                            <?php echo $cta_text ?>
                        </h5>
                    <?php endif; ?>
                    <?php if ($cta_link):?>
                        <a class="c-btn c-btn-primary--blue c-btn-primary--arrow" href="<?php echo $cta_link['url']?>"
                           target="<?php echo $cta_link['target']; ?>"><?php echo $cta_link['title']?>
                            <svg class="icon">
                                <use xlink:href="#icon-arrow-team"></use>
                            </svg>
                        </a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</section>
