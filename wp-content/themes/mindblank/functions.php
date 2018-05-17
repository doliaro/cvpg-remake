<?php
/**
 * Author: Mindshare Labs | @mindsharelabs
 * URL: https://mind.sh/are | @mindblank
 *
 */
date_default_timezone_set('America/Denver');

/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

include_once 'inc/content-functions.php';
include_once 'inc/cpt.php';
include_once 'inc/acf-functions.php';
include_once 'inc/aq_resize.php';
include_once 'inc/recalculate-acf-locations.php';

/*------------------------------------*\
    Theme Support
\*------------------------------------*/

if (!isset($content_width)) {
    $content_width = 900;
}

if (function_exists('add_theme_support')) {

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Enable mind support
    add_theme_support('mind', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

    // Localisation Support
    load_theme_textdomain('mindblank', get_template_directory() . '/languages');
}

/*------------------------------------*\
    Functions
\*------------------------------------*/

function mapi_var_dump($var)
{
    if (current_user_can('administrator') && isset($var)) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }
}

// mind Blank navigation
function cvpg_nav()
{
    wp_nav_menu(
        array(
            'theme_location' => 'header-menu',
            'menu' => '',
            'container' => 'div',
            'container_class' => 'menu-{menu slug}-container',
            'container_id' => '',
            'menu_class' => 'menu',
            'menu_id' => '',
            'echo' => true,
            'fallback_cb' => 'wp_page_menu',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'items_wrap' => '<ul id="menu">%3$s</ul>',
            'depth' => 2,
            'walker' => new Blankout_Menu_Walker()
        )
    );
}

// Load mind Blank scripts (header.php)
function mindblank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_register_script('mindblankscripts-min', get_template_directory_uri() . '/js/scripts.js', array('bootstrap', 'slick-slider'), '1.0.0', true);
        wp_enqueue_script('mindblankscripts-min');

        wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array('jquery'), '1.0.0');
        wp_enqueue_script('popper');

        wp_register_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery', 'popper'), '1.0.0');
        wp_enqueue_script('bootstrap');

        wp_register_script('fontawesome-5', get_template_directory_uri() . '/js/fontawesome-all.js', array(), '1.0', true);
        wp_enqueue_script('fontawesome-5');

        wp_register_script('slideout-js', get_template_directory_uri() . '/js/slideout.min.js', array(), '1.0');
        wp_enqueue_script('slideout-js');

        wp_register_script('slick-slider', get_template_directory_uri() . '/js/slick.min.js', array(), '1.0');
        wp_enqueue_script('slick-slider');

        wp_register_script('directory', get_template_directory_uri() . '/js/directory.js', array('jquery'), '1.0.0', false);
        wp_enqueue_script('directory');
    }
}

// Load mind Blank conditional scripts
function mindblank_conditional_scripts()
{
    // if (is_page_template('template-allscores.php')) {
    //     // Conditional script(s)
    //
    // }
}

// Load mind Blank styles
function mindblank_styles()
{
    wp_register_style('mindblankcssmin', get_template_directory_uri() . '/style.css', array(), '1.0');
    wp_enqueue_style('mindblankcssmin');

    wp_register_style('google-fonts', 'https://fonts.googleapis.com/css?family=Raleway:400,400i,500,900', array(), '1.0');
    wp_enqueue_style('google-fonts');

    wp_register_style('google-fonts', 'https://fonts.googleapis.com/css?family=Titillium+Web', array(), '1.0');
    wp_enqueue_style('google-fonts');

    wp_register_style('google-fonts', 'https://fonts.googleapis.com/css?family=Josefin+Sans', array(), '1.0');
    wp_enqueue_style('google-fonts');


}

// Register mind Blank Navigation
function register_mind_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'mindblank'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'mindblank'), // Sidebar Navigation
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// Remove the width and height attributes from inserted images
function remove_width_attribute($html)
{
    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
    return $html;
}


// If Dynamic Sidebar Exists
if (function_exists('register_sidebar')) {
    // Define Sidebar Widget Area 1

    register_sidebar(array(
        'name' => __('Widget Area 1', 'mindblank'),
        'description' => __('Widgets on all sub-pages', 'mindblank'),
        'id' => 'page-sidebar',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('Footer Widgets', 'mindblank'),
        'description' => __('Widgets in the footer', 'mindblank'),
        'id' => 'footer-widgets',
        'before_widget' => '<div id="%1$s" class="%2$s col-xs-12 col-md-3">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;

    if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
        remove_action('wp_head', array(
            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style'
        ));
    }
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function mindwp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'next_text' => '<i class="fas fa-angle-double-right"></i>',
        'prev_text' => '<i class="fas fa-angle-double-left"></i>',

    ));
}


// Create the Custom Excerpts callback
function mindwp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', 40);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

function lobob_excerpt_length($length)
{
    return 20;
}

add_filter('excerpt_length', 'lobob_excerpt_length', 999);


// Custom View Article link to Post
function mind_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'mindblank') . '</a>';
}


// Remove 'text/css' from our enqueued stylesheet
function mind_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions($html)
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function mindblankgravatar($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}



/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'mindblank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'mindblank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'mindblank_styles'); // Add Theme Stylesheet
add_action('init', 'register_mind_menu'); // Add mind Blank Menu

add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'mindwp_pagination'); // Add our mind Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'mindblankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'mind_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('style_loader_tag', 'mind_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('post_thumbnail_html', 'remove_width_attribute', 10); // Remove width and height dynamic attributes to post images
add_filter('image_send_to_editor', 'remove_width_attribute', 10); // Remove width and height dynamic attributes to post images
add_filter( 'facetwp_proximity_store_distance', '__return_true' ); // Enable post distance in FacetWP

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('mind_shortcode_demo', 'mind_shortcode_demo'); // You can place [mind_shortcode_demo] in Pages, Posts now.
add_shortcode('mind_shortcode_demo_2', 'mind_shortcode_demo_2'); // Place [mind_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [mind_shortcode_demo] [mind_shortcode_demo_2] Here's the page title! [/mind_shortcode_demo_2] [/mind_shortcode_demo]


/*------------------------------------*\
    ShortCode Functions
\*------------------------------------*/



/*------------------------------------*\
    ACF Functions
\*------------------------------------*/

function my_acf_init()
{

    acf_update_setting('google_api_key', 'AIzaSyAtGfWMP7UZ-0k3oPapHlWLEQkCbsmFno4');
}

add_action('acf/init', 'my_acf_init');

/*------------------------------------*\
    FaceWP Functions
\*------------------------------------*/
$params = array(
    'page' => 1,
    'per_page' => 10,
    'total_rows' => 205,
    'total_pages' => 21
);

add_filter( 'facetwp_pager_html', function( $output, $params ) {
    $output = '';

    if ( 1 < $params['total_pages'] ) {
        for ( $i = 1; $i <= $params['total_pages']; $i++ ) {
            $is_curr = ( $i === $params['page'] ) ? ' active' : '';
            $output .= '<a class="facetwp-page' . $is_curr . '" data-page="' . $i . '">' . $i . '</a>';
        }
    }

    return $output;
}, 10, 2 );

/*------------------------------------*\
    Nav Functions
\*------------------------------------*/

/**
 * nav.php
 *
 * @created   7/19/16 3:53 PM
 * @author    Mindshare Labs, Inc.
 * @copyright Copyright (c) 2006-2016
 * @link      https://mindsharelabs.com/
 */

/**
 * Changes the default behavior of Bootstrap dropdown nav menus
 * if the constant BOOTSTRAP_DROPDOWN_ON_HOVER is TRUE.
 */
function blankout_enable_nav_hover() {
    if (function_exists('mapi_is_mobile_device')) {
        if (!mapi_is_mobile_device() && BOOTSTRAP_DROPDOWN_ON_HOVER) : ?>
            <style type="text/css">
                ul.nav li.dropdown:hover ul.dropdown-menu {
                    display: block;
                    margin:  0;
                }

                a.menu:after, .dropdown-toggle:after {
                    content: none;
                }
            </style>
        <?php endif;
    }
}

/**
 * Adds a Bootstrap pager nav to various WP templates.
 */
function blankout_nav_above() {
    blankout_nav('above');
}

/**
 * Adds a Bootstrap pager nav to various WP templates.
 */
function blankout_nav_below() {
    blankout_nav();
}

/**
 * Adds a Bootstrap pager nav to various WP templates.
 *
 * @param string $position
 */
function blankout_nav($position = 'below') {
    ?>
    <div id="nav-<?php echo $position; ?>" class="<?php echo get_post_type(); ?>-navigation">
        <h5 class="sr-only"><?php echo ucwords(get_post_type()); ?><?php _e('navigation', 'blankout'); ?></h5>
        <ul class="pager">
            <?php if (is_singular()) : ?>
                <li class="nav-previous"><?php next_post_link('%link', '&lsaquo; %title', TRUE) ?></li>
                <li class="nav-next"><?php previous_post_link('%link', '%title &rsaquo;', TRUE) ?></li>
            <?php elseif (is_search()) : ?>
                <?php if (get_next_posts_link('Previous Results')) : ?>
                    <li class="nav-previous"><?php next_posts_link('Previous Results') ?></li>
                <?php endif; ?>
                <?php if (get_previous_posts_link('More Results')) : ?>
                    <li class="nav-next"><?php previous_posts_link('More Results') ?></li>
                <?php endif; ?>
            <?php else : ?>
                <?php if (get_next_posts_link('Previous Entries')) : ?>
                    <li class="nav-previous"><?php next_posts_link('Previous Entries') ?></li>
                <?php endif; ?>
                <?php if (get_previous_posts_link('Next Entries')) : ?>
                    <li class="nav-next"><?php previous_posts_link('Next Entries') ?></li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </div>
    <?php
}

/**
 * Adds a login/out link to a specific wp_nav_menu.
 *
 * @param $items string The menu HTML.
 * @param $args  object Menu settings object.
 * @usage <code>add_filter('wp_nav_menu_items', 'blankout_add_loginout_nav', 10, 2);</code>
 *
 * @return string
 */
function blankout_add_loginout_nav($items, $args) {

    $target_menu_slug = apply_filters('blankout_add_loginout_nav_slug', 'footer-nav');

    if ($args->menu && $args->menu == $target_menu_slug) {
        $items .= '<li id="menu-item-loginout" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-loginout">' . wp_loginout('', FALSE) . '</li>';
    }

    return $items;
}

add_filter('wp_nav_menu_items', 'blankout_add_loginout_nav', 10, 2);

if (!class_exists('Blankout_Menu_Walker')) {
    /**
     * Class Blankout_Menu_Walker
     */
    class Blankout_Menu_Walker extends Walker_Nav_Menu {

        /**
         * @see   Walker::start_lvl()
         * @since 3.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int    $depth  Depth of page. Used for padding.
         * @param array  $args
         */
        function start_lvl(&$output, $depth = 0, $args = array()) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
        }

        /**
         * @see      Walker::start_el()
         * @since    3.0.0
         *
         * @param string       $output Passed by reference. Used to append additional content.
         * @param object       $item   Menu item data object.
         * @param int          $depth  Depth of menu item. Used for padding.
         * @param array|object $args
         * @param int          $id
         *
         * @internal param int $current_page Menu item ID.
         */

        function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
            global $wp_query;
            $indent = ($depth) ? str_repeat("\t", $depth) : '';

            /**
             * Dividers & Headers
             * ==================
             * Determine whether the item is a Divider, Header, or regular menu item.
             * To prevent errors we use the strcasecmp() function to so a comparison
             * that is not case sensitive. The strcasecmp() function returns a 0 if
             * the strings are equal.
             */
            if (strcasecmp($item->title, 'divider') == 0) {
                // Item is a Divider
                $output .= $indent . '<li class="divider">';
            } else {
                if (strcasecmp($item->title, 'divider-vertical') == 0) {
                    // Item is a Vertical Divider
                    $output .= $indent . '<li class="divider-vertical">';
                } else {
                    if (strcasecmp($item->title, 'nav-header') == 0) {
                        // Item is a Header
                        $output .= $indent . '<li class="nav-header">' . esc_attr($item->attr_title);
                    } else {

                        $class_names = $value = '';
                        $classes = empty($item->classes) ? array() : (array) $item->classes;
                        $classes[] = ($item->current) ? 'active' : '';
                        $classes[] = 'menu-item-' . $item->ID;
                        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

                        if ($args->has_children && $depth > 0) {
                            $class_names .= ' dropdown-submenu';
                        } else {
                            if ($args->has_children && $depth === 0) {
                                $class_names .= ' dropdown';
                            }
                        }

                        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

                        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
                        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

                        $output .= $indent . '<li' . $id . $value . $class_names . '>';

                        $attributes = !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
                        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
                        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
                        $attributes .= ($args->has_children) ? ' data-toggle="dropdown" data-target="#" class="dropdown-toggle"' : '';

                        $item_output = $args->before;

                        /**
                         * Glyphicons
                         * ===========
                         * Since the the menu item is NOT a Divider or Header we check the see
                         * if there is a value in the attr_title property. If the attr_title
                         * property is NOT null we apply it as the class name for the glyphicon.
                         */
                        if (!empty($item->attr_title)) {
                            $item_output .= '<a' . $attributes . '><i class="' . esc_attr($item->attr_title) . '"></i>&nbsp;';
                        } else {
                            $item_output .= '<a' . $attributes . '>';
                        }

                        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
                        $item_output .= ($args->has_children && $depth == 0) ? ' <span class="caret"></span></a>' : '</a>';
                        $item_output .= $args->after;

                        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
                    }
                }
            }
        }

        /**
         * Traverse elements to create list from elements.
         * Display one element if the element doesn't have any children otherwise,
         * display the element and its children. Will only traverse up to the max
         * depth and no ignore elements under that depth.
         * This method shouldn't be called directly, use the walk() method instead.
         *
         * @see   Walker::start_el()
         * @since 2.5.0
         *
         * @param object $element           Data object
         * @param array  $children_elements List of elements to continue traversing.
         * @param int    $max_depth         Max depth to traverse.
         * @param int    $depth             Depth of current element.
         * @param array  $args
         * @param string $output            Passed by reference. Used to append additional content.
         *
         * @return null Null on failure with no changes to parameters.
         */

        function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output) {
            if (!$element) {
                return;
            }

            $id_field = $this->db_fields[ 'id' ];

            //display this element
            if (is_object($args[ 0 ])) {
                $args[ 0 ]->has_children = !empty($children_elements[ $element->$id_field ]);
            }

            parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
        }
    }
}

/**
 * Adds an CSS class 'active' to menu items.
 *
 * @param $classes
 * @param $item
 *
 * @return array
 */
function blankout_add_active_class($classes, $item) {
    if ($item->menu_item_parent == 0 && in_array('current-menu-item', $classes)) {
        $classes[] = "active";
    }

    return $classes;
}

add_filter('nav_menu_css_class', 'blankout_add_active_class', 10, 2);

