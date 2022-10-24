<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * https://typerocket.com/ultimate-guide-to-custom-post-types-in-wordpress/
 * 
 * Flush Rewrites
 */
add_action( 'after_switch_theme', 'openup_flush_rewrite_rules' );

function openup_flush_rewrite_rules() {
  flush_rewrite_rules();
}

require_once 'post-type-labels.php';
require_once 'team.php';
require_once 'faq.php';
require_once 'thema.php';
require_once 'thema-areas-taxonomy.php';
require_once 'testimonials.php';
require_once 'author-taxonomy.php';
require_once 'ebook.php';
require_once 'boek-consult.php';
require_once 'webinar.php';
require_once 'space/space.php';
require_once 'post-b2b/post-b2b.php';
require_once 'case-studies/case-study.php';

