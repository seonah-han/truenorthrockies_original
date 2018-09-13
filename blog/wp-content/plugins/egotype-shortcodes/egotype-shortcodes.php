<?php
/*
Plugin Name: Egotype Shortcodes
Plugin URI: http://egotype.com
Author: Egotype Design
Description: Provides shortcodes for themes by Egotype.
Version: 1.0
License: Themeforest Licence
License URI: http://themeforest.net/licenses
*/

/**
* Assets
*/

function egotype_scripts() {
  $assets     = array(
    'css'       => '/style.css',
    'js'        => '/scripts.min.js',
  );

  $version = time();

  wp_register_script( 'egotype-js', plugins_url( $assets['js'], __FILE__ ), array( 'jquery' ), $version, true);

  wp_enqueue_script( 'egotype-js' );
  wp_enqueue_style( 'egotype-css', plugins_url( $assets['css'], __FILE__ ), false, $version );

}
add_action( 'wp_enqueue_scripts', 'egotype_scripts' );

/**
* Remove p and br tags
*/

function egotype_fix_shortcodes($content){
  $array = array (
    '<p>[' => '[',
    ']</p>' => ']',
    ']<br />' => ']',
    ']<br>' => ']'
  );

  $content = strtr($content, $array);
  return $content;
}

add_filter('the_content', 'egotype_fix_shortcodes');

/**
* Parse shortcode content
*/

function egotype_content_parsed($str, $att = null) {
  $result = array();
  $return = array();
  $reg = get_shortcode_regex();
  preg_match_all('~'.$reg.'~',$str, $matches);
  foreach($matches[2] as $key => $name) {
    $parsed = shortcode_parse_atts($matches[3][$key]);
    $parsed = is_array($parsed) ? $parsed : array();

    $result[$name] = $parsed;
    $return[] = $result;
  }
  return $return;
}

/**
* Shordcodes
*/

class egotypeShortcodes {

  function __construct() {
    add_action( 'init', array( $this, 'add_shortcodes' ) );
  }

  /**
  * Add Shortcodes
  */

  function add_shortcodes() {

    $shortcodes = array(
      'socialgroup',
      'social',
      'row',
      'column',
      'accordion',
      'collapse',
      'column',
      'alert',
      'tabs',
      'tab',
    );

    foreach ( $shortcodes as $shortcode ) {
      $function = 'egotype_' . str_replace( '-', '_', $shortcode );
      add_shortcode( $shortcode, array( $this, $function ) );
    }
  }

  /**
  * Social Icons
  */

  function egotype_socialgroup( $atts, $content = null ) {
    $atts = shortcode_atts( array(
      "align"       => false,
      "inverse"     => false,
    ), $atts );

    $align_class = ( $atts['align'] ) ? ' text-' . $atts['align'] : '';
    $color_class = ( $atts['inverse'] == true ) ? ' inverse' : '';
    return sprintf(
      '<div class="sc social-links%s%s">%s</div>',
      esc_attr( $align_class ),
      esc_attr( $color_class ),
      do_shortcode( $content )
    );
  }

  function egotype_social( $atts, $content = null ) {
    $atts = shortcode_atts( array(
      "account" => 'facebook',
      "link"    => false,
      "count"   => false,
      "label"   => false,
    ), $atts );

    $account_class =  ( $atts['account'] == 'bloglovin' ) ? ' fa-heart' : ' fa-' . $atts['account'];
    $count = ( $atts['count'] ) ? '<span class="count">' . $atts['count'] . '</span>' : '';
    $label = ( $atts['label'] ) ? '<span class="label">' . $atts['label'] . '</span>' : '';

    if( $atts['link'] ) {
      $social = sprintf(
        '<a class="sc-icon" href="%2$s" target="_blank"><i class="fa%1$s"></i>%3$s%4$s</a>',
        esc_attr($account_class),
        esc_url($atts['link']),
        $count,
        $label
      );
    } else {
      $social = sprintf(
        '<span class="sc-icon"><i class="fa%1$s"></i></span>',
        esc_attr($account_class)
      );
    }
    return $social;
  }

  /**
  * Columns
  */

  function egotype_row( $atts, $content = null ) {
    return '<div class="row">' . do_shortcode($content) . '</div>';
  }


  function egotype_column( $atts, $content = null ) {

    $atts = shortcode_atts( array(
      "lg"          => false,
      "md"          => false,
      "sm"          => false,
      "xs"          => false,
    ), $atts );

    $class  = '';
    $class .= ( $atts['lg'] ) ? ' col-lg-' . $atts['lg'] : '';
    $class .= ( $atts['md'] ) ? ' col-md-' . $atts['md'] : '';
    $class .= ( $atts['sm'] ) ? ' col-sm-' . $atts['sm'] : '';
    $class .= ( $atts['xs'] ) ? ' col-xs-' . $atts['xs'] : '';

    return sprintf(
      '<div class="%s">%s</div>',
      esc_attr( $class ),
      do_shortcode( $content )
    );
  }

  /**
  * Accordion
  */

  function egotype_accordion( $atts, $content = null ) {

    if( isset($GLOBALS['collapsibles_count']) )
    $GLOBALS['collapsibles_count']++;
    else
    $GLOBALS['collapsibles_count'] = 0;

    $id = 'accordion-'. $GLOBALS['collapsibles_count'];

    return sprintf(
      '<div class="panel-group" id="%1$s" role="tablist" aria-multiselectable="true">%2$s</div>',
      $id,
      do_shortcode( $content )
    );
  }

  function egotype_collapse( $atts, $content = null ) {

    if( isset($GLOBALS['single_collapse_count']) )
    $GLOBALS['single_collapse_count']++;
    else
    $GLOBALS['single_collapse_count'] = 0;

    $atts = shortcode_atts( array(
      "title"   => false,
      "active"  => false,
    ), $atts );

    $collapse_in = ( $atts['active'] == 'true' )  ? ' in' : '';
    $parent = isset( $GLOBALS['collapsibles_count'] ) ? 'accordion-' . $GLOBALS['collapsibles_count'] : 'single-collapse';
    $current_collapse = $parent . '-' . $GLOBALS['single_collapse_count'];

    return sprintf(
      '<div class="panel panel-default">
      <div class="panel-heading" role="tab" id="#%4$s">
      <p class="panel-title">
      <a role="button" data-toggle="collapse" data-parent="#%3$s" href="#%4$s">
      %1$s
      </a>
      </p>
      </div>
      <div id="%4$s" class="panel-collapse collapse%2$s" role="tabpanel">
      <div class="panel-body">
      %5$s
      </div>
      </div>
      </div>',
      esc_html($atts['title']),
      $collapse_in,
      $parent,
      $current_collapse,
      do_shortcode( $content )
    );
  }

  /**
  * Alert
  */

  function egotype_alert( $atts, $content = null ) {

    $atts = shortcode_atts( array(
      "var"       => false,
      "dismiss"   => false,
    ), $atts );

    $class  = 'alert';
    $class .= ( $atts['var'] ) ? ' alert-' . $atts['var'] : ' alert-info';
    $class .= ( $atts['dismiss']   == 'true' )  ? ' alert-dismissible' : '';

    $dismiss = ( $atts['dismiss'] ) ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' : '';

    return sprintf(
      '<div class="%s" role="alert"><p>%s%s</div>',
      esc_attr( $class ),
      $dismiss,
      do_shortcode( $content )
    );
  }

  /**
  * Tabs
  */

  function egotype_tabs( $atts, $content = null ) {

    if( isset( $GLOBALS['tabs_count'] ) )
    $GLOBALS['tabs_count']++;
    else
    $GLOBALS['tabs_count'] = 0;

    $GLOBALS['tabs_default_count'] = 0;

    $div_class = 'tab-content';

    $id = 'custom-tabs-'. $GLOBALS['tabs_count'];

    $atts_map = egotype_content_parsed($content);

    if ( $atts_map ) {
      $tabs = array();
      $GLOBALS['tabs_default_active'] = true;
      foreach( $atts_map as $check ) {
        if( !empty($check["tab"]["active"]) ) {
          $GLOBALS['tabs_default_active'] = false;
        }
      }
      $i = 0;
      foreach( $atts_map as $tab ) {

        $a_class = ( !empty($tab["tab"]["active"]) || ($GLOBALS['tabs_default_active'] && $i == 0) ) ? ' ' . ' class="active"' : '';

        $tabs[] = sprintf(
          '<li%s><a href="#%s" data-toggle="tab">%s</a></li>',
          ( !empty($a_class) ) ? ' ' . $a_class : '',
          'custom-tab-' . $GLOBALS['tabs_count'] . '-' . $i,
          $tab["tab"]["title"]
        );
        $i++;
      }
    }
    return sprintf(
      '<ul id="%s" class="nav nav-tabs" role="tablist">%s</ul><div class="%s">%s</div>',
      esc_attr( $id ),
      ( $tabs )  ? implode( $tabs ) : '',
      esc_attr( $div_class ),
      do_shortcode( $content )
    );
  }

  function egotype_tab( $atts, $content = null ) {

    $atts = shortcode_atts( array(
      'title'   => false,
      'active'  => false,
    ), $atts );

    if( $GLOBALS['tabs_default_active'] && $GLOBALS['tabs_default_count'] == 0 ) {
      $atts['active'] = true;
    }


    $class  = 'tab-pane';
    $class .= ( $atts['active'] == 'true' ) ? ' active' : '';


    $id = 'custom-tab-'. $GLOBALS['tabs_count'] . '-'. $GLOBALS['tabs_default_count'];
    $GLOBALS['tabs_default_count']++;
    return sprintf(
      '<div id="%s" class="%s">%s</div>',
      esc_attr( $id ),
      esc_attr( $class ),
      do_shortcode( $content )
    );

  }

}

new egotypeShortcodes();
