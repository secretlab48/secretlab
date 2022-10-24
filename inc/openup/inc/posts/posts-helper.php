<?php

if (!defined('ABSPATH')) exit;

/**
 * Getting excerpt with defined symbols length
 *
 * @param int $charlength - count of char length
 * @param bool $strip_tags - strip tags
 * @return string
 */
function the_excerpt_max_charlength($charlength, $strip_tags = false)
{
    $excerpt = ($strip_tags) ? strip_tags(get_the_content()) : get_the_content();
    $excerpt = preg_replace("/<img[^>]+\>/i", "", $excerpt);
    $charlength++;

    if (mb_strlen($excerpt) > $charlength) {
        $subex = mb_substr($excerpt, 0, $charlength - 5);
        $exwords = explode(' ', $subex);
        $excut = -(mb_strlen($exwords[count($exwords) - 1]));
        if ($excut < 0) {
            echo mb_substr($subex, 0, $excut);
        } else {
            echo $subex;
        }
        echo '...';
    } else {
        echo $excerpt;
    }
}

/**
 * Getting terms names of post by taxonomy
 *
 * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
 * @param string $taxonomy
 * @param bool $strtolower
 * @return string
 */
function get_post_terms($post = 0, $taxonomy = null, $strtolower = false)
{
    $post = get_post($post);
    $id = isset($post->ID) ? $post->ID : 0;
    $taxonomy = ($taxonomy) ? $taxonomy : 'category';
    $terms = wp_get_post_terms($id, 'category');
    $post_terms = '';
    foreach ($terms as $term) {
        $post_terms .= ($strtolower) ? strtolower($term->name) . ' ' : $term->name . ' ';
    }
    return $post_terms;
}


/**
 * Getting previous post, if current post is first, return last post
 *
 * @return string
 */
function openup_get_previous_post()
{
    $post_type = get_post_type();
    $prev_post = get_previous_post();
    
    if ($prev_post) return $prev_post;

    $prev_post_arr = get_posts([
        'post_type' => $post_type,
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'DESC'
    ]);

    return (isset($prev_post_arr[0]) && $prev_post_arr[0]) ? $prev_post_arr[0] : null;
}

/**
 * Getting next post, if current post is last, return first post
 *
 * @return string
 */
function openup_get_next_post()
{
    $post_type = get_post_type();
    $next_post = get_next_post();

    if ($next_post) return $next_post;

    $next_post_arr = get_posts([
        'post_type' => $post_type,
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'ASC'
    ]);
    
    return (isset($next_post_arr[0]) && $next_post_arr[0]) ? $next_post_arr[0] : null;
}


function openup_duplicate($post_id) {
    $title   = get_the_title($post_id);
    $oldpost = get_post($post_id);
    $post    = array(
        'post_title' => $title,
        'post_status' => 'publish',
        'post_type' => 'business_post',
        'post_author' => $oldpost->post_author
    );
    $new_post_id = wp_insert_post($post);
    // Copy post metadata
    $data = get_post_custom($post_id);
    foreach ( $data as $key => $values) {
        foreach ($values as $value) {
            add_post_meta( $new_post_id, $key, maybe_unserialize( $value ) );// it is important to unserialize data to avoid conflicts.
        }
    }

    return $new_post_id;
}


function openup_convert_posts_to_busines_posts( $spreadsheetId = null ) {

    global $sitepress;

    $langs = apply_filters( 'wpml_active_languages', null );
    $current_lang = apply_filters( 'wpml_current_language', NULL );
    $post_type = 'business_post';
    $origin_id = false;

    ini_set('max_execution_time', 0);

    $service = openup_get_google_service();
    $spreadsheetId = '1o1gBGBewkvrMgd3KcOTsBXCkHl85TvVlLYQC7C4bpts';
    $range = 'To be moved to B2B';
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();

    foreach ( $values as $value ) {
        if ( preg_match( '/\d+/', $value[ 1 ], $id ) ) {
            $id = $id[ 0 ];
            $post_lang_info = apply_filters( 'wpml_post_language_details', null, $id );
            foreach ( $langs as $lang => $lang_data ) {
                if ( $lang == $post_lang_info['language_code'] ) {
                    $origin_id = openup_duplicate($id);
                } else {
                    $lang_id = apply_filters( 'wpml_object_id', $id, 'post', false, $lang );
                    if ( $lang_id && $origin_id ) {
                        $sitepress->switch_lang( $lang );
                        $translated_post_id = openup_duplicate( $lang_id );
                        $sitepress->switch_lang( $current_lang );
                        if ( $translated_post_id != 0 ) {
                            $trid = $sitepress->get_element_trid( $origin_id, 'post_' . $post_type );
                            $sitepress->set_element_language_details( $translated_post_id, 'post_' . $post_type, $trid, $lang );
                            if ( ! empty( $value[ 2 ] ) && $value[ 2 ] == 'Yes' ) {
                                //wp_delete_post( $id );
                            }
                        }
                    }
                }
            }
        }
    }

}
