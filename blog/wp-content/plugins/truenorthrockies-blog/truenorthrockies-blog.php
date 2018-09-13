<?php

/**
* Plugin Name: True North Rockies Blog
* Description: True North Rockies Blog custom functions.
* Author: Lana Ivanova
* Version: 1.0
*/

function quote_shortcode($params, $content, $tag) {
  $image = $params['image'];
  $caption = esc_html__($params['caption']);
  $message = esc_html__($params['message']);
  $messageWithLinks = preg_replace('/{(.*)}\((.*)\)/i', '<a href="${2}">${1}</a>', $message);

  $element = '<div class="tnr-quote">';
  $element .= '<figure class="tnr-quote__left" style="background: url(' . $image . ') center center / cover no-repeat">';
  if ($caption) {
    $element .= '<figcaption>' . $caption . '</figcaption>';
  }
  $element .= '</figure><div class="tnr-quote__right"><div>' . $messageWithLinks . '</div></div>';
  $element .= '</div>';

  ob_start();
  echo $element;

  return ob_get_clean();
}

function hotel_shortcode($params, $content, $tag) {
  $name = esc_html__($params['name']);
  $promo = esc_html__($params['promo']);
  $link = esc_html__($params['link']);
  $image = $params['image'];

  $element = '<div class="tnr-hotel">';

  $element .= '<div class="tnr-hotel__left">';
  $element .= '<div class="tnr-hotel__image" style="background: url(' . $image . ') center center / cover no-repeat"></div><div class="tnr-hotel__details"><div class="tnr-hotel__name">' . $name . '</div><div class="tnr-hotel__promo">' . $promo . '</div><div><a class="more-link btn btn-color" href="' . $link . '" target="_blank">Learn more</a></div></div>';
  $element .= '</div>';

  $element .= '<div class="tnr-hotel__right" style="background: url(http://blog.truenorthrockies.com/wp-content/uploads/2017/11/10-biking.jpg) center center / cover no-repeat">';
  $element .= '<div class="logo"><img class="logo__image" style="height: 50px;" src="http://truenorthrockies.com/images/logo_bg.png" alt=""><h3 class="logo__text" style="font-size: 12px;">WHERE #WELOVEWINTER</h3></div>';
  $element .= '</div>';

  $element .= '</div>';

  ob_start();
  echo $element;

  return ob_get_clean();
}

add_shortcode('quote', 'quote_shortcode');
add_shortcode('hotel', 'hotel_shortcode');

?>
