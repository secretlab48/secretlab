<?php

$space_type = get_field( 'single_cpace_availability_type', $post->ID );
$data = openup_get_single_live_space_data( $post );
preg_match( '/watch\?v=(.+)$/', $data[ 'video_url' ], $yt_id  );
$yt_id = $yt_id[1];
$ls_options = openup_get_option( 'livestorm' );
if ( $data[ 'space_type_theme_color' ] == 'blue' ) {
    $bg_color = 'blue';
    $text_color = 'white';
    $btn_color = 'dark-blue';
}
else if( $data[ 'space_type_theme_color' ] == 'green' ) {
    $bg_color = 'green';
    $text_color = 'white';
    $btn_color = 'blue';
}
else if( $data[ 'space_type_theme_color' ] == 'skin' ) {
    $bg_color = 'skin';
    $text_color = 'dark-blue';
    $btn_color = 'dark-blue';
}
?>

<div class="backdrop-filter" id="backdropFilter" >
    <div class="o-popup-form__message u-bg-primary-<?php echo $bg_color; ?> u-color-primary-<?php echo $text_color; ?>">
        <span class="close-message close-subscribe " >&times</span>
        <div class="o-popup-form__message__image">
            <img src="<?php echo get_template_directory_uri() ?>/img/global/thanks-people.png" alt="thanks">
        </div>
        <div class="o-popup-form__message__title"></div>
        <div class="o-popup-form__message__content"></div>
        <button  class="c-btn c-btn-primary--<?php echo $btn_color; ?> close-message" type="button">
            <?php echo __( 'Doorgaan', 'openup' ); ?>
        </button>
    </div>
    <div class="popup subscribe-livespaces">
        <span class="close-popup close-subscribe">
            &times
        </span>
           <form action="#" class="o-popup-form row JS-form customized-form" id="_form_02_" autocomplete="off">
            <div class="col-12 col-lg-6 col-md-5 u-bg-primary-<?php echo $bg_color; ?> u-color-primary-<?php echo $text_color; ?>">
                <div class="o-popup-form__content">
                    <h2 class="c-intro__title">
                        <?php echo __( 'Join our', 'openup' ); ?> <br>
                        <span class="u-color-primary-dark-blue"><?php echo __( 'Live Space', 'openup' ); ?></span>
                    </h2>
                    <div class="o-popup-form__tag">
                        <?php echo $data[ 'title' ]; ?>
                        <span class="o-spaces-hero__tag">
                            <?php echo $data[ 'space_type_term' ]->name; ?>
                        </span>
                    </div>
                    <ul class="o-spaces-hero__list">
                        <li class="">
                            <img src="<?php echo get_template_directory_uri() ?>/img/global/calendar.png"
                                 alt="">
                            <span data-input="date">
                                <?php
                                $current_locale = setlocale(LC_ALL, 0);
                                setlocale( LC_ALL, openup_get_locale_name() );
                                echo strftime( '%A %e %B %Y', strtotime( $data[ 'start_date' ] ) );
                                setlocale( LC_ALL, $current_locale);
                                ?>, <?php echo $data[ 'start_time' ]; ?> - <?php echo $data[ 'finish_time' ]; ?></span>
                        </li>
                        <li>
                            <img src="<?php echo get_template_directory_uri() ?>/img/global/tag.png" alt="">
                            <span data-input="theme"><?php echo $data[ 'space_theme_term' ]->name; ?></span>
                        </li>
                        <li>
                            <img src="<?php echo get_template_directory_uri() ?>/img/global/Union.png" alt="">
                            <span data-input="lang"><?php echo ucfirst( openup_get_lang_name( $data[ 'lang' ] ) ); ?></span>
                        </li>
<!--                        <li>-->
<!--                            <img src="--><?php //echo get_template_directory_uri() ?><!--/img/global/triangle.png"-->
<!--                                 alt="">-->
<!--                            <a href="--><?php //echo $data[ 'room_link' ]; ?><!--" target="_blank" data-input="link">--><?php //echo __( 'Bekijk Space', 'openup' ); ?><!--</a>-->
<!--                        </li>-->
                    </ul>
                </div>
            </div>
           <div class="col-12 col-lg-6 col-md-7 d-flex">
               <div class="o-popup-form__form">
                   <input class="ls-event_id ls-value" type="hidden" name="event_id" value="<?php echo $data[ 'event' ]; ?>" />
                   <input class="ls-session_id ls-value" type="hidden" name="session_id" value="<?php echo $data[ 'session' ]; ?>" />
                   <div class="_form_element _form_element_input _x82668303 _full_width ">
                       <div class="_field-wrapper">
                           <input class="ls-value" type="text" name="first_name" placeholder=""/>
                       </div>
                       <label class="_form-label">
                           <?php echo __( 'Naam', 'openup' ); ?>
                       </label>
                   </div>
                   <div class="_form_element _form_element_input _x64633587 _full_width _form_element-email">
                       <div class="_field-wrapper">
                           <input class="ls-value email-validate" type="text" name="email" placeholder=""/>
                       </div>
                       <label class="_form-label">
                           <?php echo __( 'E-mailadres', 'openup' ); ?>
                       </label>
                       <p class="error-validate"><?php echo __( 'Gebruik een geldig e-mailadres', 'openup' ); ?></p>
                   </div>
                   <div class="o-popup-form__desc">
                       <?php echo __( 'Wordt OpenUp je aangeboden door een organisatie of community?', 'openup' ); ?>
                   </div>
                   <div class="o-popup-form__field u-color-primary-dark-blue">
                       <div class="o-popup-form__radio">
                           <input class="custom_radio o-popup-form__radio-input" type="radio" id="radioBtn1" data-name="employer" name="radio-btn" required>
                           <label for="radioBtn1"><?php echo __( 'Ja', 'openup' ); ?></label>
                           <input type="text" name="hiddenVal" class="required-hidden">
                           <div class="savedSearches o-popup-form__dropdown" data-dropdown_id="radioBtn1">
                               <div class="o-popup-form__select" data-placeholder="<?php echo __( 'Kies organisatie of community', 'openup' ); ?>">
                                   <?php echo __( 'Kies organisatie of community', 'openup' ); ?>
                               </div>
                               <div class="o-popup-form__select-open">
                                   <div class="searchInput">
                                       <input type="text" class="o-popup-form__input findInput" placeholder="<?php echo __( 'Kies organisatie of community', 'openup' ); ?>">
                                       <span class="searchInputClear">
                                           <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                               <path d="M11.8327 1.3918L10.6577 0.216797L5.99935 4.87513L1.34102 0.216797L0.166016 1.3918L4.82435 6.05013L0.166016 10.7085L1.34102 11.8835L5.99935 7.22513L10.6577 11.8835L11.8327 10.7085L7.17435 6.05013L11.8327 1.3918Z" fill="#9E9C98"/>
                                           </svg>
                                       </span>
                                   </div>
                                   <div class="o-popup-form__list-wrapper">
                                       <ul class="o-popup-form__list">
                                           <?php
                                           if ( is_array( $ls_options ) ) {
                                               foreach( $ls_options as $option ) {
                                                   if ( ! empty( $option [ 2 ] ) ) {
                                                       echo '<li class="o-popup-form__list-item ls-value" data-key="employer" data-value="' . $option [2] . '">' . $option[0] . '</li>';
                                                   }
                                               }
                                           }
                                           ?>
                                       </ul>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="o-popup-form__radio">
                           <input class="custom_radio o-popup-form__radio-input" type="radio" id="radioBtn2" data-name="openup_friends_and_family" name="radio-btn">
                           <label for="radioBtn2"><?php echo __( 'Ja, via OpenUp Friends & Family', 'openup' ); ?></label>
                           <input type="text" name="hiddenVal1" class="required-hidden">
                           <div class="savedSearches o-popup-form__dropdown"  data-dropdown_id="radioBtn2">
                               <div class="o-popup-form__select" data-placeholder="<?php echo __( 'Kies organisatie of community', 'openup' ); ?>">
                                   <?php echo __( 'Kies organisatie of community', 'openup' ); ?>
                               </div>
                               <div class="o-popup-form__select-open">
                                   <div class="searchInput">
                                       <input type="text" class="o-popup-form__input findInput" placeholder="<?php echo __( 'Kies organisatie of community', 'openup' ); ?>">
                                       <span class="searchInputClear">
                                           <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                               <path d="M11.8327 1.3918L10.6577 0.216797L5.99935 4.87513L1.34102 0.216797L0.166016 1.3918L4.82435 6.05013L0.166016 10.7085L1.34102 11.8835L5.99935 7.22513L10.6577 11.8835L11.8327 10.7085L7.17435 6.05013L11.8327 1.3918Z" fill="#9E9C98"/>
                                           </svg>
                                       </span>
                                   </div>
                                   <div class="o-popup-form__list-wrapper">
                                       <ul class="o-popup-form__list">
                                           <?php
                                           if ( is_array( $ls_options ) ) {
                                               foreach( $ls_options as $option ) {
                                                   if ( ! empty( $option [ 2 ] ) ) {
                                                       echo '<li class="o-popup-form__list-item ls-value" data-key="openup_friends_and_family" data-value="' . $option [2] . '">' . $option[0] . '</li>';
                                                   }
                                               }
                                           }
                                           ?>
                                       </ul>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="o-popup-form__radio">
                           <input class="custom_radio ls-value o-popup-form__radio-input last-radio--item" type="radio" id="radioBtn3" data-name="not_offered_by_organization" name="radio-btn">
                           <label for="radioBtn3"><?php echo __( 'Nee', 'openup' ); ?></label>
                       </div>
                   </div>
                   <div class="_button-wrapper _full_width">
                       <button  class="_submit c-btn-primary--<?php echo $btn_color; ?>" type="submit">
                           <?php echo __( 'Aanmelden voor Space', 'openup' ); ?>
                       </button>
                   </div>
               </div>
           </div>

        </form>
    </div>
</div>


