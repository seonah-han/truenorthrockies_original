<?php

/**
* Variables
*/

// Typography
$font_family_base       = 'Roboto';
$font_family_headings   = 'Roboto Condensed';

$font_size_base         = '13px';

$font_size_h1           = '33px';
$font_size_h2           = '27px';
$font_size_h3           = '23px';
$font_size_h4           = '19px';
$font_size_h5           = '16px';
$font_size_h6           = '13px';

$line_height_base       = '2';
$line_height_headings   = '1.4';
$transform_headings     = 'none';
$spacing_headings       = '0.02em';

$font_variant_base      = 'regular';
$font_variant_headings  = '700';

$subset                 = array( 'latin-ext' );

// Colors
$grey                   = '#333333';
$black                  = '#000000';
$primary                = '#000000';
$primary_hover          = '#333333';
$white                  = '#ffffff';
$grey_1                 = '#666666';
$grey_2                 = '#999999';
$grey_3                 = '#cccccc';
$grey_4                 = '#dddddd';

/**
* Typography
*/

Kirki::add_panel( 'typography', array(
  'title'       => esc_html__( 'Typography & Colors', 'purism' ),
  'priority'    => 1
));

/**
* Typography > General
*/

Kirki::add_section( 'typography_general', array(
  'title'       => esc_html__( 'General', 'purism' ),
  'panel'       => 'typography',
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_typography_background',
  'label'       => esc_html__( 'Background Color', 'purism' ),
  'section'     => 'typography_general',
  'choices'     => array(
    'color'     => esc_attr__( 'color', 'purism' ),
  ),
  'default'     => array(
    'color'     => '#f4f4f4',
  ),
  'output'      => array(
    array(
      'choice'    => 'color',
      'element'   => 'body',
      'property'  => 'background',
    ),
  ),
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'      => 'typography',
  'settings'  => 'pm_base_font',
  'label'     => esc_html__( 'Base Font', 'purism' ),
  'section'   => 'typography_general',
  'default'   => array(
    'font-family' => $font_family_base,
    'variant'     => $font_variant_base,
    'subsets'     => $subset,
  ),
  'output'    => array(
    array(
      'element'   => 'body, input, button',
    ),
  ),
  'priority'  => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'      => 'typography',
  'settings'  => 'pm_base_font_size',
  'label'     => esc_html__( 'Copy Text', 'purism' ),
  'section'   => 'typography_general',
  'default'   => array(
    'variant'     => $font_variant_base,
    'font-size'   => $font_size_base,
  ),
  'output'    => array(
    array(
      'element'   => 'p, ul, ol, table, address, fieldset .woocommerce table.wishlist_table, .woocommerce table.my_account_orders, .yith-wcwl-add-button a, .yith-wcwl-add-button span',
    ),
  ),
  'priority'  => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'pm_base_post_header',
  'label'       => esc_html__( 'Post Header Alignment', 'purism' ),
  'description' => esc_html__( 'Available for Standard, Grid and Masonry Layout', 'purism' ),
  'section'     => 'typography_general',
  'default'     => array(
    'variant'     => $font_variant_base,
    'text-align'  => 'center',
  ),
  'output'      => array(
    array(
      'element'   => '.post-header',
    ),
  ),
  'priority'    => 4,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'pm_base_excerpt',
  'label'       => esc_html__( 'Excerpt Alignment', 'purism' ),
  'description' => esc_html__( 'Available for Standard, Grid and Masonry Layout', 'purism' ),
  'section'     => 'typography_general',
  'default'     => array(
    'variant'     => $font_variant_base,
    'text-align'  => 'center',
  ),
  'output'      => array(
    array(
      'element'   => '.post-excerpt',
    ),
  ),
  'priority'    => 5,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'pm_base_post_tags',
  'label'       => esc_html__( 'Post Tags Alignment', 'purism' ),
  'section'     => 'typography_general',
  'default'     => array(
    'variant'     => $font_variant_base,
    'text-align'  => 'center',
  ),
  'output'      => array(
    array(
      'element'   => '.post-tags, .post-nav',
    ),
  ),
  'priority'    => 6,
));

/**
* Typography > Headings
*/

Kirki::add_section( 'typography_headings', array(
  'title'       => esc_html__( 'Headings', 'purism' ),
  'panel'       => 'typography',
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'pm_typography_h1',
  'label'       => esc_html__( 'Heading 1', 'purism' ),
  'section'     => 'typography_headings',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => $font_variant_headings,
    'subsets'        => $subset,
    'font-size'      => $font_size_h1,
    'line-height'    => $line_height_headings,
    'letter-spacing' => $spacing_headings,
    'text-transform' => $transform_headings,
    'color'          => $black,
  ),
  'output'      => array(
    array(
      'element' => 'h1',
    ),
  ),
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'pm_typography_h2',
  'label'       => esc_html__( 'Heading 2', 'purism' ),
  'section'     => 'typography_headings',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => $font_variant_headings,
    'subsets'        => $subset,
    'font-size'      => $font_size_h2,
    'line-height'    => $line_height_headings,
    'letter-spacing' => $spacing_headings,
    'text-transform' => $transform_headings,
    'color'          => $black,
  ),
  'output'      => array(
    array(
      'element' => 'h2',
    ),
  ),
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'pm_typography_h3',
  'label'       => esc_html__( 'Heading 3', 'purism' ),
  'section'     => 'typography_headings',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => $font_variant_headings,
    'subsets'        => $subset,
    'font-size'      => $font_size_h3,
    'line-height'    => $line_height_headings,
    'letter-spacing' => $spacing_headings,
    'text-transform' => $transform_headings,
    'color'          => $black,
  ),
  'output'      => array(
    array(
      'element' => 'h3',
    ),
  ),
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'pm_typography_h4',
  'label'       => esc_html__( 'Heading 4', 'purism' ),
  'section'     => 'typography_headings',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => $font_variant_headings,
    'subsets'        => $subset,
    'font-size'      => $font_size_h4,
    'line-height'    => $line_height_headings,
    'letter-spacing' => $spacing_headings,
    'text-transform' => $transform_headings,
    'color'          => $black,
  ),
  'output'      => array(
    array(
      'element' => 'h4',
    ),
  ),
  'priority'    => 4,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'pm_typography_h5',
  'label'       => esc_html__( 'Heading 5', 'purism' ),
  'section'     => 'typography_headings',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => $font_variant_headings,
    'subsets'        => $subset,
    'font-size'      => $font_size_h5,
    'line-height'    => $line_height_headings,
    'letter-spacing' => $spacing_headings,
    'text-transform' => $transform_headings,
    'color'          => $black,
  ),
  'output'      => array(
    array(
      'element' => 'h5, .woocommerce .product_list_widget > li > a:not(.remove), .woocommerce.product_list_widget > li > a:not(.remove)',
    ),
  ),
  'priority'    => 5,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'pm_typography_h6',
  'label'       => esc_html__( 'Heading 6', 'purism' ),
  'section'     => 'typography_headings',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => $font_variant_headings,
    'subsets'        => $subset,
    'font-size'      => $font_size_h6,
    'line-height'    => $line_height_headings,
    'letter-spacing' => $spacing_headings,
    'text-transform' => $transform_headings,
    'color'          => $black,
  ),
  'output'      => array(
    array(
      'element' => 'h6',
    ),
  ),
  'priority'    => 6,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_typography_heading_title_decor',
  'label'       => esc_html__( 'Heading Title Decor Color', 'purism' ),
  'section'     => 'typography_headings',
  'choices'     => array(
    'background'    => esc_attr__( 'border color', 'purism' ),
  ),
  'default'     => array(
    'background'    => $black,
  ),
  'output'      => array(
    array(
      'choice'    => 'background',
      'element'   => '.decor-title:after',
      'property'  => 'background',
    ),
  ),
  'priority'    => 7,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'pm_typography_slogan',
  'label'       => esc_html__( 'Slogan', 'purism' ),
  'section'     => 'typography_headings',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => $font_variant_base,
    'subsets'        => $subset,
    'font-size'      => '12px',
    'line-height'    => '1.4',
    'letter-spacing' => '0.3em',
    'color'          => $black,
    'text-transform' => 'uppercase',
  ),
  'output'      => array(
    array(
      'element' => '.header-title p',
    ),
  ),
  'priority'    => 8,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'pm_typography_title',
  'label'       => esc_html__( 'Feature Title', 'purism' ),
  'section'     => 'typography_headings',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => 'regular',
    'subsets'        => $subset,
    'font-size'      => $font_size_base,
    'line-height'    => '1.4',
    'letter-spacing' => '0.1em',
    'color'          => $black,
    'text-transform' => 'uppercase',
  ),
  'output'      => array(
    array(
      'element' => '.feature-title h2, .widget-title',
    ),
  ),
  'priority'    => 9,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_typography_feature_title_decor',
  'label'       => esc_html__( 'Feature Title Decor Color', 'purism' ),
  'section'     => 'typography_headings',
  'choices'     => array(
    'background'    => esc_attr__( 'border color', 'purism' ),
  ),
  'default'     => array(
    'background'    => $black,
  ),
  'output'      => array(
    array(
      'choice'    => 'background',
      'element'   => '.feature-title h2:after, .widget-title:after',
      'property'  => 'background',
    ),
  ),
  'priority'    => 10,
));

/**
* Typography > Menu
*/

Kirki::add_section( 'typography_menu', array(
  'title'       => esc_html__( 'Menu', 'purism' ),
  'panel'       => 'typography',
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'      => 'typography',
  'settings'  => 'pm_font_menu',
  'label'     => esc_html__( 'Menu Font', 'purism' ),
  'section'   => 'typography_menu',
  'default'   => array(
    'font-family'     => $font_family_headings,
    'variant'         => 'regular',
    'subsets'         => $subset,
    'font-size'       => '13px',
    'letter-spacing'  => '0.1em',
    'text-transform'  => 'uppercase',
  ),
  'output'    => array(
    array(
      'element'   => '.nav-menu .primary-menu li a, .footer-menu li a, .slicknav_nav a',
    ),
  ),
  'priority'  => 1,
));
Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_typography_main_menu_background',
  'label'       => esc_html__( 'Background Color', 'purism' ),
  'section'     => 'typography_menu',
  'choices'     => array(
    'color'     => esc_attr__( 'color', 'purism' ),
  ),
  'default'     => array(
    'color'     => $white,
  ),
  'output'      => array(
    array(
      'choice'    => 'color',
      'element'   => '.primary-nav',
      'property'  => 'background',
    ),
  ),
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_typography_main_submenu_background',
  'description' => esc_html__( 'Main Submenu', 'purism' ),
  'section'     => 'typography_menu',
  'choices'     => array(
    'color'     => esc_attr__( 'Color', 'purism' ),
  ),
  'default'     => array(
    'color'      => $grey_4,
  ),
  'output'      => array(
    array(
      'choice'    => 'color',
      'element'   => '.nav-menu ul.primary-menu ul a, .nav-menu .primary-menu ul ul a, .slicknav_nav',
      'property'  => 'background',
    ),
  ),
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'typography_main_menu_links',
  'label'       => esc_html__( 'Menu Link Color', 'purism' ),
  'description' => esc_html__( 'Main Menu', 'purism' ),
  'section'     => 'typography_menu',
  'choices'     => array(
    'normal'    => esc_attr__( 'normal', 'purism' ),
    'hover'     => esc_attr__( 'hover / current', 'purism' ),
  ),
  'default'     => array(
    'normal'    => $black,
    'hover'     => $black,
  ),
  'output'      => array(
    array(
      'choice'    => 'normal',
      'element'   => '.primary-menu > li > a',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.primary-menu > li > a:hover',
      'property'  => 'color',
    ),
  ),
  'priority'    => 4,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'typography_main_submenu_links',
  'description' => esc_html__( 'Main Submenu', 'purism' ),
  'section'     => 'typography_menu',
  'choices'     => array(
    'normal'    => esc_attr__( 'normal', 'purism' ),
    'hover'     => esc_attr__( 'hover / current', 'purism' ),
  ),
  'default'     => array(
    'normal'    => $black,
    'hover'     => $black,
  ),
  'output'      => array(
    array(
      'choice'    => 'normal',
      'element'   => '.nav-menu ul.primary-menu ul a, .nav-menu .primary-menu ul ul a, .slicknav_nav a',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.nav-menu ul.primary-menu ul a:hover, .nav-menu .primary-menu ul ul a:hover, .slicknav_nav a:hover',
      'property'  => 'color',
    ),
  ),
  'priority'    => 5,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'typography_footer_menu_links',
  'description' => esc_html__( 'Footer Menu', 'purism' ),
  'section'     => 'typography_menu',
  'choices'     => array(
    'normal'    => esc_attr__( 'normal', 'purism' ),
    'hover'     => esc_attr__( 'hover / current', 'purism' ),
  ),
  'default'     => array(
    'normal'    => $black,
    'hover'     => $black,
  ),
  'output'      => array(
    array(
      'choice'    => 'normal',
      'element'   => '.footer-menu li a',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.footer-menu li a:hover',
      'property'  => 'color',
    ),
  ),
  'priority'    => 6,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'typography_main_menu_active_border',
  'label'       => esc_html__( 'Menu Active Border Color', 'purism' ),
  'description' => esc_html__( 'Main Menu', 'purism' ),
  'section'     => 'typography_menu',
  'choices'     => array(
    'color'    => esc_attr__( 'color', 'purism' ),
  ),
  'default'     => array(
    'color'    => $black,
  ),
  'output'      => array(
    array(
      'choice'    => 'color',
      'element'   => '.nav-menu .primary-menu > li.current_page_item, .nav-menu .primary-menu > li.current-menu-item, .nav-menu .primary-menu > li:hover',
      'property'  => 'border-color',
    ),
  ),
  'priority'    => 7,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'typography_main_submenu_active_border',
  'description' => esc_html__( 'Main Submenu', 'purism' ),
  'section'     => 'typography_menu',
  'choices'     => array(
    'color'    => esc_attr__( 'color', 'purism' ),
  ),
  'default'     => array(
    'color'    => $black,
  ),
  'output'      => array(
    array(
      'choice'    => 'color',
      'element'   => '.nav-menu ul.primary-menu ul li.current_page_item a, .nav-menu .primary-menu ul ul li.current-menu-item a',
      'property'  => 'border-color',
    ),
  ),
  'priority'    => 8,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'typography_main_mobile_icon',
  'label'       => esc_html__( 'Menu Mobile Icon', 'purism' ),
  'section'     => 'typography_menu',
  'choices'     => array(
    'color'    => esc_attr__( 'color', 'purism' ),
  ),
  'default'     => array(
    'color'    => $black,
  ),
  'output'      => array(
    array(
      'choice'    => 'color',
      'element'   => '.slicknav_menu .slicknav_icon-bar',
      'property'  => 'background-color',
    ),
  ),
  'priority'    => 9,
));

/**
* Typography > Links & Buttons
*/

Kirki::add_section( 'typography_buttons_links', array(
  'title'       => esc_html__( 'Links & Buttons', 'purism' ),
  'panel'       => 'typography',
  'priority'    => 4,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_general_link',
  'label'       => esc_html__( 'Link Color', 'purism' ),
  'section'     => 'typography_buttons_links',
  'choices'     => array(
    'normal'    => esc_attr__( 'normal', 'purism' ),
    'hover'     => esc_attr__( 'hover', 'purism' ),
  ),
  'default'     => array(
    'normal'    => $black,
    'hover'     => $black,
  ),
  'output'      => array(
    array(
      'choice'    => 'normal',
      'element'   => 'a',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => 'a:hover',
      'property'  => 'color',
    ),
  ),
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_headings_link',
  'label'       => esc_html__( 'Headings Link Color', 'purism' ),
  'section'     => 'typography_buttons_links',
  'choices'     => array(
    'normal'    => esc_attr__( 'normal', 'purism' ),
    'hover'     => esc_attr__( 'hover', 'purism' ),
  ),
  'default'     => array(
    'normal'    => $black,
    'hover'     => $grey,
  ),
  'output'      => array(
    array(
      'choice'    => 'normal',
      'element'   => 'h1 a, h2 a, h2 a, h3 a, h4 a, h5 a, h6 a, .post-entry h1 a, .post-entry h2 a, .post-entry h3 a, .post-entry h4 a, .post-entry h5 a, .post-entry h6 a, .post-author-profile .author a, .woocommerce .product_list_widget > li > a:not(.remove), .woocommerce.product_list_widget > li > a:not(.remove)',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => 'h1 a:hover,
                      h2 a:hover,
                      h3 a:hover,
                      h4 a:hover,
                      h5 a:hover,
                      h6 a:hover,
                      .post-entry h1 a:hover,
                      .post-entry h2 a:hover,
                      .post-entry h3 a:hover,
                      .post-entry h4 a:hover,
                      .post-entry h5 a:hover,
                      .post-entry h6 a:hover,
                      .post-author-profile .author a:hover,
                      .woocommerce .product_list_widget > li > a:not(.remove):hover,
                      .woocommerce.product_list_widget > li > a:not(.remove):hover',
      'property'  => 'color',
    ),
  ),
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_nav_link',
  'label'       => esc_html__( 'Navigation Link Color', 'purism' ),
  'section'     => 'typography_buttons_links',
  'choices'     => array(
    'normal'    => esc_attr__( 'normal', 'purism' ),
    'hover'     => esc_attr__( 'hover', 'purism' ),
  ),
  'default'     => array(
    'normal'    => $black,
    'hover'     => $grey,
  ),
  'output'      => array(
    array(
      'choice'    => 'normal',
      'element'   => '.comment-navigation a, .post-entry .posts-navigation a, .posts-navigation a, .woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.comment-navigation a:hover,
                      .post-entry .posts-navigation a:hover,
                      .posts-navigation a:hover,
                      .woocommerce nav.woocommerce-pagination ul li a:hover,
                      .woocommerce nav.woocommerce-pagination ul li span:hover',
      'property'  => 'color',
    ),
  ),
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_icon_link',
  'label'       => esc_html__( 'Social Icons Link Color', 'purism' ),
  'section'     => 'typography_buttons_links',
  'choices'     => array(
    'normal'    => esc_attr__( 'normal', 'purism' ),
    'hover'     => esc_attr__( 'hover', 'purism' ),
  ),
  'default'     => array(
    'normal'    => $black,
    'hover'     => $grey,
  ),
  'output'      => array(
    array(
      'choice'    => 'normal',
      'element'   => '.widget .social-links a',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.widget .social-links a:hover',
      'property'  => 'color',
    ),
  ),
  'priority'    => 4,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_entry_link',
  'label'       => esc_html__( 'Post Entry Link Color', 'purism' ),
  'section'     => 'typography_buttons_links',
  'choices'     => array(
    'normal'    => esc_attr__( 'normal', 'purism' ),
    'hover'     => esc_attr__( 'hover', 'purism' ),
  ),
  'default'     => array(
    'normal'    => $primary,
    'hover'     => $primary_hover,
  ),
  'output'      => array(
    array(
      'choice'    => 'normal',
      'element'   => '.post-entry a',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.post-entry a:hover',
      'property'  => 'color',
    ),
  ),
  'priority'    => 5,
));


Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_btn_secondary_text_color',
  'label'       => esc_html__( 'Default Button Text Color', 'purism' ),
  'section'     => 'typography_buttons_links',
  'choices'     => array(
    'normal'    => esc_attr__( 'normal', 'purism' ),
    'hover'     => esc_attr__( 'hover', 'purism' ),
  ),
  'default'     => array(
    'normal'    => $black,
    'hover'     => $black,
  ),
  'output'      => array(
    array(
      'choice'    => 'normal',
      'element'   => '.btn.btn-default,
                      .comment-respond h3 small a,
                      .comments span.reply a,
                      .comments span.reply a,
                      .site-main input[type="submit"], .widget input[type="submit"],
                      .widget_calendar tbody td a,
                      .woocommerce-page a.button,
                      .woocommerce #respond input#submit,
                      .woocommerce a.button,
                      .woocommerce button.button,
                      .woocommerce input.button,
                      .woocommerce a.added_to_cart,
                      .woocommerce .widget_price_filter .price_slider_amount .button,
                      .woocommerce-account .addresses .title .edit',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.btn.btn-default:hover,
                      .comment-respond h3 small a:hover,
                      .comments span.reply a:hover,
                      .widget input[type="submit"]:hover,
                      .site-main input[type="submit"]:hover,
                      .widget_calendar tbody td a:hover,
                      .woocommerce-page a.button:hover,
                      .woocommerce #respond input#submit:hover,
                      .woocommerce a.button:hover,
                      .woocommerce button.button:hover,
                      .woocommerce input.button:hover,
                      .woocommerce a.added_to_cart:hover,
                      .woocommerce .widget_price_filter .price_slider_amount .button:hover,
                      .woocommerce-account .addresses .title .edit:hover',
      'property'  => 'color',
    ),
  ),
  'priority'    => 6,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_btn_secondary_bg_color',
  'label'       => esc_html__( 'Default Button Background Color', 'purism' ),
  'section'     => 'typography_buttons_links',
  'choices'     => array(
    'normal'    => esc_attr__( 'normal', 'purism' ),
    'hover'     => esc_attr__( 'hover', 'purism' ),
  ),
  'default'     => array(
    'normal'    => $grey_4,
    'hover'     => $grey_3,
  ),
  'output'      => array(
    array(
      'choice'    => 'normal',
      'element'   => '.btn.btn-default,
                      .comment-respond h3 small a,
                      .comments span.reply a,
                      .comments span.reply a,
                      .site-main input[type="submit"], .widget input[type="submit"],
                      .widget_calendar tbody td a,
                      .woocommerce-page a.button,
                      .woocommerce #respond input#submit,
                      .woocommerce a.button,
                      .woocommerce button.button,
                      .woocommerce input.button,
                      .woocommerce a.added_to_cart,
                      .woocommerce .widget_price_filter .price_slider_amount .button,
                      .woocommerce-account .addresses .title .edit',
      'property'  => 'background-color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.btn.btn-default:hover,
                      .comment-respond h3 small a:hover,
                      .comments span.reply a:hover,
                      .widget input[type="submit"]:hover,
                      .site-main input[type="submit"]:hover,
                      .widget_calendar tbody td a:hover,
                      .woocommerce-page a.button:hover,
                      .woocommerce #respond input#submit:hover,
                      .woocommerce a.button:hover,
                      .woocommerce button.button:hover,
                      .woocommerce input.button:hover,
                      .woocommerce a.added_to_cart:hover,
                      .woocommerce .widget_price_filter .price_slider_amount .button:hover,
                      .woocommerce-account .addresses .title .edit:hover',
      'property'  => 'background-color',
    ),
  ),
  'priority'    => 7,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_btn_primary_text_color',
  'label'       => esc_html__( 'Primary Button Text Color', 'purism' ),
  'section'     => 'typography_buttons_links',
  'choices'     => array(
    'normal'    => esc_attr__( 'normal', 'purism' ),
    'hover'     => esc_attr__( 'hover', 'purism' ),
  ),
  'default'     => array(
    'normal'    => $white,
    'hover'     => $white,
  ),
  'output'      => array(
    array(
      'choice'    => 'normal',
      'element'   => '.btn.btn-color, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .widget_shopping_cart .buttons a, .pm-dynamic-cart .widget_shopping_cart_content .buttons .button, .woocommerce .product-add-to-cart a.button, .woocommerce .product-add-to-cart a.added_to_cart, .woocommerce a.button.product_type_variation',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.btn.btn-color:hover,
                      .woocommerce #respond input#submit.alt:hover,
                      .woocommerce a.button.alt:hover,
                      .woocommerce button.button.alt:hover,
                      .woocommerce input.button.alt:hover,
                      .widget_shopping_cart .buttons a:hover,
                      .pm-dynamic-cart .widget_shopping_cart_content .buttons .button:hover,
                      .woocommerce .product-add-to-cart a.button:hover,
                      .woocommerce .product-add-to-cart a.added_to_cart:hover,
                      .woocommerce a.button.product_type_variation:hover',
      'property'  => 'color',
    ),
  ),
  'priority'    => 8,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_btn_primary_bg_color',
  'label'       => esc_html__( 'Primary Button Background Color', 'purism' ),
  'section'     => 'typography_buttons_links',
  'choices'     => array(
    'normal'    => esc_attr__( 'normal', 'purism' ),
    'hover'     => esc_attr__( 'hover', 'purism' ),
  ),
  'default'     => array(
    'normal'    => $primary,
    'hover'     => $primary_hover,
  ),
  'output'      => array(
    array(
      'choice'    => 'normal',
      'element'   => '.btn.btn-color, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .widget_shopping_cart .buttons a, .pm-dynamic-cart .widget_shopping_cart_content .buttons .button, .woocommerce .product-add-to-cart a.button, .woocommerce .product-add-to-cart a.added_to_cart, .woocommerce a.button.product_type_variation',
      'property'  => 'background-color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.btn.btn-color:hover,
                      .woocommerce #respond input#submit.alt:hover,
                      .woocommerce a.button.alt:hover,
                      .woocommerce button.button.alt:hover,
                      .woocommerce input.button.alt:hover,
                      .widget_shopping_cart .buttons a:hover,
                      .pm-dynamic-cart .widget_shopping_cart_content .buttons .button:hover,
                      .woocommerce .product-add-to-cart a.button:hover,
                      .woocommerce .product-add-to-cart a.added_to_cart:hover,
                      .woocommerce a.button.product_type_variation:hover',
      'property'  => 'background-color',
    ),
  ),
  'priority'    => 9,
));

/**
* Typography > Post Meta
*/

Kirki::add_section( 'typography_meta', array(
  'title'       => esc_html__( 'Meta', 'purism' ),
  'panel'       => 'typography',
  'priority'    => 5,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_typography_cat_color',
  'label'       => esc_html__( 'Category Link Color', 'purism' ),
  'section'     => 'typography_meta',
  'choices'     => array(
    'normal'    => esc_attr__( 'normal', 'purism' ),
    'hover'     => esc_attr__( 'hover', 'purism' ),
  ),
  'default'     => array(
    'normal'    => $grey_1,
    'hover'     => $grey_1,
  ),
  'output'      => array(
    array(
      'choice'    => 'normal',
      'element'   => '.post-category a, .post-category .separator',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.post-category a:hover',
      'property'  => 'color',
    ),
  ),
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_typography_posted_color',
  'label'       => esc_html__( 'Posted Link Color', 'purism' ),
  'section'     => 'typography_meta',
  'choices'     => array(
    'normal'    => esc_attr__( 'normal', 'purism' ),
    'hover'     => esc_attr__( 'hover', 'purism' ),
  ),
  'default'     => array(
    'normal'    => $grey_2,
    'hover'     => $grey_2,
  ),
  'output'      => array(
    array(
      'choice'    => 'normal',
      'element'   => '.posted-info a',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.posted-info a:hover',
      'property'  => 'color',
    ),
  ),
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_typography_meta_button_color',
  'label'       => esc_html__( 'Meta Buttons Color', 'purism' ),
  'section'     => 'typography_meta',
  'choices'     => array(
    'normal'    => esc_attr__( 'normal', 'purism' ),
    'hover'     => esc_attr__( 'hover', 'purism' ),
  ),
  'default'     => array(
    'normal'    => $grey,
    'hover'     => $grey,
  ),
  'output'      => array(
    array(
      'choice'    => 'normal',
      'element'   => '.post-meta a',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.post-meta a:hover',
      'property'  => 'color',
    ),
  ),
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_typography_meta_text_color',
  'label'       => esc_html__( 'Meta Text Color', 'purism' ),
  'section'     => 'typography_meta',
  'choices'     => array(
    'color'     => esc_attr__( 'color', 'purism' ),
  ),
  'default'     => array(
    'color'     => $grey,
  ),
  'output'      => array(
    array(
      'choice'    => 'color',
      'element'   => '.post-views, .post-likes, .post-share .title-share, .sl-like-text, .sl-like-text:hover',
      'property'  => 'color',
    ),
  ),
  'priority'    => 4,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_typography_tags_color',
  'label'       => esc_html__( 'Tags Text Color', 'purism' ),
  'section'     => 'typography_meta',
  'choices'     => array(
    'normal'    => esc_attr__( 'normal', 'purism' ),
    'hover'     => esc_attr__( 'hover', 'purism' ),
  ),
  'default'     => array(
    'normal'      => $black,
    'hover'       => $black,
  ),
  'output'      => array(
    array(
      'choice'    => 'normal',
      'element'   => '.post-tags a, .product-tags a, .widget .tagcloud a',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.product-tags a:hover,
                      .post-tags a:hover,
                      .widget .tagcloud a:hover',
      'property'  => 'color',
    ),
  ),
  'priority'    => 5,
));

/**
* Typography > Miscellaneous
*/

Kirki::add_section( 'typography_misc', array(
  'title'       => esc_html__( 'Miscellaneous', 'purism' ),
  'panel'       => 'typography',
  'priority'    => 6,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_typography_mark',
  'label'       => esc_html__( 'Mark', 'purism' ),
  'section'     => 'typography_misc',
  'choices'     => array(
    'background'  => esc_html__( 'color', 'purism' ),
  ),
  'default'     => array(
    'background'  => $primary,
  ),
  'output'      => array(
    array(
      'choice'    => 'background',
      'element'   => 'mark',
      'property'  => 'background-color',
    ),
  ),
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'pm_typography_blockquote',
  'label'       => esc_html__( 'Blockquote', 'purism' ),
  'section'     => 'typography_misc',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => 'regular',
    'subsets'        => $subset,
    'font-size'      => '18px',
    'line-height'    => '1.8',
    'letter-spacing' => '0.01em',
    'text-transform' => 'none',
  ),
  'output'      => array(
    array(
      'element'      => 'blockquote',
    ),
  ),
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'pm_typography_pop_search',
  'label'       => esc_html__( 'Popup Search Form', 'purism' ),
  'section'     => 'typography_misc',
  'default'     => array(
    'font-family'     => $font_family_headings,
    'variant'         => $font_variant_headings,
    'subsets'         => $subset,
    'text-transform'  => $transform_headings,
  ),
  'output'      => array(
    array(
      'element'   => '.nav-search .form-control',
    ),
  ),
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_typography_dropcaps_leadins_color',
  'label'       => esc_html__( 'Drop Caps & Lead ins', 'purism' ),
  'section'     => 'typography_misc',
  'choices'     => array(
    'color'  => esc_attr__( 'color', 'purism' ),
  ),
  'default'     => array(
    'color'  => $primary,
  ),
  'output'      => array(
    array(
      'choice'    => 'color',
      'element'   => '.lead.lead-color, .dc.dc-color:first-letter',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'color',
      'element'   => '.lead.lead-color, .dc.dc-color:first-letter',
      'property'  => 'border-color',
    ),
    array(
      'choice'    => 'color',
      'element'   => '.lead.lead-background.lead-color, .dc.dc-background.dc-color:first-letter',
      'property'  => 'background-color',
    ),
  ),
  'priority'    => 4,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_typography_cart_marker_color',
  'label'       => esc_html__( 'Icon Cart Marker', 'purism' ),
  'section'     => 'typography_misc',
  'choices'     => array(
    'background'  => esc_attr__( 'background', 'purism' ),
    'color'       => esc_attr__( 'font color', 'purism' ),
  ),
  'default'     => array(
    'background'  => $primary,
    'color'       => $white,
  ),
  'output'      => array(
    array(
      'choice'    => 'background',
      'element'   => '.cart-contents-count',
      'property'  => 'background-color',
    ),
    array(
      'choice'    => 'color',
      'element'   => '.cart-contents-count',
      'property'  => 'color',
    ),
  ),
  'priority'    => 5,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_typography_sale_marker_color',
  'label'       => esc_html__( 'Sale Marker', 'purism' ),
  'section'     => 'typography_misc',
  'choices'     => array(
    'background'  => esc_attr__( 'background', 'purism' ),
    'color'       => esc_attr__( 'font color', 'purism' ),
  ),
  'default'     => array(
    'background'  => $primary,
    'color'       => $white,
  ),
  'output'      => array(
    array(
      'choice'    => 'background',
      'element'   => '.woocommerce span.onsale',
      'property'  => 'background-color',
    ),
    array(
      'choice'    => 'color',
      'element'   => '.woocommerce span.onsale',
      'property'  => 'color',
    ),
  ),
  'priority'    => 6,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_typography_star_rating_color',
  'label'       => esc_html__( 'Star Rating', 'purism' ),
  'section'     => 'typography_misc',
  'choices'     => array(
    'background'  => esc_attr__( 'color', 'purism' ),
  ),
  'default'     => array(
    'background'  => $primary,
  ),
  'output'      => array(
    array(
      'choice'    => 'background',
      'element'   => '.woocommerce .star-rating::before, .woocommerce .star-rating, .woocommerce p.stars a::before',
      'property'  => 'color',
    ),
  ),
  'priority'    => 7,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_typography_price_filter_color',
  'label'       => esc_html__( 'Price Filter', 'purism' ),
  'section'     => 'typography_misc',
  'choices'     => array(
    'background' => esc_attr__( 'color', 'purism' ),
  ),
  'default'     => array(
    'background'  => $primary,
  ),
  'output'      => array(
    array(
      'choice'    => 'background',
      'element'   => '.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle',
      'property'  => 'background-color',
    ),
  ),
  'priority'    => 8,
));

/*
* Layout
*/

Kirki::add_panel( 'layout', array(
  'title'       => esc_html__( 'Layout', 'purism' ),
  'priority'    => 2,
));

/*
* Layout > General
*/

Kirki::add_section( 'layout_general', array(
  'title'       => esc_html__( 'General', 'purism' ),
  'panel'       => 'layout',
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_standard_post_embed',
  'label'       => esc_html__( 'Post Format Embed', 'purism' ),
  'description' => esc_html__( 'Option available for Standard Post.', 'purism' ),
  'section'     => 'layout_general',
  'default'     => true,
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'radio',
  'settings'    => 'pm_post_summary',
  'label'       => esc_html__( 'Post Summary', 'purism' ),
  'description' => esc_html__( 'Option available for Standard Posts.', 'purism' ),
  'section'     => 'layout_general',
  'default'     => 'excerpt',
  'choices'     => array(
    'excerpt'   => esc_attr__( 'Excerpt', 'purism' ),
    'content'   => esc_attr__( 'Content', 'purism' ),
  ),
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_excerpt',
  'label'       => esc_html__( 'Show Excerpt', 'purism' ),
  'section'     => 'layout_general',
  'default'     => true,
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'              => 'number',
  'settings'          => 'pm_excerpt_length',
  'label'             => esc_html__( 'Excerpt Length', 'purism' ),
  'description'       => esc_html__( 'Number of words in excerpt.', 'purism' ),
  'section'           => 'layout_general',
  'default'           => 30,
  'sanitize_callback' => 'absint',
  'priority'          => 4,
));

/**
* Layout > Blog Page
*/

Kirki::add_section( 'layout_blog', array(
  'title'       => esc_html__( 'Blog Page', 'purism' ),
  'panel'       => 'layout',
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'radio-image',
  'settings'    => 'pm_layout_blog',
  'label'       => esc_html__( 'Blog Page Layout', 'purism' ),
  'section'     => 'layout_blog',
  'default'     => 'standard',
  'choices'     => array(
    'standard'  => get_template_directory_uri() . '/dist/images/layout-standard.png',
    'list'      => get_template_directory_uri() . '/dist/images/layout-list.png',
    'chess'     => get_template_directory_uri() . '/dist/images/layout-list-chess.png',
    'grid'      => get_template_directory_uri() . '/dist/images/layout-grid.png',
    'masonry'   => get_template_directory_uri() . '/dist/images/layout-masonry.png',
  ),
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_layout_standard_blog',
  'label'       => esc_html__( 'First Standard Post', 'purism' ),
  'description' => esc_html__( 'Option available for list, grid and masonry layout.', 'purism' ),
  'section'     => 'layout_blog',
  'default'     => true,
  'active_callback' => array(
    array(
      'setting'  => 'pm_layout_blog',
      'operator' => '!=',
      'value'    => 'standard',
    )
  ),
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'select',
  'settings'    => 'pm_sidebar_blog',
  'label'       => esc_html__( 'Sidebar', 'purism' ),
  'section'     => 'layout_blog',
  'default'     => 'sidebar',
  'choices'     => array(
    'sidebar'       => esc_attr__( 'Sidebar', 'purism' ),
    'sidebar-shop'  => esc_attr__( 'Shop Sidebar', 'purism' ),
    'nosidebar'     => esc_attr__( 'No Sidebar', 'purism' ),
  ),
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'sortable',
  'settings'    => 'pm_blog_order',
  'label'       => esc_html__( 'Order', 'purism' ),
  'section'     => 'layout_blog',
  'default'     => array(
    'featured_promo',
    'newsletter',
    'popular',
    'posts',
  ),
  'choices'      => array(
    'featured_promo'  => esc_attr__( 'Featured Promo Area', 'purism' ),
    'newsletter'      => esc_attr__( 'Newsletter', 'purism' ),
    'popular'         => esc_attr__( 'Popular Posts', 'purism' ),
    'posts'           => esc_attr__( 'Blog Posts', 'purism' ),
  ),
  'priority'    => 4,
));

/**
* Layout > Archive
*/

Kirki::add_section( 'layout_archive', array(
  'title'       => esc_html__( 'Archive', 'purism' ),
  'panel'       => 'layout',
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'radio-image',
  'settings'    => 'pm_layout_archive',
  'label'       => esc_html__( 'Archive Layout', 'purism' ),
  'section'     => 'layout_archive',
  'default'     => 'standard',
  'choices'     => array(
    'standard'  => get_template_directory_uri() . '/dist/images/layout-standard.png',
    'list'      => get_template_directory_uri() . '/dist/images/layout-list.png',
    'chess'     => get_template_directory_uri() . '/dist/images/layout-list-chess.png',
    'grid'      => get_template_directory_uri() . '/dist/images/layout-grid.png',
    'masonry'   => get_template_directory_uri() . '/dist/images/layout-masonry.png',
  ),
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'            => 'toggle',
  'settings'        => 'pm_layout_standard_archive',
  'label'           => esc_html__( 'First Standard Post', 'purism' ),
  'description'     => esc_html__( 'Option available for list, grid and masonry layout.', 'purism' ),
  'section'         => 'layout_archive',
  'default'         => true,
  'active_callback' => array(
    array(
      'setting'     => 'pm_layout_archive',
      'operator'    => '!=',
      'value'       => 'standard',
    )
  ),
  'priority'        => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'select',
  'settings'    => 'pm_sidebar_archive',
  'label'       => esc_html__( 'Sidebar', 'purism' ),
  'section'     => 'layout_archive',
  'default'     => 'sidebar',
  'choices'     => array(
    'sidebar'       => esc_attr__( 'Sidebar', 'purism' ),
    'sidebar-shop'  => esc_attr__( 'Shop Sidebar', 'purism' ),
    'nosidebar'     => esc_attr__( 'No Sidebar', 'purism' ),
  ),
  'priority'    => 3,
));

/**
* Layout > Shop
*/

Kirki::add_section( 'layout_shop', array(
  'title'       => esc_html__( 'Shop', 'purism' ),
  'panel'       => 'layout',
  'priority'    => 4,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'select',
  'settings'    => 'pm_sidebar_shop',
  'label'       => esc_html__( 'Sidebar', 'purism' ),
  'section'     => 'layout_shop',
  'default'     => 'sidebar-shop',
  'choices'     => array(
    'sidebar'       => esc_attr__( 'Sidebar', 'purism' ),
    'sidebar-shop'  => esc_attr__( 'Shop Sidebar', 'purism' ),
    'nosidebar'     => esc_attr__( 'No Sidebar', 'purism' ),
  ),
  'priority'    => 1,
));

/**
* Layout > Post Meta
*/

Kirki::add_section( 'layout_post_meta', array(
  'title'       => esc_html__( 'Post Meta', 'purism' ),
  'panel'       => 'layout',
  'priority'    => 5,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_post_views',
  'label'       => esc_html__( 'Views', 'purism' ),
  'section'     => 'layout_post_meta',
  'default'     => true,
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_post_comments',
  'label'       => esc_html__( 'Comments', 'purism' ),
  'section'     => 'layout_post_meta',
  'default'     => true,
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_post_likes',
  'label'       => esc_html__( 'Likes & Like Button', 'purism' ),
  'section'     => 'layout_post_meta',
  'default'     => true,
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_post_category',
  'label'       => esc_html__( 'Post Category', 'purism' ),
  'section'     => 'layout_post_meta',
  'default'     => true,
  'priority'    => 4,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_product_category',
  'label'       => esc_html__( 'Product Category', 'purism' ),
  'section'     => 'layout_post_meta',
  'default'     => true,
  'priority'    => 5,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_post_date',
  'label'       => esc_html__( 'Date', 'purism' ),
  'section'     => 'layout_post_meta',
  'default'     => true,
  'priority'    => 6,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_post_author',
  'label'       => esc_html__( 'Author', 'purism' ),
  'section'     => 'layout_post_meta',
  'default'     => true,
  'priority'    => 7,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_post_author_description',
  'label'       => esc_html__( 'Author Meta Box', 'purism' ),
  'section'     => 'layout_post_meta',
  'default'     => true,
  'priority'    => 8,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_post_tags',
  'label'       => esc_html__( 'Post Tags', 'purism' ),
  'section'     => 'layout_post_meta',
  'default'     => true,
  'priority'    => 9,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_product_tags',
  'label'       => esc_html__( 'Product Tags', 'purism' ),
  'section'     => 'layout_post_meta',
  'default'     => true,
  'priority'    => 10,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_post_shares',
  'label'       => esc_html__( 'Share Buttons Post', 'purism' ),
  'section'     => 'layout_post_meta',
  'default'     => true,
  'priority'    => 11,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_page_content_shares',
  'label'       => esc_html__( 'Share Buttons Page Content', 'purism' ),
  'section'     => 'layout_post_meta',
  'default'     => true,
  'priority'    => 12,
));

/**
* Header
*/

Kirki::add_panel( 'header', array(
  'title'       => esc_html__( 'Header', 'purism' ),
  'priority'    => 3,
));

/**
* Header > Menu
*/

Kirki::add_section( 'header_nav', array(
  'title'       => esc_html__( 'Navigation Bar', 'purism' ),
  'panel'       => 'header',
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_header_search',
  'label'       => esc_html__( 'Show Search Form', 'purism' ),
  'section'     => 'header_nav',
  'default'     => true,
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'pm_sticky_navbar_logo',
	'label'       => esc_html__( 'Show Logo', 'purism' ),
	'section'     => 'header_nav',
	'default'     => 'sticky',
	'choices'     => array(
		'no'       => esc_attr__( 'No', 'purism' ),
  	'yes'      => esc_attr__( 'Yes', 'purism' ),
  	'sticky'   => esc_attr__( 'Only on Sticky Navbar', 'purism' ),
	),
	'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'image',
  'settings'    => 'pm_navbar_logo',
  'label'       => esc_html__( 'Logo', 'purism' ),
  'section'     => 'header_nav',
  'default'     => get_template_directory_uri() . '/dist/images/logo-purism.gif',
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'dimension',
  'settings'    => 'pm_navbar_logo_height',
  'label'       => esc_html__( 'Logo Height', 'purism' ),
  'description' => esc_html__( 'Note: To get sharp and high resoluted images on Retina screens you need to double the image size.', 'purism' ),
  'section'     => 'header_nav',
  'default'     => '28px',
  'output'      => array(
    array(
      'element'  => '.navbar-brand > img',
      'property' => 'height',
    )
  ),
  'priority'    => 4,
));

/**
* Header > Logo
*/

Kirki::add_section( 'header_logo', array(
  'title'       => esc_html__( 'Logo', 'purism' ),
  'panel'       => 'header',
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_header_desktop',
  'label'       => esc_html__( 'Show on Desktop', 'purism' ),
  'section'     => 'header_logo',
  'default'     => true,
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'image',
  'settings'    => 'pm_header_logo',
  'label'       => esc_html__( 'Logo', 'purism' ),
  'section'     => 'header_logo',
  'default'     => get_template_directory_uri() . '/dist/images/logo-purism-header.gif',
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_header_logo_slogan',
  'label'       => esc_html__( 'Slogan', 'purism' ),
  'section'     => 'header_logo',
  'default'     => esc_attr( get_bloginfo('description') ),
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'dimension',
  'settings'    => 'pm_header_logo_width',
  'label'       => esc_html__( 'Logo Width', 'purism' ),
  'description' => esc_html__( 'Note: To get sharp and high resoluted images on Retina screens you need to double the image size.', 'purism' ),
  'section'     => 'header_logo',
  'default'     => '450px',
  'output'      => array(
    array(
      'element'  => '.header-title img',
      'property' => 'width',
    )
  ),
  'priority'    => 4,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'dimension',
  'settings'    => 'pm_header_height',
  'label'       => esc_html__( 'Header Height', 'purism' ),
  'description' => esc_html__( 'Input height in pixels.', 'purism' ),
  'section'     => 'header_logo',
  'default'     => '240px',
  'output' => array(
    array(
      'element'  => '.header-title',
      'property' => 'height',
    )
  ),
  'priority'    => 5,
));

/**
* Footer
*/

Kirki::add_panel( 'footer', array(
  'title'       => esc_html__( 'Footer', 'purism' ),
  'priority'    => 4,
));

/**
* Footer > Logo & Copyright
*/

Kirki::add_section( 'footer_logo_copy', array(
  'title'       => esc_html__( 'Logo & Copyright', 'purism' ),
  'panel'       => 'footer',
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'image',
  'settings'    => 'pm_footer_logo_url',
  'label'       => esc_html__( 'Logo', 'purism' ),
  'section'     => 'footer_logo_copy',
  'default'     => get_template_directory_uri() . '/dist/images/logo-purism-footer.png',
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'dimension',
  'settings'    => 'pm_footer_logo_height',
  'label'       => esc_html__( 'Logo Height', 'purism' ),
  'description' => esc_html__( 'Note: To get sharp and high resoluted images on Retina screens you need to double the image size.', 'purism' ),
  'section'     => 'footer_logo_copy',
  'default'     => '25px',
  'output'      => array(
    array(
      'element'  => '.footer-logo img',
      'property' => 'height',
    )
  ),
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'textarea',
  'settings'    => 'pm_footer_copyright',
  'label'       => esc_html__( 'Copyright Text', 'purism' ),
  'section'     => 'footer_logo_copy',
  'default'     => wp_kses( sprintf( __( '&copy; %s - All rights reserved. Designed by <a href="%s">%s</a>.', 'purism' ), date('Y'),  home_url('/'),  get_bloginfo() ), array(
      'a' => array(
      'href' => array(),
      'title' => array(),
      'target' => array(),
    ),
    'br' => array(),
  )),
  'priority'    => 3,
));

/**
* Footer > Order
*/

Kirki::add_section( 'footer_order', array(
  'title'       => esc_html__( 'Order', 'purism' ),
  'panel'       => 'footer',
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'sortable',
  'settings'    => 'pm_footer_order',
  'label'       => esc_html__( 'Content order', 'purism' ),
  'section'     => 'footer_order',
  'default'     => array(
    'instagram',
    'info',
  ),
  'choices'     => array(
    'instagram' => esc_attr__( 'Instagram', 'purism' ),
    'info'      => esc_attr__( 'Logo, Copyright &amp; Navbar', 'purism' ),
  ),
  'priority'    => 1,
));

/**
* Featured Promo Area
*/

Kirki::add_panel( 'featured_promo_area', array(
  'title'       => esc_html__( 'Featured Promo Area', 'purism' ),
  'priority'    => 5,
));

/**
* Featured Promo Area > General
*/

Kirki::add_section( 'featured_promo_general', array(
  'title'       => esc_html__( 'General', 'purism' ),
  'panel'       => 'featured_promo_area',
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'radio-image',
  'settings'    => 'pm_layout_promo_featured',
  'label'       => esc_html__( 'Layout', 'purism' ),
  'section'     => 'featured_promo_general',
  'default'     => 'fullwidth',
  'choices'     => array(
    'fullwidth' => get_template_directory_uri() . '/dist/images/layout-promo-fetaured-fullwidth.png',
    'boxed'     => get_template_directory_uri() . '/dist/images/layout-promo-fetaured-boxed.png',
  ),
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_featured_promo_font_color',
  'label'       => esc_html__( 'Font Color', 'purism' ),
  'section'     => 'featured_promo_general',
  'choices'     => array(
    'color'  => esc_attr__( 'color', 'purism' ),
  ),
  'default'     => array(
    'color'  => $white,
  ),
  'output'      => array(
    array(
      'choice'    => 'color',
      'element'   => '.featured-promo h2, .featured-promo h4, .featured-promo .post-category .separator',
      'property'  => 'color',
    ),
  ),
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_featured_promo_link_color',
  'label'       => esc_html__( 'Link Color', 'purism' ),
  'section'     => 'featured_promo_general',
  'choices'     => array(
    'normal'    => esc_attr__( 'normal', 'purism' ),
    'hover'     => esc_attr__( 'hover', 'purism' ),
  ),
  'default'     => array(
    'normal'    => $white,
    'hover'     => $white,
  ),
  'output'      => array(
    array(
      'choice'    => 'normal',
      'element'   => '.featured-promo .post-category a',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.featured-promo .post-category a:hover',
      'property'  => 'color',
    ),
  ),
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_featured_promo_layer',
  'label'       => esc_attr__( 'Layer Color', 'purism' ),
  'section'     => 'featured_promo_general',
  'choices'     => array(
    'background' => esc_attr__( 'Color', 'purism' ),
  ),
  'default'     => array(
    'background'  => 'rgba(0,0,0,0.2)',
  ),
  'output'      => array(
    array(
      'choice'    => 'background',
      'element'   => '.featured-post .overlay, .promo .overlay',
      'property'  => 'background',
    ),
  ),
  'priority'    => 4,
));

/**
* Featured Promo Area > Featured
*/

Kirki::add_section( 'featured', array(
  'title'       => esc_html__( 'Featured Post Slider', 'purism' ),
  'panel'       => 'featured_promo_area',
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_featured_slider',
  'label'       => esc_html__( 'Show Featured Post Slider', 'purism' ),
  'section'     => 'featured',
  'default'     => true,
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'radio-image',
  'settings'    => 'pm_layout_slider',
  'label'       => esc_html__( 'Slider Layout', 'purism' ),
  'section'     => 'featured',
  'default'     => 'single',
  'choices'     => array(
    'single'    => get_template_directory_uri() . '/dist/images/layout-slider-single.png',
    'multiple'  => get_template_directory_uri() . '/dist/images/layout-slider-multiple.png',
  ),
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'slider',
  'settings'    => 'pm_slider_number',
  'label'       => esc_html__( 'Number of Slides', 'purism' ),
  'section'     => 'featured',
  'default'     => 3,
  'choices'     => array(
    'min'       => 1,
    'max'       => 15,
    'step'      => 1,
  ),
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_slider_video',
  'label'       => esc_html__( 'Video Embed', 'purism' ),
  'description' => esc_html__( 'Allowed Video embed on Slider. Option available for Single Slider', 'purism' ),
  'section'     => 'featured',
  'default'     => true,
  'active_callback' => array(
    array(
      'setting'  => 'pm_layout_slider',
      'operator' => '!==',
      'value'    => 'multiple',
    ),
  ),
  'priority'    => 4,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_slider_autoplay',
  'label'       => esc_html__( 'Autoplay', 'purism' ),
  'description' => esc_html__( 'Enables Autoplay on Slider.', 'purism' ),
  'section'     => 'featured',
  'default'     => true,
  'priority'    => 5,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_slider_fade',
  'label'       => esc_html__( 'Fade', 'purism' ),
  'description' => esc_html__( 'Enables Fade Effect on Slider.', 'purism' ),
  'section'     => 'featured',
  'default'     => 'true',
  'priority'    => 6,
));

/**
* Featured Promo Area > Promo Boxes
*/

Kirki::add_section( 'promo', array(
  'title'       => esc_html__( 'Promo Boxes', 'purism' ),
  'panel'       => 'featured_promo_area',
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_promo',
  'label'       => esc_html__( 'Show Promo Box', 'purism' ),
  'section'     => 'promo',
  'default'     => false,
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'radio',
  'settings'    => 'pm_promo_link_1',
  'label'       => esc_html__( 'Promo Box #1 Link', 'purism' ),
  'section'     => 'promo',
  'default'     => 'page',
  'choices'     => array(
    'page'      => esc_attr__( 'Page', 'purism' ),
    'url'       => esc_attr__( 'URL', 'purism' ),
  ),
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_promo_url_1',
  'label'       => esc_html__( 'Promo Box #1 URL', 'purism' ),
  'section'     => 'promo',
  'default'     => '',
  'active_callback' => array(
    array(
      'setting'  => 'pm_promo_link_1',
      'operator' => '==',
      'value'    => 'url',
    )
  ),
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'dropdown-pages',
  'settings'    => 'pm_promo_page_1',
  'label'       => esc_html__( 'Promo Box #1 URL', 'purism' ),
  'section'     => 'promo',
  'default'     => '',
  'active_callback' => array(
    array(
      'setting'  => 'pm_promo_link_1',
      'operator' => '==',
      'value'    => 'page',
    )
  ),
  'priority'    => 4,
));

Kirki::add_field( 'pm_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'pm_promo_target_1',
	'label'       => esc_html__( 'Open the linked page in a new window', 'purism' ),
	'section'     => 'promo',
	'default'     => '0',
	'priority'    => 5,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_promo_title_1',
  'label'       => esc_html__( 'Promo Box #1 Title', 'purism' ),
  'section'     => 'promo',
  'default'     => '',
  'active_callback' => array(
    array(
      'setting'  => 'pm_promo_link_1',
      'operator' => '==',
      'value'    => 'url',
    )
  ),
  'priority'    => 6,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'image',
  'settings'    => 'pm_promo_image_1',
  'label'       => esc_html__( 'Promo Box #1 Image', 'purism' ),
  'section'     => 'promo',
  'default'     => '',
  'active_callback' => array(
    array(
      'setting'  => 'pm_promo_link_1',
      'operator' => '==',
      'value'    => 'url',
    )
  ),
  'priority'    => 7,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'radio',
  'settings'    => 'pm_promo_link_2',
  'label'       => esc_html__( 'Promo Box #2 Link', 'purism' ),
  'section'     => 'promo',
  'default'     => 'page',
  'choices'     => array(
    'page'      => esc_attr__( 'Page', 'purism' ),
    'url'       => esc_attr__( 'URL', 'purism' ),
  ),
  'priority'    => 8,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_promo_url_2',
  'label'       => esc_html__( 'Promo Box #2 URL', 'purism' ),
  'section'     => 'promo',
  'default'     => '',
  'active_callback' => array(
    array(
      'setting'  => 'pm_promo_link_2',
      'operator' => '==',
      'value'    => 'url',
    )
  ),
  'priority'    => 9,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'dropdown-pages',
  'settings'    => 'pm_promo_page_2',
  'label'       => esc_html__( 'Promo Box #2 URL', 'purism' ),
  'section'     => 'promo',
  'default'     => '',
  'active_callback' => array(
    array(
      'setting'  => 'pm_promo_link_2',
      'operator' => '==',
      'value'    => 'page',
    )
  ),
  'priority'    => 10,
));

Kirki::add_field( 'pm_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'pm_promo_target_2',
	'label'       => esc_html__( 'Open the linked page in a new window', 'purism' ),
	'section'     => 'promo',
	'default'     => '0',
	'priority'    => 11,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_promo_title_2',
  'label'       => esc_html__( 'Promo Box #2 Title', 'purism' ),
  'section'     => 'promo',
  'default'     => '',
  'active_callback' => array(
    array(
      'setting'  => 'pm_promo_link_2',
      'operator' => '==',
      'value'    => 'url',
    )
  ),
  'priority'    => 12,
));


Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'image',
  'settings'    => 'pm_promo_image_2',
  'label'       => esc_html__( 'Promo Box #2 Image', 'purism' ),
  'section'     => 'promo',
  'default'     => '',
  'active_callback' => array(
    array(
      'setting'  => 'pm_promo_link_2',
      'operator' => '==',
      'value'    => 'url',
    )
  ),
  'priority'    => 13,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'radio',
  'settings'    => 'pm_promo_link_3',
  'label'       => esc_html__( 'Promo Box #3 Link', 'purism' ),
  'section'     => 'promo',
  'default'     => 'page',
  'choices'     => array(
    'page'      => esc_attr__( 'Page', 'purism' ),
    'url'       => esc_attr__( 'URL', 'purism' ),
  ),
  'priority'    => 14,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_promo_url_3',
  'label'       => esc_html__( 'Promo Box #3 URL', 'purism' ),
  'section'     => 'promo',
  'default'     => '',
  'active_callback' => array(
    array(
      'setting'  => 'pm_promo_link_3',
      'operator' => '==',
      'value'    => 'url',
    )
  ),
  'priority'    => 15,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'dropdown-pages',
  'settings'    => 'pm_promo_page_3',
  'label'       => esc_html__( 'Promo Box #3 URL', 'purism' ),
  'section'     => 'promo',
  'default'     => '',
  'active_callback' => array(
    array(
      'setting'  => 'pm_promo_link_3',
      'operator' => '==',
      'value'    => 'page',
    )
  ),
  'priority'    => 16,
));

Kirki::add_field( 'pm_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'pm_promo_target_3',
	'label'       => esc_html__( 'Open the linked page in a new window', 'purism' ),
	'section'     => 'promo',
	'default'     => '0',
	'priority'    => 17,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_promo_title_3',
  'label'       => esc_html__( 'Promo Box #3 Title', 'purism' ),
  'section'     => 'promo',
  'default'     => '',
  'active_callback' => array(
    array(
      'setting'  => 'pm_promo_link_3',
      'operator' => '==',
      'value'    => 'url',
    )
  ),
  'priority'    => 18,
));


Kirki::add_field( 'pm_theme_mod', array(
  'type'            => 'image',
  'settings'        => 'pm_promo_image_3',
  'label'           => esc_html__( 'Promo Box #3 Image', 'purism' ),
  'section'         => 'promo',
  'default'         => '',
  'active_callback' => array(
    array(
      'setting'     => 'pm_promo_link_3',
      'operator'    => '==',
      'value'       => 'url',
    )
  ),
  'priority'        => 19,
));

/**
* Social Media Links
*/

Kirki::add_section( 'social', array(
  'title'       => esc_html__( 'Social Media Links', 'purism' ),
  'description' => esc_html__( 'Enter the URL of your social media account.', 'purism' ),
  'priority'    => 6,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_header_social',
  'label'       => esc_html__( 'Show', 'purism' ),
  'section'     => 'social',
  'default'     => false,
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_social_facebook',
  'label'       => esc_html__( 'Facebook', 'purism' ),
  'section'     => 'social',
  'default'     => '',
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_social_google',
  'label'       => esc_html__( 'Google Plus', 'purism' ),
  'section'     => 'social',
  'default'     => '',
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_social_twitter',
  'label'       => esc_html__( 'Twitter', 'purism' ),
  'section'     => 'social',
  'default'     => '',
  'priority'    => 4,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_social_instagram',
  'label'       => esc_html__( 'Instagram', 'purism' ),
  'section'     => 'social',
  'default'     => '',
  'priority'    => 5,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_social_behance',
  'label'       => esc_html__( 'Behance', 'purism' ),
  'section'     => 'social',
  'default'     => '',
  'priority'    => 6,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_social_pinterest',
  'label'       => esc_html__( 'Pinterest', 'purism' ),
  'section'     => 'social',
  'default'     => '',
  'priority'    => 7,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_social_tumblr',
  'label'       => esc_html__( 'Tumblr', 'purism' ),
  'section'     => 'social',
  'default'     => '',
  'priority'    => 8,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_social_bloglovin',
  'label'       => esc_html__( 'Bloglovin', 'purism' ),
  'section'     => 'social',
  'default'     => '',
  'priority'    => 9,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_social_flickr',
  'label'       => esc_html__( 'Flickr', 'purism' ),
  'section'     => 'social',
  'default'     => '',
  'priority'    => 10,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_social_xing',
  'label'       => esc_html__( 'Xing', 'purism' ),
  'section'     => 'social',
  'default'     => '',
  'priority'    => 11,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_social_github',
  'label'       => esc_html__( 'Github', 'purism' ),
  'section'     => 'social',
  'default'     => '',
  'priority'    => 12,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_social_youtube',
  'label'       => esc_html__( 'Youtube', 'purism' ),
  'section'     => 'social',
  'default'     => '',
  'priority'    => 13,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_social_vimeo',
  'label'       => esc_html__( 'Vimeo', 'purism' ),
  'section'     => 'social',
  'default'     => '',
  'priority'    => 14,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_social_dribbble',
  'label'       => esc_html__( 'Dribble', 'purism' ),
  'section'     => 'social',
  'default'     => '',
  'priority'    => 15,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_social_soundcloud',
  'label'       => esc_html__( 'Soundcloud', 'purism' ),
  'section'     => 'social',
  'default'     => '',
  'priority'    => 16,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_social_linkedin',
  'label'       => esc_html__( 'Linkedin', 'purism' ),
  'section'     => 'social',
  'default'     => '',
  'priority'    => 17,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_social_rss',
  'label'       => esc_html__( 'RSS', 'purism' ),
  'section'     => 'social',
  'default'     => '',
  'priority'    => 18,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_social_link_color',
  'label'       => esc_html__( 'Social Icons Link Color', 'purism' ),
  'section'     => 'social',
  'choices'     => array(
    'normal'    => esc_attr__( 'normal', 'purism' ),
    'hover'     => esc_attr__( 'hover', 'purism' ),
  ),
  'default'     => array(
    'normal'    => $black,
    'hover'     => $grey,
  ),
  'output'      => array(
    array(
      'choice'    => 'normal',
      'element'   => '.nav-features .social-links a',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.nav-features .social-links a:hover',
      'property'  => 'color',
    ),
  ),
  'priority'    => 19,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'pm_social_panel_color',
  'label'       => esc_html__( 'Social Icons Panel Color', 'purism' ),
  'section'     => 'social',
  'choices'     => array(
    'color'    => esc_attr__( 'color', 'purism' ),
  ),
  'default'     => array(
    'color'    => $white,
  ),
  'output'      => array(
    array(
      'choice'    => 'color',
      'element'   => '.nav-features > .social-links',
      'property'  => 'background',
    ),
  ),
  'priority'    => 20,
));

/**
* Popular Posts
*/

Kirki::add_section( 'popular_posts', array(
  'title'       => esc_html__( 'Popular Posts', 'purism' ),
  'priority'    => 7,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_popular_posts',
  'label'       => esc_html__( 'Show on Blog Page', 'purism' ),
  'section'     => 'popular_posts',
  'default'     => false,
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_popular_title',
  'label'       => esc_html__( 'Title', 'purism' ),
  'section'     => 'popular_posts',
  'default'     => esc_attr__( 'Popular Posts', 'purism' ),
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'slider',
  'settings'    => 'pm_popular_number',
  'label'       => esc_html__( 'Number of Posts', 'purism' ),
  'section'     => 'popular_posts',
  'default'     => 3,
  'choices'     => array(
    'min'       => 1,
    'max'       => 6,
    'step'      => 1,
  ),
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'radio',
  'settings'    => 'pm_popular_filter',
  'label'       => esc_html__( 'Filter by', 'purism' ),
  'section'     => 'popular_posts',
  'default'     => 'post_views_count',
  'choices'     => array(
    'post_views_count'  => esc_attr__( 'Views', 'purism' ),
    '_post_like_count'  => esc_attr__( 'Likes', 'purism' ),
  ),
  'priority'    => 4,
));

/**
* Related Posts
*/

Kirki::add_section( 'related_posts', array(
  'title'       => esc_html__( 'Related Posts', 'purism' ),
  'priority'    => 8,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_related_posts',
  'label'       => esc_html__( 'Show on Single Post', 'purism' ),
  'section'     => 'related_posts',
  'default'     => true,
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_related_title',
  'label'       => esc_html__( 'Title', 'purism' ),
  'section'     => 'related_posts',
  'default'     => esc_attr__( 'You May also Like', 'purism' ),
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'              => 'number',
  'settings'          => 'pm_related_posts_number',
  'label'             => esc_html__( 'Number of Posts', 'purism' ),
  'section'           => 'related_posts',
  'default'           => 3,
  'sanitize_callback' => 'absint',
  'priority'          => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'radio',
  'settings'    => 'pm_related_posts_order',
  'label'       => esc_html__( 'Order by', 'purism' ),
  'section'     => 'related_posts',
  'default'     => 'rand',
  'choices'     => array(
    'rand'      => esc_attr__( 'Random', 'purism'),
    'date'      => esc_attr__( 'Date', 'purism' )
  ),
  'priority'    => 4,
));

/**
* Instagram
*/

Kirki::add_section( 'instagram', array(
  'title'       => esc_html__( 'Instagram', 'purism' ),
  'priority'    => 9,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_instagram_footer',
  'label'       => esc_html__( 'Show on Footer', 'purism' ),
  'section'     => 'instagram',
  'default'     => false,
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_instagram_title',
  'label'       => esc_html__( 'Instagram Title', 'purism' ),
  'section'     => 'instagram',
  'default'     => esc_attr__( 'Follow @instagram', 'purism' ),
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_instagram_username',
  'label'       => esc_html__( 'Instagram Username', 'purism' ),
  'section'     => 'instagram',
  'default'     => '',
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'slider',
  'settings'    => 'pm_instagram_number',
  'label'       => esc_html__( 'Number of Posts', 'purism' ),
  'section'     => 'instagram',
  'default'     => 6,
  'choices'     => array(
    'min'  => 1,
    'max'  => 12,
    'step' => 1,
  ),
  'priority'    => 4,
));

/**
* MailChimp Subscription Form
*/

Kirki::add_section( 'mailchimp', array(
  'title'       => esc_html__( 'MailChimp Subscription Form', 'purism' ),
  'priority'    => 10,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_mailchimp_footer',
  'label'       => esc_html__( 'Show on Blog Page', 'purism' ),
  'section'     => 'MailChimp',
  'default'     => false,
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_mailchimp_url',
  'label'       => esc_html__( 'MailChimp URL', 'purism' ),
  'section'     => 'MailChimp',
  'default'     => '',
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_mailchimp_title',
  'label'       => esc_html__( 'MailChimp Title', 'purism' ),
  'section'     => 'MailChimp',
  'default'     => esc_attr__( 'Weekly Newsletter', 'purism' ),
  'priority'    => 3,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_mailchimp_m_submit',
  'label'       => esc_html__( 'Message Submitting', 'purism' ),
  'section'     => 'MailChimp',
  'default'     => esc_attr__( 'Submitting...', 'purism' ),
  'priority'    => 4,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_mailchimp_m_0',
  'label'       => esc_html__( 'Message 0', 'purism' ),
  'section'     => 'MailChimp',
  'default'     => esc_attr__( 'We have sent you a confirmation email', 'purism' ),
  'priority'    => 5,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_mailchimp_m_1',
  'label'       => esc_html__( 'Message 1', 'purism' ),
  'section'     => 'MailChimp',
  'default'     => esc_attr__( 'Please enter a value', 'purism' ),
  'priority'    => 6,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_mailchimp_m_2',
  'label'       => esc_html__( 'Message 2', 'purism' ),
  'section'     => 'MailChimp',
  'default'     => esc_attr__( 'An email address must contain a single @', 'purism' ),
  'priority'    => 7,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_mailchimp_m_3',
  'label'       => esc_html__( 'Message 3', 'purism' ),
  'section'     => 'MailChimp',
  'default'     => esc_attr__( 'The domain portion of the email address is invalid (the portion after the @: )', 'purism' ),
  'priority'    => 8,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_mailchimp_m_4',
  'label'       => esc_html__( 'Message 4', 'purism' ),
  'section'     => 'MailChimp',
  'default'     => esc_attr__( 'The username portion of the email address is invalid (the portion before the @: )', 'purism' ),
  'priority'    => 9,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'pm_mailchimp_m_5',
  'label'       => esc_html__( 'Message 5', 'purism' ),
  'section'     => 'MailChimp',
  'default'     => esc_attr__( 'This email address looks fake or invalid. Please enter a real email address', 'purism' ),
  'priority'    => 10,
));

/**
* Effects
*/

Kirki::add_section( 'effects', array(
  'title'       => esc_html__( 'Effects', 'purism' ),
  'priority'    => 11,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_effects_lazy_load',
  'label'       => esc_html__( 'Posts Lazy Load', 'purism' ),
  'section'     => 'effects',
  'default'     => true,
  'priority'    => 1,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_effects_menu_sticky',
  'label'       => esc_html__( 'Sticky Navbar', 'purism' ),
  'section'     => 'effects',
  'default'     => true,
  'priority'    => 2,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'pm_effects_scroll_top',
  'label'       => esc_html__( 'Button Scroll Top', 'purism' ),
  'section'     => 'effects',
  'default'     => true,
  'priority'    => 3,
));

/**
* Custom CSS
*/

Kirki::add_section( 'css', array(
  'title'       => esc_html__( 'Custom CSS', 'purism' ),
  'priority'    => 12,
));

Kirki::add_field( 'pm_theme_mod', array(
  'type'        => 'code',
  'settings'    => 'pm_css',
  'label'       => esc_html__( 'Custom CSS Code', 'purism' ),
  'section'     => 'css',
  'default'     => '',
  'choices'     => array(
    'language'  => 'css',
    'height'    => 250,
  ),
  'priority'    => 1,
));
