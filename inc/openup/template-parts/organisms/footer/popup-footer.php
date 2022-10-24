<?php
    $logo = get_template_directory_uri().'/img/icons/es-flag.png';
?>
<div class="o-modal updateModal" data-content="className" data-action="setClass">
    <div class="o-modal-container u-bg-primary-white u-color-primary-dark-blue">
    <span class="o-modal-close">
        &times
    </span>
        <div class="o-modal-content">
            <div class="o-modal-content__image">
                <img class="updateModal" data-content="image" data-action="setSrc" src="<?php echo get_template_directory_uri().'/img/icons/placeholder.png' ?>" width="1" height="1" alt="popup-icon"/>
            </div>
            <div class="o-modal-content__title updateModal" data-content="title" data-action="setHtml"></div>
            <div class="o-modal-content__description updateModal" data-content="description" data-action="setHtml"></div>
            <div class="o-modal-content__button-box">
                <a href="#" class="o-modal-content__button left-button c-btn c-btn-primary--dark-blue updateModal" data-content="leftButton" data-action="setLink"></a>
                <a href="#" class="o-modal-content__button right-button c-btn c-btn-primary--blue updateModal" data-content="rightButton" data-action="setLink"></a>
            </div>
        </div>
    </div>
</div>
