<?php while (have_rows('flexible_content_page')) : the_row();

    if (get_row_layout() == 'card_section')
        get_template_part('template-parts/sections/flexible-content/card-section');

    if (get_row_layout() == 'card_with_link_section')
        get_template_part('template-parts/sections/flexible-content/card-with-link');

    if (get_row_layout() == 'single_img_slider_section')
        get_template_part('template-parts/sections/flexible-content/single-img-slider');

    if (get_row_layout() == 'logo_slider_section')
        get_template_part('template-parts/sections/flexible-content/logo-slider');

    if (get_row_layout() == 'logo_company_slider_hero_section')
        get_template_part('template-parts/sections/flexible-content/logo-company-slider-hero');

    if (get_row_layout() == 'teams_section')
        get_template_part('template-parts/sections/flexible-content/team-section');

    if (get_row_layout() == 'team_slider_section')
        get_template_part('template-parts/sections/flexible-content/team-slider');

    if (get_row_layout() == 'team_slider_section_custom')
        get_template_part('template-parts/sections/flexible-content/team-slider-custom');

    if (get_row_layout() == 'testimonial_slider_section')
        get_template_part('template-parts/sections/flexible-content/testimonials-slider');

    if (get_row_layout() == 'testimonial_with_people_slider_section')
        get_template_part('template-parts/sections/flexible-content/testimonials-slider-with-people');

    if (get_row_layout() == 'testimonial_quality_slider_section')
        get_template_part('template-parts/sections/flexible-content/testimonials-quality-slider');

    if (get_row_layout() == 'testimonials_with_image_slider_section')
        get_template_part('template-parts/sections/flexible-content/testimonials-with-image-slider');

    if (get_row_layout() == 'theme_category_section')
        get_template_part('template-parts/sections/flexible-content/thema-section');

    if (get_row_layout() == 'side_title_text_section')
        get_template_part('template-parts/sections/flexible-content/side-title-text-section');

    if (get_row_layout() == 'media_section')
        get_template_part('template-parts/sections/flexible-content/media-section');

    if (get_row_layout() == 'section_text_with_image')
        get_template_part('template-parts/sections/flexible-content/text-with-image');

    if (get_row_layout() == 'section_text_with_image_and_link')
        get_template_part('template-parts/sections/flexible-content/text-with-image-and-link');

    if (get_row_layout() == 'related_posts_section')
        get_template_part('template-parts/sections/flexible-content/related-posts');

    if (get_row_layout() == 'subscription_section')
        get_template_part('template-parts/sections/flexible-content/subscription-section');

    if (get_row_layout() == 'faq_section')
        get_template_part('template-parts/sections/flexible-content/faq-section');

    if (get_row_layout() == 'contact_form')
        get_template_part('template-parts/sections/flexible-content/contact-form');

    if (get_row_layout() == 'contact_form_recruitment')
        get_template_part('template-parts/sections/flexible-content/contact-form-recruitment');

    if (get_row_layout() == 'horizontal_cards_section')
        get_template_part('template-parts/sections/flexible-content/horizontal-cards');

    if (get_row_layout() == 'card_extended_section')
        get_template_part('template-parts/sections/flexible-content/horizontal-cards-extended');

    if (get_row_layout() == 'side_title_text_with_cards')
        get_template_part('template-parts/sections/flexible-content/side-title-text-with-card');

    if (get_row_layout() == 'cta_section')
        get_template_part('template-parts/sections/flexible-content/cta-section');

    if (get_row_layout() == 'simple_form_section')
        get_template_part('template-parts/sections/flexible-content/simple-form');

    if (get_row_layout() == 'video_section')
        get_template_part('template-parts/sections/flexible-content/video-section');

    if (get_row_layout() == 'section_with_list')
        get_template_part('template-parts/sections/flexible-content/section-with-list');

    if (get_row_layout() == 'section_team_info_card')
        get_template_part('template-parts/sections/flexible-content/section-team-info-card');

    if (get_row_layout() == 'cta_download_section')
        get_template_part('template-parts/sections/flexible-content/cta-download-section');

    if (get_row_layout() == 'logo_round_row_section')
        get_template_part('template-parts/sections/flexible-content/logo-round-row-section');

    if (get_row_layout() == 'logo_row_section')
        get_template_part('template-parts/sections/flexible-content/logo-row-section-main');

    if (get_row_layout() == 'logo_row_section_mkb')
        get_template_part('template-parts/sections/flexible-content/logo-row-section-mkb');

    if (get_row_layout() == 'e-book_posts')
        get_template_part('template-parts/sections/flexible-content/ebook-posts-section');

    if (get_row_layout() == 'section_calculator')
        get_template_part('template-parts/sections/flexible-content/calculator');

    if (get_row_layout() == 'section_job_board')
        get_template_part('template-parts/sections/flexible-content/greenhouse-job-board');

    if (get_row_layout() == 'section_form_renderer')
        get_template_part('template-parts/sections/flexible-content/section-form-renderer');

    if (get_row_layout() == 'text_with_title_section')
        get_template_part('template-parts/sections/flexible-content/section-text-with-title');

    if (get_row_layout() == 'text_with_title_and_image_section')
        get_template_part('template-parts/sections/flexible-content/section-text-with-title-and-image');

    if (get_row_layout() == 'section_title_and_people')
        get_template_part('template-parts/sections/flexible-content/banner-title-and-people');

    if (get_row_layout() == 'section_our_journey')
        get_template_part('template-parts/sections/flexible-content/section-our-journey');

    if (get_row_layout() == 'section_custom_header');

    if (get_row_layout() == 'section_journey_current_slider')
        get_template_part('template-parts/sections/flexible-content/section-journey-current');

    if (get_row_layout() == 'raw_html')
        get_template_part('template-parts/sections/flexible-content/raw-html');

    if (get_row_layout() == 'calendly_section')
        get_template_part('template-parts/sections/flexible-content/calendly-section');

    if (get_row_layout() == 'live_spaces_section')
        get_template_part('template-parts/sections/flexible-content/spaces/live/live-spaces-section');

    if (get_row_layout() == 'on_demand_spaces_section')
        get_template_part('template-parts/sections/flexible-content/spaces/on-demand/on-demand-spaces-section');

    if (get_row_layout() == 'spaces_hero_banner')
        get_template_part('template-parts/sections/flexible-content/spaces/spaces-hero-banner');

    if (get_row_layout() == 'steps_section')
        get_template_part('template-parts/sections/flexible-content/steps-section');

endwhile;