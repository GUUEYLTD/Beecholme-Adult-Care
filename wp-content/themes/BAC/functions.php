<?php
require_once 'includes/Practitioners.php';
require_once 'includes/Category.php';
require_once 'includes/Service.php';

add_theme_support( 'post-thumbnails' );
add_filter( 'wpseo_remove_reply_to_com', false );

function style_and_scripts() {

    wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css');
    wp_enqueue_style( 'owl-carousel-theme', get_template_directory_uri() . '/css/owl.theme.default.min.css');
    wp_enqueue_style( 'jquery-ui', get_template_directory_uri() . '/css/jquery-ui.min.css');
    wp_enqueue_style( 'main-styles', get_template_directory_uri() . '/css/style.css');
    wp_enqueue_style( 'select2', 'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css');
}

add_action( 'wp_enqueue_scripts', 'style_and_scripts' );

function adding_scripts() {

    wp_register_script('jquery',get_template_directory_uri() . '/js/jquery-3.3.1.min.js');
    wp_enqueue_script('jquery');

    wp_register_script('jquery-ui',get_template_directory_uri() . '/js/jquery-ui.min.js');
    wp_enqueue_script('jquery-ui');

    wp_register_script('owl-carousel',get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '', true);
    wp_enqueue_script('owl-carousel');

    wp_register_script('main',get_template_directory_uri() . '/js/main.js');
    wp_enqueue_script('main');

    wp_enqueue_style( 'main-redesign-css', get_template_directory_uri() . '/css/main-redesign-css.css');
    if ( is_page_template('home-redesign.php') ) {
        wp_enqueue_script('main-redesign-js',get_template_directory_uri() . '/js/main-redesign-js.js', array('jquery', 'owl-carousel'), '', true);
        wp_enqueue_script('wow-js','https://cdnjs.cloudflare.com/ajax/libs/wow/0.1.12/wow.min.js', array('jquery'), '', true);
        wp_enqueue_style( 'animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.1.0/animate.min.css');
    }

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_register_script('select2', 'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js', array('jquery'),
        '4.0.3', true);
    wp_enqueue_script('select2');
}

add_action( 'wp_enqueue_scripts', 'adding_scripts' );

function register_my_menu() {
    register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

add_action( 'wp_ajax_booking_mail', 'booking_mail' );
// If you want not logged in users to be allowed to use this function as well, register it again with this function:
add_action( 'wp_ajax_nopriv_booking_mail', 'booking_mail' );

function booking_mail(){

    global $wpdb;
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $activity = $_POST['activity'];


    $headers = array(
        'From: BAC <info@beecholmeadultcare.co.uk>',
        'content-type: text/plain',
    );
    $mes_user = "Thank you for booking ".$activity." on the ".$date." at ".$time.". Look forward to seeing you there.";
    $send_to_user = wp_mail($email,'BAC Event Booking',$mes_user,$headers);

    $mes = "Activity: ".$activity."\n\nName: ".$fname." " .$lname."\n\nEmail: ".$email."\n\nPhone: ".$phone."\n\nDate: ".$date."\n\nTime: ".$time;
    $send_to_admin = wp_mail ('online@beecholmeadultcare.co.uk','BAC Event Booking',$mes,$headers);

    $n_date = date('Y-m-d', strtotime($date));

    $time = str_replace('.', ':', $time);

    $wpdb->insert("wp_bookings", array(
        "f_name" => $fname,
        "l_name" => $lname,
        "email" => $email,
        "activity" => $activity,
        "booking_date" => $n_date,
        "time" => $time,
    ));

    die();
}

add_action( 'booking_notifications', 'booking_notif' );

function booking_notif() {

    global $wpdb;

    $headers = array(
        'From: BAC <info@beecholmeadultcare.co.uk>',
        'content-type: text/plain',
    );

    $cur_time = new DateTime(null, new DateTimeZone('Europe/London'));
    $cur_time = $cur_time->format('H:i:s');

    $db = $wpdb->get_results("SELECT * FROM wp_bookings WHERE send = 0");
    foreach($db as $single_entry) {
        $date = $single_entry->booking_date;
        $now = new DateTime();
        $now = $now->format('Y-m-d');
        if($date == $now) {
            $cur_time = new DateTime(null, new DateTimeZone('Europe/London'));
            $cur_time = $cur_time->format('H:i:s');
            echo $single_entry->time." - ".$cur_time."<br>";
            if($single_entry->time > $cur_time) {
                $time_difference = $single_entry->time - $cur_time;
                if( $time_difference < 12) {
                    $time = date('g:ia', strtotime($single_entry->time));
                    $user_mail = $single_entry->email;
                    $mes_notif = "Dear ".$single_entry->f_name.", This is a reminder about your BAC activity ".$single_entry->activity." on ".$single_entry->booking_date." at ".$time.". We look forward to seeing you then! If for some reason you can't make it, please reply to this email.\nSincerely,\nBAC_Beecholme Adult Care";
                    $send_notif = wp_mail($user_mail,'BAC Event Booking',$mes_notif,$headers);
                    $wpdb->update('wp_bookings', array('send' => 1), array('id'=>$single_entry->id));
                }
            }
        }
    }
}

//add_action('wp_footer', 'add_cookies_banner');
//function add_cookies_banner() {
//    if(is_null($_COOKIE['cookies-accepted']) && !is_page(397))
//        get_template_part('cookies');
//}

add_action('wp_enqueue_scripts', 'enqueue_cookies_scripts');
function enqueue_cookies_scripts() {
    wp_enqueue_script('cookies', get_template_directory_uri() . '/js/cookies.js', array(), '1.0', true);
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bac_widgets_init() {
    register_sidebar( array(
        'name'          => 'Sidebar',
        'id'            => 'sidebar-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'bac_widgets_init' );

/**
 * Set default description value to prevent plugin gallery id bug
 * @param $args
 * @return mixed
 */
function bac_rl_gallery_tab_fields($args) {
    $args['misc']['options']['gallery_description']['default'] = 'Add your description here';

    return $args;
}

add_action( 'rl_gallery_tab_fields', 'bac_rl_gallery_tab_fields' );


new \BAC\Practitioners();

# Change author/username base to users/userID
function change_author_permalinks() {
    global $wp_rewrite;
    // Change the value of the author permalink base to whatever you want here
    $wp_rewrite->author_base = 'counsellor';
    $wp_rewrite->flush_rules();
}

add_action('init','change_author_permalinks');


function array_flatten($array)
{
    $return = array();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $return = array_merge($return, array_flatten($value));
        } else {
            $return[] = $value;
        }
    }

    return $return;
}

add_action('user_register', function ($user_id) {
    if(!$requestBody = json_decode(file_get_contents('php://input'))) {
        return;
    }

    $fullName            = "{$requestBody->firstName} {$requestBody->lastName}";

    $user                = get_user_by('ID', $user_id);
    $user->user_nicename = sanitize_title($fullName) . '-' . time();
    $user->display_name  = $fullName;
    wp_update_user($user);

    update_user_meta($user_id, 'first_name', $requestBody->firstName);
    update_user_meta($user_id, 'last_name', $requestBody->lastName);
}, 10, 1);

function hasFieldMatch($field, $value, $user_id)
{
    $values = getACFLoopValues($field, $user_id);

    if($field === 'languages') {
        foreach ($value as $language) {
            if(in_array($language, $values))
                return true;
        }
    }

    return in_array($value, $values);
}

function getACFLoopValues($field, $user_id)
{
    if($field === 'specializations') {
        return array_merge(array_flatten(get_field('specializations_therapist', "user_{$user_id}")),
            array_flatten(get_field('specializations_coach', "user_{$user_id}")));
    }

    return array_flatten(get_field($field, "user_{$user_id}"));
}

function formatDuration($seconds)
{
    $hours   = floor((int)$seconds / 3600);
    $minutes = (int)$seconds / 60 % 60;

    $output = $hours ? "{$hours}h " : '';
    $output .= $minutes ? "{$minutes}m " : '';

    return $output;
}

function getRandomAmeliaWPUser(){
    foreach (get_users() as $user) {
        if(in_array('wpamelia-provider', $user->roles))
            return $user->ID;
    }

    return 0;
}

function getServices($type = '')
{
    $ameliaEmployeesWPUserId = getRandomAmeliaWPUser();

    if ($type === 'Therapist') {
        return get_field_object('specializations_therapist', "user_$ameliaEmployeesWPUserId")['choices'];
    }

    if ($type === 'Life coach') {
        return get_field_object('specializations_coach', "user_$ameliaEmployeesWPUserId")['choices'];
    }

    return array_merge(get_field_object('specializations_therapist', "user_$ameliaEmployeesWPUserId")['choices'],
        get_field_object('specializations_coach', "user_$ameliaEmployeesWPUserId")['choices']);
}

/** Policy shortcode */

function policyActiveLink($attributes) {
    if (!isset($attributes['link_name'], $attributes['current_page_title'])) {
        return null;
    }

    if ($attributes['link_name'] == $attributes['current_page_title']) {
        return 'active-sidebar-link';
    }

    return null;
}

add_shortcode('policy_active_link', 'policyActiveLink');

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page([
        'page_title' 	=> 'Theme Footer Settings',
        'menu_title'	=> 'Footer',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ]);

}

add_filter('admin_body_class', 'setAdminClassToEmployeeUser');

function setAdminClassToEmployeeUser($classes) {
    $currentUser = wp_get_current_user();

    if (!$currentUser) {
        return $classes;
    }

    if (in_array('wpamelia-provider', $currentUser->roles)) {
        $classes .= ' employee-admin';
    }

    return $classes;
}

function adminStyles() {
    wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/admin.css');
}
add_action('admin_enqueue_scripts', 'adminStyles');

/** Posts shortcode */

add_shortcode('declare_recent_posts', 'declareRecentPosts');

function declareRecentPosts($attributes)
{
    $postsNumber = 3;
    if (!isset($attributes['posts_number'])) {
        $postsNumber = $attributes['posts_number'];
    }

    global $recentPosts;

    $recentPosts = get_posts(
        array(
            'numberposts'      => $postsNumber,
            'orderby'          => 'date',
            'order'            => 'DESC',
            'post_type'        => 'post',
            'suppress_filters' => true,
        )
    );
}

/** Allow employees to upload image */

add_action('admin_init', 'allowEmployeeDownloads');
function allowEmployeeDownloads()
{
    $employee = get_role('wpamelia-provider');
    if ($employee !== null) {
        $employee->add_cap('upload_files');
    }
}

add_filter('ajax_query_attachments_args', 'wpbShowCurrentUserAttachments');

function wpbShowCurrentUserAttachments($query)
{
    $userId = get_current_user_id();
    if ($userId && !current_user_can('activate_plugins') && !current_user_can(
            'edit_others_posts
'
        )) {
        $query['author'] = $userId;
    }

    return $query;
}

function hide_media_by_other($query) {
    global $pagenow;

    if( 'upload.php' != $pagenow || !$query->is_admin ){
        return $query;
    }

    if( !current_user_can( 'manage_options' ) ) {
        global $user_ID;
        $query->set('author', $user_ID );
    }
    return $query;
}
add_filter('pre_get_posts', 'hide_media_by_other');



add_action( 'wp_ajax_filter_counsellors_paginated', 'filter_counsellors_paginated' );
add_action( 'wp_ajax_nopriv_filter_counsellors_paginated', 'filter_counsellors_paginated' );


add_action( 'wp_ajax_search_counsellors_total', 'search_counsellors_total' );
add_action( 'wp_ajax_nopriv_search_counsellors_total', 'search_counsellors_total' );

function search_counsellors_total(){
    $languages = $_GET['language'];
    $limit = (int)$_GET['limit'];
    $type = $_GET['type'];
    $specialization = $_GET['specialization'];

    $userMetaJoins = 'LEFT JOIN wp_usermeta as wpum0 ON wpum0.user_id = au.externalId ';
    $filters = 'WHERE au.status=\'visible\' AND au.type=\'provider\'  AND wpum0.meta_key=\'enable_search\' AND wpum0.meta_value=1 ';

    $type = str_replace('life-', '', sanitize_title($type));
    $metaCount = 0;
    if($type) {
        $metaCount++;
        $userMetaJoins .= "LEFT JOIN wp_usermeta as wpum{$metaCount} ON wpum{$metaCount}.user_id = au.externalId ";
        $filters .= "AND wpum{$metaCount}.meta_key='type' AND wpum{$metaCount}.meta_value LIKE '%{$type}%'";
    }

    if($specialization !== 'All') {
        $type = $type !== '' ? $type : (in_array($specialization, getServices('Life coach')) ? 'coach' : 'therapist');
        $metaCount++;
        $userMetaJoins .= "LEFT JOIN wp_usermeta as wpum{$metaCount} ON wpum{$metaCount}.user_id = au.externalId ";
        $filters .= "AND wpum{$metaCount}.meta_key='specializations_{$type}' AND wpum{$metaCount}.meta_value LIKE '%{$specialization}%'";
    }

    if ($languages) {
        $languages = '\'' . implode('\',\'', $languages) . '\'';
        $metaCount++;
        $userMetaJoins .= "LEFT JOIN wp_usermeta as wpum{$metaCount} ON wpum{$metaCount}.user_id = au.externalId ";
        $filters .= "AND wpum{$metaCount}.meta_key LIKE '%_language%' AND wpum{$metaCount}.meta_value IN ($languages)";
    }

    $count_query = "SELECT COUNT(*) as count FROM  wp_amelia_users as au
            LEFT JOIN wp_users as wpu ON wpu.ID = au.externalId
            {$userMetaJoins}
            LEFT JOIN wp_amelia_providers_to_services as wpapts ON wpapts.id = au.id
            LEFT JOIN wp_amelia_services as wpas ON wpas.id = wpapts.serviceId
            {$filters}";

    global $wpdb;

    $count_result = $wpdb->get_results($count_query);
    $count_res = $count_result[0]->count;

    wp_die($count_res);
}


function filter_counsellors_paginated(){
    $languages = $_GET['language'];
    $limit = (int)$_GET['limit'];
    $type = $_GET['type'];
    $specialization = $_GET['specialization'];
    $sortBy = $_GET['sortBy'];
    $sortOrder = $_GET['sortOrder'];

    $userMetaJoins = 'LEFT JOIN wp_usermeta as wpum0 ON wpum0.user_id = au.externalId ';
    $filters = 'WHERE au.status=\'visible\' AND au.type=\'provider\'  AND wpum0.meta_key=\'enable_search\' AND wpum0.meta_value=1 ';
    $orders = '';

    $type = str_replace('life-', '', sanitize_title($type));
    $metaCount = 0;
    if($type) {
        $metaCount++;
        $userMetaJoins .= "LEFT JOIN wp_usermeta as wpum{$metaCount} ON wpum{$metaCount}.user_id = au.externalId ";
        $filters .= "AND wpum{$metaCount}.meta_key='type' AND wpum{$metaCount}.meta_value LIKE '%{$type}%'";
    }

    if($specialization !== 'All') {
        $type = $type !== '' ? $type : (in_array($specialization, getServices('Life coach')) ? 'coach' : 'therapist');
        $metaCount++;
        $userMetaJoins .= "LEFT JOIN wp_usermeta as wpum{$metaCount} ON wpum{$metaCount}.user_id = au.externalId ";
        $filters .= "AND wpum{$metaCount}.meta_key='specializations_{$type}' AND wpum{$metaCount}.meta_value LIKE '%{$specialization}%'";
    }

    if ($languages) {
        $languages = '\'' . implode('\',\'', $languages) . '\'';
        $metaCount++;
        $userMetaJoins .= "LEFT JOIN wp_usermeta as wpum{$metaCount} ON wpum{$metaCount}.user_id = au.externalId ";
        $filters .= "AND wpum{$metaCount}.meta_key LIKE '%_language%' AND wpum{$metaCount}.meta_value IN ($languages)";
    }


    $query = "SELECT *, au.id as 'ameliaId', au.pictureThumbPath FROM  wp_amelia_users as au
            LEFT JOIN wp_users as wpu ON wpu.ID = au.externalId
            {$userMetaJoins}
            LEFT JOIN wp_amelia_providers_to_services as wpapts ON wpapts.id = au.id
            LEFT JOIN wp_amelia_services as wpas ON wpas.id = wpapts.serviceId
            {$filters}
            LIMIT {$limit}";

    global $wpdb;
    //$wpdb->show_errors( true );

    $results = $wpdb->get_results($query);

    foreach ($results as $res){
        set_query_var('listingUser', $res);
        get_template_part('template-parts/counsellors/single', 'listingp');
    }

    wp_die();
}

add_filter('wpseo_sitemap_exclude_author', function ($users){

    $users = get_users();
    $users = array_filter($users, function ($user){
        return in_array('wpamelia-provider', $user->roles) && get_field('enable_search', 'user_' . $user->ID);
    });

    return $users;
});

add_filter('use_block_editor_for_post', '__return_false', 10);