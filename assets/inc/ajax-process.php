<?php

add_action('wp_ajax_add_vote', 'add_vote_callback');
add_action('wp_ajax_nopriv_add_vote', 'add_vote_callback');

function add_vote_callback()
{
    global $wpdb;
    $tableVotes = $wpdb->prefix.'votes';
    $clientIP = get_the_user_ip();

    $return_data = array( 'success' => true, 'voted' => true, 'count' => 0 );

    $sql = 'SELECT COUNT(ip) AS count FROM '.$tableVotes.' WHERE ip = %s';
    $votes = $wpdb->get_row(
        $wpdb->prepare(
            $sql,
            $clientIP
        )
    );

    if (intval($votes->count) === 0) {
        $result = $wpdb->insert($tableVotes, array('post_id' => $_POST['post_id'], 'ip' => $clientIP, 'date_created' => date('Y-m-d H:i:s')));

        if (!$result) {
            $return_data['success'] = false;
        }
    } else {
        $return_data['voted'] = false;
    }

    $sql = 'SELECT COUNT(post_id) AS count FROM '.$tableVotes.' WHERE post_id = %s';
    $votes = $wpdb->get_row(
        $wpdb->prepare(
            $sql,
            $_POST['post_id']
        )
    );

    update_post_meta($_POST['post_id'], 'vote_count', $votes->count);
    $return_data['count'] = $votes->count;

    echo json_encode($return_data);

    die();
}

add_action('wp_ajax_load_more_cats', 'load_more_cats_callback');
add_action('wp_ajax_nopriv_load_more_cats', 'load_more_cats_callback');

function load_more_cats_callback()
{
    global $wpdb;

    $return_data = array( 'success' => true, 'morePosts' => false, 'posts' => array() );

    $posts_per_page = 4; //'meta_value_num' => 'DESC',
    $args = array( 'post_type' => 'cat-entrants', 'posts_per_page' => $posts_per_page, 'paged' => $_GET['page'], 'post_status' => 'publish', 'meta_key' => 'vote_count', 'orderby' => array( 'post_modified' => 'DESC') );
    $loop = new WP_Query($args);

    if ($loop->have_posts()) :

            $counter = 0;

    while ($loop->have_posts()) : $loop->the_post();
    $postID = get_the_ID();
    $image = wp_get_attachment_image_src(get_post_thumbnail_id($postID), 'gallery_tiles');
    $age = get_field('age');
    $year = get_field('year_adopted');
    $description = get_field('description');
    $readMore = get_field('read_more');
    $images = get_field('images_entrants');

    $tableVotes = $wpdb->prefix.'votes';
    $sql = 'SELECT COUNT(post_id) AS count FROM '.$tableVotes.' WHERE post_id = %s';
    $votes = $wpdb->get_row(
                    $wpdb->prepare(
                        $sql,
                        $postID
                    )
                );

    $return_data['posts'][] = array(
                    'postID' => $postID,
                    'permalink' => get_permalink(),
                    'title' => get_the_title(),
                    'images' => $images,
                    'age' => $age,
                    'year' => $year,
                    'description' => $description,
                    'readMore' => apply_filters('the_content', $readMore),
                    'votes' => $votes->count,
                    'morePosts' => ($counter === $posts_per_page),
                );
    $counter++;
    endwhile;
    endif;

    $return_data['morePosts'] = ($counter === $posts_per_page);

    echo json_encode($return_data);

    die();
}
