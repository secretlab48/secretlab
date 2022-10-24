<?php

//ACF vars
$noticeBoardTitle = get_sub_field('section_title_and_people_title');
$template_type = get_sub_field('section_title_and_people_title_template_type');
$template_type = ( ! empty( $template_type ) ) ? $template_type : 'default';
if ( $template_type == 'default' ) {
    $btn_type = get_sub_field('type_of_button');
    $buttonTitleField = get_sub_field('button_title');
    if ($btn_type == 'link') {
        $noticeBoardBtn = get_sub_field('section_title_and_people_btn');
        $buttonTitle = (!empty($buttonTitleField)) ? $buttonTitleField : $noticeBoardBtn['title'];
    } else {
        $buttonTitle = (!empty($buttonTitleField)) ? $buttonTitleField : __('go to Job Section', 'openup');
        $noticeBoardBtn = ['title' => $buttonTitle, 'url' => '#department-no-department'];
    }

    $noticeBoardDescription = get_sub_field('section_title_and_people_desc');
    $noticeBoardImageM = get_sub_field('section_title_and_people_man');
    $noticeBoardImageW = get_sub_field('section_title_and_people_woman');
}
elseif ( $template_type == 'case_study' ) {
    $notices = get_sub_field('section_title_and_people_title_notices');
    $interviewer = get_sub_field('section_title_and_people_title_interviever');
}
?>

<section class="o-notice-board">
    <div class="o-notice-board__banner">
        <?php if ( $template_type == 'default' ) : ?>
        <div class="o-notice-board__img">
            <?php echo wp_get_attachment_image($noticeBoardImageW['ID'], 'full', "", array("class" => "notice-board-img--people")) ?>
        </div>
        <div class="o-notice-board__img">
            <?php echo wp_get_attachment_image($noticeBoardImageM['ID'], 'full', "", array("class" => "notice-board-img--people")) ?>
        </div>
        <?php endif; ?>
        <div class="o-notice-board__wrapper">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-md-10 col-lg-8 col-12 o-notice-board__container">
                        <h1 class="o-notice-board__title"><?php echo $noticeBoardTitle; ?></h1>
                        <?php if ( $template_type == 'default' ) : ?>
                        <div class="o-notice-board__btn">
                            <a class="c-btn c-btn-primary--blue" href="<?php echo $noticeBoardBtn['url']; ?>">
                                <?php echo $buttonTitle ?></a>
                        </div>
                        <?php endif; ?>
                        <?php if ( $template_type == 'case_study' && ! empty ( $interviewer ) ) : ?>
                            <h2 class="o-notice-board__interviewer-box">
                                <a class="o-notice-board__interviewer" href="<?php echo $interviewer['url']; ?>"><?php echo $interviewer['title'] ?></a>
                            </h2>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-10 col-lg-8 col-12">
                    <div class="o-notice-board__description">
                        <?php echo $noticeBoardDescription; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php if ( $template_type == 'case_study' ) : ?>
        <div class="o-notice-board__notices-container container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 col-12">
                    <div class="o-notice-board__notices-box">
                        <?php
                        foreach ( $notices as $notice ) : ?>
                            <div class="o-notice-board__notice">
                                <h2 class="o-notice-board__notice-title"><?php echo $notice[ 'section_title_and_people_title_notices_title' ]; ?> </h2>
                                <div class="o-notice-board__notice-description"><?php echo $notice[ 'section_title_and_people_title_notices_description' ]; ?> </div>
                            </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</section>
