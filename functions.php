<?php

// Recommended plugins installer
require_once 'include/plugins/init.php';
require_once('include/wpadmin/admin-addons.php');

function my_acf_init()
{
    acf_update_setting('google_api_key', 'AIzaSyAOfuigGs3rWzZsdcWmQTeGU82RGccVqfc');
}

add_action('acf/init', 'my_acf_init');

function style_js()
{
    if ( ! is_admin() ) {
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js' );
        wp_enqueue_script( 'jquery' );
    };

    wp_enqueue_script('lib', get_template_directory_uri() . '/js/lib.js', array('jquery'), '1.0', true);
    wp_enqueue_script('logic', get_template_directory_uri() . '/js/logic.js', array('jquery'), '1.0', true);

    wp_enqueue_style('fonts', get_template_directory_uri() . '/style/fonts.css');
    wp_enqueue_style('libs', get_template_directory_uri() . '/style/libs.css');
    wp_enqueue_style('style', get_template_directory_uri() . '/style/style.css');
}
add_action('wp_enqueue_scripts', 'style_js');

// HTML5 support for IE
function wp_IEhtml5_js () {
    global $is_IE;
    if ($is_IE)
        echo '<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><script src="//css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]--><!--[if lte IE 9]><link href="'.theme().'/style/animations-ie-fix.css" rel="stylesheet" /><![endif]-->';
}
add_action('wp_head', 'wp_IEhtml5_js');

// Custom theme url
function theme($filepath = NULL){
    return preg_replace( '(https?://)', '//', get_stylesheet_directory_uri() . ($filepath?'/' . $filepath:'') );
}

//register menus
register_nav_menus(array(
    'main_menu' => 'Main menu',
    'footer_menu' => 'Footer menu',
));

//register sidebar
$reg_sidebars = array (
    'page_sidebar'     => 'Page Sidebar',
    'blog_sidebar'     => 'Blog Sidebar',
    'footer_sidebar'   => 'Footer Area'
);
foreach ( $reg_sidebars as $id => $name ) {
    register_sidebar(
        array (
            'name'          => __( $name ),
            'id'            => $id,
            'before_widget' => '<div class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widgetTitle">',
            'after_title'   => '</h2>',
        )
    );
}

if(function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
/*	acf_add_options_sub_page(array(
		'page_title'    => 'Theme Header Settings',
		'menu_title'    => 'Header',
		'parent_slug'   => 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title'    => 'Theme Footer Settings',
		'menu_title'    => 'Footer',
		'parent_slug'   => 'theme-general-settings',
	));*/
}

add_theme_support( 'post-thumbnails' );

//images sizes
add_image_size( 'full', '1920', '', true );

//light function fo wp_get_attachment_image_src()
function image_src($id, $size = 'full', $background_image = false, $height = false) {
    if ($image = wp_get_attachment_image_src($id, $size, true)) {
        return $background_image ? 'background-image: url('.$image[0].');' . ($height?'min-height:'.$image[2].'px':'') : $image[0];
    }
}

//clear wp_head

remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head' );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head' );
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rel_canonical');
//remove_action('wp_head', 'qtrans_header', 10, 0);
add_action('widgets_init', 'my_remove_recent_comments_style');
function my_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
// Remove Emoji js/styles
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );

/* BEGIN: Theme config section*/
define ('HOME_PAGE_ID', get_option('page_on_front'));
define ('BLOG_ID', get_option('page_for_posts'));
define ('POSTS_PER_PAGE', get_option('posts_per_page'));
/* END: Theme config section*/

//Body class
function new_body_classes( $classes ){
    if( is_page() ){
        $temp = get_page_template();
        if ( $temp != null ) {
            $path = pathinfo($temp);
            $tmp = $path['filename'] . "." . $path['extension'];
            $tn= str_replace(".php", "", $tmp);
            $classes[] = $tn;
        }
        global $post;
        $classes[] = 'page-'.get_post($post)->post_name;
        if (is_active_sidebar('sidebar')) {
            $classes[] = 'with_sidebar';
        }
    }
    if(is_page() && !is_front_page() || is_single()) {$classes[] = 'static-page';}
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
    if($is_lynx) $classes[] = 'lynx';elseif($is_gecko) $classes[] = 'gecko';elseif($is_opera) $classes[] = 'opera';elseif($is_NS4) $classes[] = 'ns4';elseif($is_safari) $classes[] = 'safari';elseif($is_chrome) $classes[] = 'chrome';elseif($is_IE) $classes[] = 'ie';else $classes[] = 'unknown';if($is_iphone) $classes[] = 'iphone';
    return $classes;
}
add_filter( 'body_class', 'new_body_classes' );

//remove ID in menu list
add_filter('nav_menu_item_id', 'clear_nav_menu_item_id', 10, 3);
function clear_nav_menu_item_id($id, $item, $args) {
    return "";
}

function content_btn($atts,$content){
    extract(shortcode_atts(array(
        'text' => 'Learn More',
        'link' => site_url(),
        'class' => false,
        'target' => false
    ), $atts ));
    return '<a href="' . $link . '" class="btn'.($class?' '.$class:'').'" '.($target?'target="'.$target.'"':'').'>' . $content . '</a>';
}
add_shortcode("button", "content_btn");

//custom SEO title
function seo_title(){
    global $post;
    if(!defined('WPSEO_VERSION')) {
        if(is_404()) {
            echo '404 Page not found - ';
        } elseif((is_single() || is_page()) && $post->post_parent) {
            $parent_title = get_the_title($post->post_parent);
            echo wp_title('-', true, 'right') . $parent_title.' - ';
        } elseif(class_exists('Woocommerce') && is_shop()) {
            echo get_the_title(SHOP_ID) . ' - ';
        } else {
            wp_title('-', true, 'right');
        }
        bloginfo('name');
    } else {
        wp_title();
    }
}

/* Update wp-scss setings
   ========================================================================== */
if (class_exists('Wp_Scss_Settings')) {
    $wpscss = get_option('wpscss_options');
    if (empty($wpscss['css_dir']) && empty($wpscss['scss_dir'])) {
        update_option('wpscss_options', array('css_dir' => '/style/', 'scss_dir' => '/style/', 'compiling_options' => 'scss_formatter_compressed'));
    }
}

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function wpa_fix_svg_thumb() {
    echo '<style>td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail {width: 100% !important;height: auto !important}</style>';
}
add_action('admin_head', 'wpa_fix_svg_thumb');

// Contact form 7 remove AUTOTOP
if(defined('WPCF7_VERSION')) {
    function maybe_reset_autop( $form ) {
        $form_instance = WPCF7_ContactForm::get_current();
        $manager = WPCF7_ShortcodeManager::get_instance();
        $form_meta = get_post_meta( $form_instance->id(), '_form', true );
        $form = $manager->do_shortcode( $form_meta );
        $form_instance->set_properties( array(
            'form' => $form
        ) );
        return $form;
    }
    add_filter( 'wpcf7_form_elements', 'maybe_reset_autop' );
}

/* ACF Repeater Styles */
function acf_repeater_even() {
    $scheme = get_user_option( 'admin_color' );
    $color = '';
    if($scheme == 'fresh') {
        $color = '#0073aa';
    } else if($scheme == 'light') {
        $color = '#d64e07';
    } else if($scheme == 'blue') {
        $color = '#52accc';
    } else if($scheme == 'coffee') {
        $color = '#59524c';
    } else if($scheme == 'ectoplasm') {
        $color = '#523f6d';
    } else if($scheme == 'midnight') {
        $color = '#e14d43';
    } else if($scheme == 'ocean') {
        $color = '#738e96';
    } else if($scheme == 'sunrise') {
        $color = '#dd823b';
    }
    echo '<style>.acf-repeater > table > tbody > tr:nth-child(even) > td.order {color: #fff !important;background-color: '.$color.' !important; text-shadow: none}.acf-fc-layout-handle {color: #fff !important;background-color: #23282d!important; text-shadow: none}</style>';
}
add_action('admin_footer', 'acf_repeater_even');

add_action('wp_head', 'ajax_url');
function ajax_url() {
    echo '<script type="text/javascript">var ajax_url="' . admin_url('admin-ajax.php') . '";</script>';
}

function wpa_fontbase64($fonthash) {
    $font = get_stylesheet_directory() . '/style/fonts.css';
    $md5 = filemtime( $font );
    $md5_cached = get_transient('fonts64_md5');
    if( $md5_cached !== $md5 ) {
        set_transient( 'fonts64_md5', $md5, 168 * 3600 );
    }
    if($fonthash) {
        echo $md5_cached?$md5_cached:$md5;
    } else {
        $minfont = file_get_contents( $font );
        $minfont = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $minfont);
        $minfont = str_replace(array(': ',' : '), ':', $minfont);
        $minfont = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $minfont);
        $minfont = str_replace(';}','}', $minfont);
        $fontpack = array(
            'md5'      => $md5_cached,
            'value'    => $minfont
        );
        echo json_encode($fontpack);
        exit;
    }
}
add_action('wp_ajax_wpa_fontbase64', 'wpa_fontbase64');
add_action('wp_ajax_nopriv_wpa_fontbase64', 'wpa_fontbase64');

function cats($pid){
    $post_categories = wp_get_post_categories($pid);
    $cats = '';
    $co = count($post_categories); $i = 1;
    foreach($post_categories as $c){
        $cat = get_category($c);
        $cats .= '<a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a>' .($i++ != $co?'<span>,</span> ':'');
    }
    return $cats;
}

add_theme_support('custom-logo');

/*//remove p tag > image
function filter_ptags_on_images($content){
    return preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '\1', $content);
}
add_filter('the_content', 'filter_ptags_on_images');*/

/*add_theme_support("woocommerce");
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
// Remove the sorting dropdown from Woocommerce
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_catalog_ordering', 30 );
// Remove the result count from WooCommerce
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );*/
