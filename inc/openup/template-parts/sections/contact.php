<?php
$title = get_field('contact_title');
$description = get_field('contact_description');
$number_telephone = get_field('number_telephone');
$telephone_icon = get_field('telephone_icon');
$chat_link = get_field('chat_link');
$chat_icon = get_field('contact_chat_icon');
$contacts = get_field( 'contact_lines' );
$imgs_dir_url = get_stylesheet_directory_uri() . '/img/global/flags/';
?>

<section class="s-contact s-wave s-wave--primary-green JS-contact-form">
    <div class="s-wave__inner-wrapper">
        <svg class="s-wave__icon icon-top">
            <use xlink:href="#wave-top-type-3"></use>
        </svg>
        <svg class="s-wave__icon icon-bottom">
            <use xlink:href="#wave-bottom-type-3"></use>
        </svg>
    </div>
    <div class="container">
        <div class="row justify-content-xl-between">
            <?php if ($title) : ?>
                <div class="col-md-6 col-lg-5">
                    <h2 class="s-contact__title o-banner__title">
                        <?php echo $title ?>
                    </h2>
                    <div class="s-contact__info">
                        <?php echo $description; ?>
                    </div>
                    <ul class="s-contact__list">
                        <?php if ( is_array( $contacts ) && count( $contacts ) > 0 ): ?>
                            <?php
                            foreach ( $contacts as $contact ) : ?>
                                <li class="s-contact__list-item d-flex align-items-center">
                                    <?php if ( $contact['flag'] ) :
                                        $src = $contact['flag']['url'];
                                        $alt = ! empty( $contact['flag']['alt'] ) ? $contact['flag']['alt'] : ( ! empty( $contact['phone'] ) ?  __( 'call please ', 'openup' ) . $contact['phone'] : __( 'use our chat', 'openup' ) );
                                    ?>
                                        <img class="s-contact__list-icon" src="<?php echo $src; ?>" alt="<?php echo $alt; ?>"/>
                                    <?php endif; ?>
                                    <div class="s-contact__list-link">
                                        <span>
                                            <?php
                                                if ( ! empty( $contact['phone'] ) ) {
                                                    echo $contact['message'];
                                                }
                                                else if ( empty( $contact['phone'] && ! empty( $chat_link['url'] ) ) ) {
                                                    echo '<a class="s-contact__list-chat-link" href="' . $chat_link['url'] . '">' . $contact['message'] . '</a>';
                                                }
                                            ?>
                                        </span>
                                        <?php if ( !empty( $contact['phone'] ) ) : ?>
                                            <a class="s-contact__list-phone-link" href="tel:<?php echo $contact['phone']; ?>">
                                                <?php echo $contact['phone']; ?>
                                            </a>
                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                </li>
                            <?php
                            endforeach;
                            ?>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="col-12 col-md-6 col-xl-5">
                <div class="c-form">
                    <?php if (ICL_LANGUAGE_CODE == 'nl') :
                        get_template_part('template-parts/components/contact-forms/form-nl');
                    elseif (ICL_LANGUAGE_CODE == 'de') :
                        get_template_part('template-parts/components/contact-forms/form-de');
                    elseif (ICL_LANGUAGE_CODE == 'en') :
                        get_template_part('template-parts/components/contact-forms/form-en');
                    elseif (ICL_LANGUAGE_CODE == 'fr') :
                        get_template_part('template-parts/components/contact-forms/form-fr');
                    elseif (ICL_LANGUAGE_CODE == 'es') :
                        get_template_part('template-parts/components/contact-forms/form-es');
                    endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
