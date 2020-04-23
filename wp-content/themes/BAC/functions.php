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
}

add_action( 'wp_enqueue_scripts', 'style_and_scripts' );

function adding_scripts() {

    wp_register_script('jquery',get_template_directory_uri() . '/js/jquery-3.3.1.min.js');
    wp_enqueue_script('jquery');

    wp_register_script('jquery-ui',get_template_directory_uri() . '/js/jquery-ui.min.js');
    wp_enqueue_script('jquery-ui');

    wp_register_script('owl-carousel',get_template_directory_uri() . '/js/owl.carousel.min.js');
    wp_enqueue_script('owl-carousel');

    wp_register_script('main',get_template_directory_uri() . '/js/main.js');
    wp_enqueue_script('main');

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
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
    $send_to_admin = wp_mail ('info@beecholmeadultcare.co.uk','BAC Event Booking',$mes,$headers);

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

add_action('wp_footer', 'add_cookies_banner');
function add_cookies_banner() {
    if(is_null($_COOKIE['cookies-accepted']) && !is_page(397))
        get_template_part('cookies');
}

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

    return in_array($value, $values);
}

function getACFLoopValues($field, $user_id)
{
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

function getServices($type = '') {
    $ameliaEmployeesWPUserId = getRandomAmeliaWPUser();
    $services = get_field_object('specializations', "user_{$ameliaEmployeesWPUserId}")['choices'];

var_dump($services);

    if($type === 'Therapist') {
        return array_slice($services, 0, 9);
    }

    if($type === 'Life coach') {
        return array_slice($services, 9, 9);
    }

    return $services;
}

function mailtrap($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = '228e63f59109f3';
    $phpmailer->Password = '9e9a4c120ed8d2';
}

add_action('phpmailer_init', 'mailtrap');