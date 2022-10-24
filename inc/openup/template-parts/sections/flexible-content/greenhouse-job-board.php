<?php

global $post;

//ACF vars
$section_title = get_sub_field('job_board_title');
$token = get_sub_field('job_board_token');

$jobsBoardData = new Jobs($token);
$jobsBoard = $jobsBoardData->boardData;
$departmentsAll = $jobsBoardData->getDepartments();
$locationsAll = $jobsBoardData->jobLocations;
$custom_items = get_sub_field( 'job_board_custom_items', $post->ID );

?>

<section class="s-job-board u-bg-secondary-skin">
    <div class="container">
        <div class="row justify-content-center" id="department-no-department">
            <div class="col-lg-10">
                <div class="row justify-content-lg-end">
                    <?php if ($section_title): ?>
                        <div class="col-lg-10">
                            <div class="s-job-board__head d-md-flex align-items-md-center justify-content-md-between">
                                <h2 class="s-job-board__title u-color-primary-dark-blue">
                                    <?php echo $section_title; ?>
                                </h2>
                                <?php get_template_part('template-parts/components/greenhous-job-filter'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="JS--ajax-job-container">
                    <?php foreach ($jobsBoard['departments'] as $department) :
                        if ( $custom_items && count( $custom_items ) > 0 ) :
                            foreach( $custom_items as $custom_item ) {
                                if ( $custom_item[ 'job_board_custom_department' ] == $department[ 'name' ] ) {
                                    $department[ 'jobs' ][] = [
                                            'absolute_url' => $custom_item[ 'job_board_custom_link' ],
                                            'title' => $custom_item[ 'job_board_custom_title' ],
                                            'location' => [ 'name' => $custom_item[ 'job_board_custom_location' ] ]
                                    ];
                                }
                            }
                        endif;
                        if (!empty($department['jobs'])) :
                            ?>
                            <div class="row c-job-card__container" id="department-<?php echo strtolower( str_replace( ' ', '-', $department['name'] ) ); ?>">
                                <div class="col-lg-2">
                                    <div class="s-job-board__profession">
                                        <h6 class="u-color-primary-dark-blue text-center text-lg-left"><?php echo $department['name'] ?></h6>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="c-job-card__wrap">
                                        <?php foreach ($department['jobs'] as $job) :
                                            $location = $job['location'];
                                            $retention_period = ! empty( $job['retention_period'] ) ? $job['retention_period'] : '';
                                            ?>
                                            <div class="c-job-card u-bg-primary-white">
                                                <div class="c-job-card__info">
                                                    <h5 class="c-job-card__title u-color-primary-dark-blue"><?php echo $job['title']; ?></h5>
                                                    <div class="c-job-card__location">
                                                        <span class="c-job-card__text u-color-primary-dark-blue"><?php echo $retention_period; ?></span>
                                                        <span class="c-job-card__text u-color-primary-dark-blue"><?php echo $location['name']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="c-job-card__btn">
                                                    <a class="c-btn c-btn-primary--blue"
                                                       href="<?php echo $job['absolute_url']; ?>">
                                                        <?php echo __('Details', 'openup'); ?>
                                                        <svg class="icon">
                                                            <use xlink:href="#icon-arrow-team"></use>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endif;
                    endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
