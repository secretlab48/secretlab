<?php

if (!defined('ABSPATH')) exit;

/**
 *  openup_line_wrap ()
 *  Gets line breaks from a field and wraps
 *  them in span or list.
 *
 *  @param   string $type Markup wrapping lines
 *  @return  $output
 *  @example
 *           openup_line_wrap($fieldname, 'span')
 */
function openup_line_wrap($textarea, $type = "list")
{
    $lines = explode("\n", $textarea);
    $output = '';

    if (!empty($lines)) {
        foreach ($lines as $line) {
            if ($type == 'list') {
                $output .= '<li>' . trim($line) . '</li>';
            } elseif ($type == 'span') {
                $output .= '<span>' . trim($line) . ' ' . '</span>';
            }
        }
    }
    return $output;
}
