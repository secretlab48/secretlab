<?php

/**
 *  Partial: Sections
 *
 *  Partial for loading Sections via file name using a class extending
 *  ACF's flexible content field.
 *
 *  @see       inc/acf/acf-sections.php - Sections class
 *  @see       inc/fields/* - Defined fields and Sections
 */

if (!defined('ABSPATH')) exit; 

// Sections
while (has_sub_field('sections')) :
    ACF_Sections::render(get_row_layout());
endwhile;
