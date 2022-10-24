<?php $team_testimonial = get_field('team_testimonial'); ?>
<?php if ($team_testimonial) : ?>
    <section class="s-testimonials s-wave s-wave--primary-skin">
        <div class="s-wave__inner-wrapper">
            <svg class="s-wave__icon icon-top">
                <use xlink:href="#wave-top-type-3"></use>
            </svg>
            <svg class="s-wave__icon icon-bottom">
                <use xlink:href="#wave-bottom-type-3"></use>
            </svg>
        </div>

        <div class="container text-center">
            <div class="s-testimonials__text-container">
                <div class="s-testimonials__text"><?php echo $team_testimonial; ?></div>
            </div>
        </div>
    </section>
<?php endif; ?>