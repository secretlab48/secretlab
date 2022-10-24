<?php

if (!defined('ABSPATH')) exit;

/**
 *  openup_get_bg_color_class()
 *
 *  @param   string $color Color
 *  @return  string
 *  @example openup_get_bg_color_class($color)
 */
function openup_get_bg_color_class($color = null)
{
    if(!$color) return '';
    $bg_colors = [
        'bg-white' => '',
        'bg-grey-light' => 'u-bg-grey-light',
        'bg-grey-dark' => 'u-bg-grey-dark',
        'bg-orange' => 'u-bg-orange',
    ];
    return (isset($bg_colors[$color])) ? $bg_colors[$color] : '';
}

/**
 *  openup_bg_color()
 *  echo bg color property for element
 * 
 *  @param   string $color Color
 *  @return  string
 *  @example openup_bg_color($color)
 */
function openup_the_bg_color($color = null)
{
    echo ($color) ? "style='background-color: {$color}'" : "";
}

/**
 *  openup_hex_to_rgba()
 *  Convert color format from hex to rgba
 *
 *  @param   string $color Color
 *  @param   string $opacity Opacity
 *  @return  string
 *  @example openup_hex_to_rgba($color, $opacity)
 */
function openup_hex_to_rgba($color = null, $opacity = null)
{
    if(!$color || !$opacity) return '';
    list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");
    return sprintf('rgba(%d, %d, %d, %F)', $r, $g, $b, $opacity);

}