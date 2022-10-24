<?php

/**
 * A Contact Info widget.
 */
class Contact_Info_Widget extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    function __construct()
    {
        parent::__construct(
            'contact_info_widget', // Base ID
            __('Contact Info Widget', 'text_domain'), // Name
            array(
                'description' => __('A contact info widget', 'text_domain'),
                'classname' => 'contact-info-widget'
            ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     * @see WP_Widget::widget()
     *
     */
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        echo get_field('title', 'widget_' . $args['widget_id']); ?>

        <!-- BEGIN ACF CODE-->
        <?php
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        $number_icon = get_field('number_icon', 'widget_' . $args['widget_id']);
        $contact_number = get_field('contact_number', 'widget_' . $args['widget_id']);
        $chat_icon = get_field('chat_icon', 'widget_' . $args['widget_id']);
        $contact_link = get_field('contact_link', 'widget_' . $args['widget_id']);
        ?>

        <ul class="o-footer__contact-list">
            <?php if ($contact_number) { ?>
                <?php
                $tel_text = $contact_number;
                $pattern = '/\+?\d{2,3}\s\d+/';
                if ( $lang == 'de' && ICL_LANGUAGE_CODE == 'en' ) {
                    $tel = preg_replace($pattern, '030 30808172', $tel_text);
                }
                else {
                    $tel = $tel_text;
                }
                if ( ICL_LANGUAGE_CODE != 'fr' ) {
                    preg_match('/[0-9]+\s?[0-9]+/', $tel, $tel_number);
                    $tel_number = (!empty($tel_number[0])) ? $tel_number[0] : '030 30808172';
                }
                else {
                    preg_match_all('/[0-9]+/', $tel, $tel_number);
                    $tel_number = implode( ' ', $tel_number[0] );
                }
                ?>
                <li class="o-footer__contact-item footer-info-container d-flex align-items-center">
                    <?php if ($number_icon) { ?>
                        <?php
                            $icon_id = isset( $number_icon['ID'] ) ? $number_icon['ID'] : $number_icon;
                            echo wp_get_attachment_image($icon_id,'full', "", array( "class" => "o-footer__contact-icon" ))
                        ?>
                    <?php } ?>
                    <a class="o-footer__contact-link phone-number" href="tel:<?php echo $tel_number; ?>">
                        <?php echo $tel; ?>
                    </a>
                    <div class="o-footer__info-box">
                        <div class="o-footer__info-link-box">
                            <a class="o-footer__info-link" href="<?php echo get_permalink( 741 ); ?>"><?= __( 'Vind je lokale telefoonnummer', 'openup' ) ?></a>
                        </div>
                        <a class="o-footer__svg-link" href="<?php echo get_permalink( 741 ); ?>">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="10" cy="10" r="9" stroke-width="2"/>
                                <path d="M9.53921 6.232C10.2112 6.232 10.7572 5.756 10.7572 5.098C10.7572 4.426 10.2112 3.95 9.53921 3.95C8.88121 3.95 8.33521 4.426 8.33521 5.098C8.33521 5.756 8.88121 6.232 9.53921 6.232ZM10.7432 14.982C10.7292 14.17 10.7152 12.952 10.7152 12.168V10.012L10.7712 7.772L10.5752 7.632L7.36921 8.472V8.808L8.41921 8.92C8.44721 9.634 8.46121 10.152 8.46121 11.048V12.168C8.46121 12.952 8.44721 14.156 8.43321 14.982L7.50921 15.066V15.5H11.5972V15.066L10.7432 14.982Z" />
                            </svg>
                        </a>
                    </div>
                </li> 
            <?php } ?>
            
            <?php
            if ($contact_link) { ?>
                <li class="o-footer__contact-item d-flex align-items-center"> 
                    <?php if ($chat_icon) { ?>
                        <?php
                        $icon_id = isset( $chat_icon['ID'] ) ? $chat_icon['ID'] : $chat_icon;
                            echo wp_get_attachment_image($icon_id,'full', "", array( "class" => "o-footer__contact-icon" ))
                        ?>
                    <?php } ?>
                    <a class="o-footer__contact-link"
                    href="<?php echo esc_url($contact_link['url']); ?>"
                    target="<?php echo esc_attr($contact_link['target']); ?>">
                        <?php echo esc_html($contact_link['title']); ?>
                    </a>
                </li>
            <?php } ?>

        </ul>
        <!--         END ACF CODE-->

        <?php echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @param array $instance Previously saved values from database.
     * @see WP_Widget::form()
     *
     */
    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        }
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     * @see WP_Widget::update()
     *
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        return $instance;
    }

} // class Contact_Info_Widget

// register Contact_Info_Widget widget
add_action('widgets_init', function () {
    register_widget('Contact_Info_Widget');
});
