<?php

/**
* Initial setup and constants
*/

function pm_setup() {

  // Make theme available for translation
  load_theme_textdomain('purism', get_template_directory() . '/lang');

  // Enable support for Post Thumbnails on posts and pages
  add_theme_support('post-thumbnails');

  // et WordPress manage the document title
  add_theme_support('title-tag');

  // Add HTML5 markup for captions
  add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

  // Add default posts and comments RSS feed links to head
  add_theme_support('automatic-feed-links');

  // Add post formats
  add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio') );


  // Register Nav Menu
  register_nav_menus( array(
    'primary'     => esc_html__( 'Primary', 'purism' ),
    'footer_menu' => esc_html__( 'Footer', 'purism' ),
    )
  );

  // Add custom image sizes
  add_image_size( 'pm-fullwidth-thumb', 1800, '', false );
  add_image_size( 'pm-full-thumb', 1170, '', false );
  add_image_size( 'pm-large-thumb', 600, 400, true );
  add_image_size( 'pm-small-thumb', 320, 240, true );

  // Add theme support for selective refresh for widgets.
  add_theme_support( 'customize-selective-refresh-widgets' );

  // Add woocommerce support
  add_theme_support( 'woocommerce' );

  // Add woocommerce theme support product zoom and slider
  add_theme_support( 'wc-product-gallery-zoom' );
  add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'pm_setup' );


/**
* Add new size to media image size dropdown
*/

function pm_image_size_choose( $sizes ) {
  $addsizes = array(
    'pm-large-thumb' => esc_html__('Grid Thumbnail','purism'),
  );
  $newsizes = array_merge( $sizes, $addsizes );
  return $newsizes;
}

add_filter( 'image_size_names_choose', 'pm_image_size_choose' );

/*
* Kirki
*/

// Options
function pm_kirki_update_url( $config ) {
  $config['logo_image']     = get_template_directory_uri() . '/dist/images/logo_customizer.png';
  $config['description']    = esc_html__( 'The Ultimate Wordpress Blog Theme', 'purism' );
  $config['disable_loader'] = true;
  $config['url_path']       = get_template_directory_uri() . '/inc/kirki/';
  return $config;
}
add_filter( 'kirki/config', 'pm_kirki_update_url' );

// Register Theme Mods
Kirki::add_config( 'pm_theme_mod', array(
  'capability'    => 'edit_theme_options',
  'option_type'   => 'theme_mod',
));

// Add Custom CSS after Kirki inline styles
function pm_custom_css( $css ) {
  $custom_css = get_theme_mod( 'pm_css', '' );
  return $css . $custom_css;
}
add_filter( 'kirki/pm_theme_mod/dynamic_css', 'pm_custom_css' );

/**
* Register widget area.
*/

function pm_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'purism' ),
    'id'            => 'sidebar-1',
    'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'purism' ),
    'before_widget' => '<div class="widget-wrapper"><section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section></div>',
    'before_title'  => '<div class="widget-title-wrapper"><h2 class="widget-title"><span>',
    'after_title'   => '</span></h2></div>',
    )
  );

  register_sidebar( array(
    'name'          => esc_html__('Shop Sidebar', 'purism'),
    'id'            => 'sidebar-2',
    'description'   => esc_html__( 'Add widgets here to appear in your shop sidebar.', 'purism' ),
    'before_widget' => '<div class="widget-wrapper"><section class="widget %1$s %2$s">',
    'after_widget'  => '</section></div>',
    'before_title'  => '<div class="widget-title-wrapper"><h2 class="widget-title"><span>',
    'after_title'   => '</span></h2></div>'
  ));
}
add_action( 'widgets_init', 'pm_widgets_init' );


/**
* Include and register widgets
*/

function pm_register_widgets() {
  $pm_widgets = array(
    'recent_posts'  => 'pm_recent_posts',
    'popular_posts' => 'pm_popular_posts',
    'facebook'      => 'pm_facebook',
    'teaser'        => 'pm_teaser',
    'social'        => 'pm_social',
    'subscribe'     => 'pm_subscribe',
    'sponsored'     => 'pm_sponsored',
  );

  foreach ( $pm_widgets as $key => $value ) {
    require_once get_template_directory() .'/inc/widgets/'. sanitize_key( $key ) .'.php';
    register_widget( $value );
  }
}
add_action( 'widgets_init', 'pm_register_widgets' );

/**
* Remove Cutomizer Sections
*/

function pm_register_theme_customizer( $wp_customize ) {
  $wp_customize->remove_section( 'nav');
  $wp_customize->remove_section( 'static_front_page');
  $wp_customize->remove_section( 'colors');
  $wp_customize->remove_section( 'background_image');
  $wp_customize->remove_section( 'custom_css' );
}
add_action( 'customize_register', 'pm_register_theme_customizer' );

/**
* Set Default Content Width
*/

if ( ! isset( $content_width ) ) {
  $content_width = 1170;
}

/**
* Set Excerpt more dots
*/

function pm_excerpt_more( $more ) {
  return '...';
}
add_filter('excerpt_more', 'pm_excerpt_more');

/**
* Limited Excerpt length
*/

function pm_excerpt_length( $length ) {
  return get_theme_mod( 'pm_excerpt_length', 30 );
}

add_filter( 'excerpt_length', 'pm_excerpt_length', 999 );

/**
* Read More Link
*/

function pm_content_more_link() {
  return '<a class="btn btn-color" href="' . esc_url( get_permalink() ) . '">' . esc_html__( 'Read more', 'purism' ) . '</a>';
}

add_filter( 'the_content_more_link', 'pm_content_more_link' );

/**
* Rearrange Comment Fields
*/

function pm_rearrange_comment_field( $fields ) {
  $comment_field = $fields['comment'];
  unset( $fields['comment'] );
  $fields['comment'] = $comment_field;
  return $fields;
}

add_filter( 'comment_form_fields', 'pm_rearrange_comment_field' );

/**
* Adding body class to home page
*/

function pm_custom_body_class( $classes ) {
  $menu_sticky 				   = get_theme_mod( 'pm_effects_menu_sticky', true );
  $lazy_load_effect 	   = get_theme_mod( 'pm_effects_lazy_load', true );
  $default_logo_header	 = get_template_directory_uri() . '/dist/images/logo-purism-header.png';
  $header_logo 					 = get_theme_mod( 'pm_header_logo', $default_logo_header );
  $header_desktop				 = get_theme_mod( 'pm_header_desktop', true );
  $header_logo_slogan 	 = get_theme_mod( 'pm_header_logo_slogan', get_bloginfo( 'description' ) );
  $sticky_navbar_logo		 = get_theme_mod( 'pm_sticky_navbar_logo', 'sticky' );
  $default_logo 				 = get_template_directory_uri() . '/dist/images/logo-purism.png';
  $header_navbar_logo 	 = get_theme_mod( 'pm_navbar_logo', $default_logo );
  $menu_search 					 = get_theme_mod( 'pm_header_search', true );
  $layout_featured_promo = get_theme_mod( 'pm_layout_promo_featured' , 'fullwidth' );
  $content_features 		 = get_theme_mod( 'pm_blog_order' , array( 'featured_promo', 'newsletter', 'popular', 'posts' ) );
  $pm_popular_posts 	   = get_post_meta( get_the_ID(), 'pm_field_popular', true );
  $promo	= get_theme_mod( 'pm_promo', false );
  if( $header_logo !== '' || $header_logo_slogan !== '' ) {
    $classes[] = 'header-mobile';
  }

  if( is_rtl() ) {
    $classes[] = 'rtl';
  } else {
    $classes[] = 'ltr';
  }

  if( $header_desktop	 ) {
    $classes[] = 'header-desktop';
  }

  if ( $menu_sticky ) {
    $classes[] = 'sticky-effect';
  }

  if ( ( is_home() || is_archive() ) && $lazy_load_effect ) {
    $classes[] = 'lazy-load-effect';
  }

  if ( $sticky_navbar_logo == 'sticky' ) {
    $classes[] = 'logo-sticky';
  }

  if ( is_home() && $content_features[0] == 'featured_promo' && $layout_featured_promo == 'fullwidth' && !$promo ) {
    $classes[] = 'fw-slider-first';
  }

  if ( $pm_popular_posts == 'top' && is_page() ) {
    $classes[] = 'popular-post-top';
  }

  return $classes;
}

add_filter( 'body_class', 'pm_custom_body_class' );

/**
 * Add search box to primary menu
 */

function pm_nav_search($items, $args) {

    $menu_search = get_theme_mod( 'pm_header_search', true );
    if( !($args->theme_location == 'primary') || !$menu_search )
    return $items;
    // Otherwise, add search form
    return $items . '<li class="nav-search"><a class="open-search-overlay">' . esc_html__( 'Search', 'purism' ) . '</a></li>';
}

add_filter('wp_nav_menu_items', 'pm_nav_search', 10, 2);

/**
* Change Woocommerce Paypal Image
*/

function pm_paypal_checkout_icon() {
  return get_template_directory_uri() . '/dist/images/paypal.png';
}

add_filter( 'woocommerce_paypal_icon', 'pm_paypal_checkout_icon' );
