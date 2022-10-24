<?php

/**
 * openup functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package openup
 */

if (!defined('ABSPATH')) exit;

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(-1);

require_once __DIR__ . '/inc/settings/settings.php';
//require_once __DIR__ . '/inc/acf/acf.php';
require_once __DIR__ . '/inc/admin/admin.php';
require_once __DIR__ . '/inc/utils/utils.php';
require_once __DIR__ . '/inc/post-type/post-type.php';
require_once __DIR__ . '/inc/render-templates/render-templates.php';
require_once __DIR__ . '/inc/posts/posts.php';
require_once __DIR__ . '/inc/plugins/plugins.php';
require_once __DIR__ . '/inc/widgets/widgets.php';
require_once __DIR__ . '/inc/functions/functions.php';
require_once __DIR__ . '/inc/jobs/Jobs.php';
require_once __DIR__ . '/inc/functions/b2b-functions.php';

