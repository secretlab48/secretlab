<?php

global $post;

$token = get_sub_field('job_board_token');
$jobsBoardData = new Jobs($token);
$locations = $jobsBoardData->jobLocations;
$departments = $jobsBoardData->jobDepartments;
$custom_items = get_sub_field( 'job_board_custom_items', $post->ID );

?>


<div class="s-job-board__filters s-blog-post__filter JS-post-filter-slider JS-filter-slider" data-post_id="<?php echo $post->ID?>" data-token-url="<?php echo $token ?>">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="c-blog-filter JS-blog-filter u-bg-primary-skin u-color-primary-dark-blue">
                    <span class="c-blog-filter__main u-bg-primary-skin">
                        <span class="c-blog-filter__main-text">
                            <?php echo __('Location', 'openup'); ?>
                        </span>
                        <svg class="icon">
                            <use xlink:href="#icon-chevron-down"></use>
                        </svg>
                    </span>
                    <div class="c-blog-filter__list-wrap u-bg-primary-skin">
                        <ul class="c-blog-filter__list">
                            <li class="c-blog-filter__list-item JS-filter-item JS-filter-item--job">
                                <a class="JS--jobs-filter-btn u-color-primary-dark-blue"
                                   href="javascript:void(0)" data-job-location="all">
                                    <?php echo __('All locations', 'openup'); ?>
                                </a>
                            </li>
                            <?php foreach ($locations as $location) : ?>
                                <li class="c-blog-filter__list-item JS-filter-item JS-filter-item--job">
                                    <a class="JS--jobs-filter-btn u-color-primary-dark-blue"
                                       href="javascript:void(0)"
                                       data-job-location="<?php echo $location;?>">
                                        <?php echo $location;?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="c-blog-filter JS-blog-filter u-bg-primary-skin u-color-primary-dark-blue">
                    <span class="c-blog-filter__main u-bg-primary-skin">
                        <span class="c-blog-filter__main-text">
                             <?php echo __('Department', 'openup'); ?>
                        </span>
                        <svg class="icon">
                            <use xlink:href="#icon-chevron-down"></use>
                        </svg>
                    </span>
                    <div class="c-blog-filter__list-wrap u-bg-primary-skin">
                        <ul class="c-blog-filter__list">
                            <li class="c-blog-filter__list-item JS-filter-item JS-filter-item--job">
                                <a class="JS--jobs-filter-btn u-color-primary-dark-blue"
                                   href="javascript:void(0)" data-job-department="all">
                                    <?php echo __('All departments', 'openup'); ?>
                                </a>
                            </li>
                            <?php foreach ($departments as $department) :
                                ?>
                                <li class="c-blog-filter__list-item JS-filter-item JS-filter-item--job">
                                    <a class="JS--jobs-filter-btn u-color-primary-dark-blue"
                                       href="javascript:void(0)"
                                       data-job-department="<?php echo $department ?>">
                                        <?php echo $department ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>