<?php
/**
 * Initialize infinitano theme functions
 * Callbacks and main function declarations
 */


if ( ! isset($content_width) ) $content_width = 1100;

/* Function to show Read More link instead of [..] */
function infinitano_new_excerpt_more ($more)
{
    return '...<br><br><a class="btn btn-danger" href="'
    . get_permalink(get_the_ID()) . '">Read More <i class="fa fa-angle-right"></i></a>';
}

add_filter('excerpt_more', 'infinitano_new_excerpt_more');
function infinitano_remove_more_link_scroll ($link)
{
    $link = preg_replace('|#more-[0-9]+|', '', $link);

    return $link;
}

add_filter('the_content_more_link', 'infinitano_remove_more_link_scroll');

/**
 * Post styling section starts below.
 * All functions related to posts written here.
 */

/* Apply class to post links to show as buttons */
function infinitano_posts_link_attributes ()
{
    return 'class="btn btn-danger"';
}

add_filter('next_posts_link_attributes', 'infinitano_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'infinitano_posts_link_attributes');


/* Comments template */
/**
 * @param $comment
 * @param $args
 * @param $depth
 */
function infinitano_comments ($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" style="position:relative;">
        <div class="comment-author vcard">
            <?php echo get_avatar($comment->comment_author_email, 80); ?>
            <?php printf(__('<span class="fn">By %s</span>', 'infinitano'), get_comment_author_link()) ?>
        </div>
        <div class="comment_text_area">
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <em><?php _e('Your comment is awaiting moderation.', 'infinitano') ?></em>
                <br />
            <?php endif; ?>
            <div class="comment-meta">
                <?php edit_comment_link(__('(Edit)', 'infinitano'), '  ', '') ?>
            </div>
            <div class="commentmetadata">
                <?php comment_text() ?>
            </div>
            <p class="reply">
                <time><i class="fa fa-clock-o text-danger"></i>
                    on <?php comment_date(); ?></time> <?php
                comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </p>
        </div>
    </div>
    </li><?php
}


function infinitano_setup ()
{


    /**
     * Menu section starts here.
     * All functions related to menu written here.
     */


    /* Infinitano Menus Section */
    // Provide two menu locations
    register_nav_menus(array(
        'left-menu'  => 'Header Left Menu',
        'right-menu' => 'Header Right Menu'
    ));

    /* Add custom logo support to theme */
    $infinitano_headerargs = array(
        'width'         => 438,
        'height'        => 131,
        'default-image' => get_template_directory_uri() . '/images/header.png',
        'uploads'       => true,
        'header-text'   => false
    );
    add_theme_support('custom-header', $infinitano_headerargs);


    /**
     * Sidebar functions start here.
     */

    register_sidebar(array(
        'name'          => 'Sidebar',
        'before_widget' => '<li class="widget widget-sidebar">',
        'after_widget'  => '</li>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));

    /**
     * Other theme functions written here.
     */

    /* Custom background support */
    $infinitano_background_defaults = array(
        'default-color' => '222',
        'default-image' => false
    );
    add_theme_support('custom-background', $infinitano_background_defaults);

    /* Automatic feed links support */
    add_theme_support('automatic-feed-links');

    /* HTML5 support */
    add_theme_support('html5', array(
        'comment-list',
        'comment-form',
        'search-form'
    ));

    /* Post Thumbnails support */
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(140);

    /* Admin bar */


}

/**
 * Edit Title Output
 *
 * @param $wp_title
 *
 * @return string|void
 */
function infinitano_title ($wp_title)
{
    if ( empty($wp_title) ) {
        $wp_title = bloginfo('title');

        return $wp_title;
    } else {
        return bloginfo('title') . $wp_title;
    }
}

function infinitano_scripts ()
{
    wp_enqueue_style('bootstrap', get_template_directory_uri() .
        '/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap-theme', get_template_directory_uri() .
        '/css/bootstrap-theme.min.css');
    wp_enqueue_style('font-awesome', get_template_directory_uri() .
        '/css/font-awesome.min.css');
    wp_enqueue_style('stylesheet-main', get_stylesheet_uri());

    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() .
        '/js/bootstrap.min.js');
}

wp_enqueue_scripts();
add_action('wp_enqueue_scripts', 'infinitano_scripts');

/**
 * Add filter to title output
 */
add_filter('wp_title', 'infinitano_title');

/**
 * Call to setup after initializing.
 */
add_action('after_setup_theme', 'infinitano_setup');




/* Show left menu function */
function infinitano_left_menu ()
{
    $infinitano_leftargs = array(
        'theme_location' => 'left-menu',
        'fallback_cb'    => 'infinitano_left_menu_fallback',
        'items_wrap'     => '<ul class="nav nav-justified navtop">%3$s</ul>'
    );
    wp_nav_menu($infinitano_leftargs);
}

/* Fallback for left menu */
function infinitano_left_menu_fallback ()
{
    add_filter('wp_page_menu', 'infinitano_menu_part1');
    wp_page_menu('show_home=Home&menu_class=');
}

/* Menu splitter left */
$infinitano_originalmenu; // to preserve original menu;
function infinitano_menu_part1 ($wpmenu)
{
    global $infinitano_originalmenu;
    $infinitano_originalmenu = $wpmenu;
    preg_match('/((<li[^>]+)><a+([^>]+)>+([^<]+)<\/a><\/li>)+/i', $wpmenu, $matches);
    $matches = explode('</li>', $matches[0]);
    foreach ( $matches as $k => $v ):
        if ( empty($v) ):
            unset($matches[$k]);
        else:
            $matches[$k] = $matches[$k] . '</li>';
        endif;
    endforeach;
    if ( count($matches) % 2 == 0 ):
        $part1 = (count($matches) / 2);
        $part2 = count($matches) - $part1;
    else:
        $part1 = ceil((count($matches) / 2));
        $part2 = count($matches) - $part1;
    endif;

    $wpmenu = '<ul class="nav nav-justified navtop">';
    for ( $i = 0; $i < $part1; $i ++ ):
        $wpmenu .= $matches[$i];
    endfor;
    $wpmenu .= '</ul>';

    return $wpmenu;
}

/* Menu splitter right */
function infinitano_menu_part2 ($wpmenu)
{
    global $infinitano_originalmenu;
    $wpmenu = $infinitano_originalmenu;
    preg_match('/((<li[^>]+)><a+([^>]+)>+([^<]+)<\/a><\/li>)+/i', $wpmenu, $matches);
    $matches = explode('</li>', $matches[0]);
    foreach ( $matches as $k => $v ):
        if ( empty($v) ):
            unset($matches[$k]);
        else:
            $matches[$k] = $matches[$k] . '</li>';
        endif;
    endforeach;
    if ( count($matches) % 2 == 0 ):
        $part1 = (count($matches) / 2);
        $part2 = count($matches) - $part1;
    else:
        $part1 = ceil((count($matches) / 2));
        $part2 = count($matches) - $part1;
    endif;

    $wpmenu = '<ul class="nav nav-justified navtop">';
    for ( $i = $part1; $i < count($matches); $i ++ ):
        $wpmenu .= $matches[$i];
    endfor;
    $wpmenu .= '</ul>';

    return $wpmenu;
}


/* Show right menu function */
function infinitano_right_menu ()
{
    $infinitano_rightargs = array(
        'theme_location' => 'right-menu',
        'fallback_cb'    => 'infinitano_right_menu_fallback',
        'items_wrap'     => '<ul class="nav nav-justified navtop">%3$s</ul>'
    );
    wp_nav_menu($infinitano_rightargs);
}

/* Fallback for right menu */
function infinitano_right_menu_fallback ()
{
    add_filter('wp_page_menu', 'infinitano_menu_part2');
    wp_page_menu('show_home=Home&menu_class=');
}



/* Tablet specific menu */
function infinitano_menu_restore ($wpmenu)
{
    global $infinitano_originalmenu;

    return $infinitano_originalmenu;
}

function infinitano_tablet_menu ()
{
    add_filter('wp_page_menu', 'infinitano_menu_restore');
    if ( has_nav_menu('left-menu') || has_nav_menu('right-menu') ):
        echo '<ul class="nav nav-justified navtop">';
        $leftargs = array(
            'theme_location' => 'left-menu',
            'container'      => false,
            'fallback_cb'    => false,
            'items_wrap'     => '%3$s'
        );
        wp_nav_menu($leftargs);
        $rightargs = array(
            'theme_location' => 'right-menu',
            'container'      => false,
            'fallback_cb'    => false,
            'items_wrap'     => '%3$s'
        );
        wp_nav_menu($rightargs);
        echo '</ul>';
    else:
        wp_page_menu('show_home=Home&menu_class=');
    endif;
}

/* Phone specific menu */
function infinitano_phone_menu ()
{
    add_filter('wp_page_menu', 'infinitano_menu_restore');
    if ( has_nav_menu('left-menu') || has_nav_menu('right-menu') ):
        $leftargs = array(
            'theme_location' => 'left-menu',
            'container'      => false,
            'fallback_cb'    => false,
            'items_wrap'     => '%3$s'
        );
        wp_nav_menu($leftargs);
        $rightargs = array(
            'theme_location' => 'right-menu',
            'container'      => false,
            'fallback_cb'    => false,
            'items_wrap'     => '%3$s'
        );
        wp_nav_menu($rightargs);
    else:
        wp_page_menu('show_home=Home&menu_class=');
    endif;
}


/* Add style classes to menus */
function infinitano_add_menuclass ($ulclass)
{
    return preg_replace('/<ul>/', '<ul id="nav" class="nav nav-justified navtop">', $ulclass, 1);
}
add_filter('wp_page_menu', 'infinitano_add_menuclass');


/**
 * Logo customization functions here.
 */
function infinitano_logo ()
{
    $header_image = get_header_image();
    if ( ! empty($header_image) ): ?>
        <img src="<?php header_image(); ?>" alt="" class="img-rounded"
             style="max-width:100%;height:auto;" />
    <?php
    else:
        echo "<h2>" . get_bloginfo('name') . "</h2>";
        echo "<p class='desc'>" . get_bloginfo('description') . "</p>";
    endif;
}

