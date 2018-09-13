<?php

/**
* Woocommerce Plugin support constants
*/

// WooCommerce Plugin Support Constants
if (class_exists('woocommerce')) {
	define('PM_WOOCOMMERCE', true);
} else {
	define('PM_WOOCOMMERCE', false);
}

// Yith WooCommerce Wishlist Plugin support constants
if (class_exists('YITH_WCWL') && PM_WOOCOMMERCE) {
	define('PM_WCWL', true);
} else {
	define('PM_WCWL', false);
}

/**
* Return true, if page woocommerce, woocommerce page, wishlist
*/

if ( ! function_exists( 'pm_is_shop' ) ) {
  function pm_is_shop() {
    $is_shop_page = false;

    if( ( PM_WOOCOMMERCE && ( is_wc_endpoint_url() || is_account_page() || is_checkout() || is_cart() ) ) || ( PM_WCWL && yith_wcwl_is_wishlist_page() ) ) {
      $is_shop_page = true;
    }
    return $is_shop_page;
  }
}

/**
* Shop Page title
*/

if ( ! function_exists( 'pm_shop_title' ) ) {
  function pm_shop_title() {

    if ( is_product_category() ) {

      $subtitle = esc_html__( 'Products by category', 'purism' );
      $title = single_cat_title( '', false );
      $subcategories = pm_shop_subcategories();
      $description = get_the_archive_description();

    } elseif ( is_product_tag() ) {

      $subtitle = esc_html__( 'Products by tag', 'purism' );
      $title = single_tag_title( '', false );
      $description = get_the_archive_description();

    } elseif ( is_search() ) {

      $subtitle = esc_html__( 'Product Search Results for', 'purism' );
      $title = get_search_query();

    } elseif ( is_tax() ) {

      $title = single_term_title( "", false );

    } else {
      $shop_page_id = wc_get_page_id( 'shop' );
      $title   = get_the_title( $shop_page_id );
      $subcategories = pm_shop_subcategories();
    }

    if ( isset( $title ) ) {
      if ( isset( $subtitle ) ) {
        echo '<p class="sub-title">' . esc_html( $subtitle ) . '</p>';
      }

      echo '<h1>' . esc_html( $title ) . '</h1>';
      if ( isset( $subcategories ) ) {
        echo $subcategories;
      }

      if( isset ( $description ) ) {
        echo $description;
      }
    }
  }
}

/**
* Shop subcategories
*/

function pm_shop_subcategories( $sep = '|' ) {

  $parent_cat_ID = get_queried_object_id();

  $args = array(
    'hierarchical' => 1,
    'show_option_none' => '',
    'hide_empty' => 0,
    'parent' => $parent_cat_ID,
    'taxonomy' => 'product_cat'
  );

  $subcats = get_categories( $args );
  $first_cat = 1;
  $cat = '';
  foreach( $subcats as $sc ) {
    if ( $first_cat == 1 ) {
      $cat = $cat . '<a href="' . esc_url( get_term_link( $sc->slug, $sc->taxonomy ) ) . '" title="' . sprintf( esc_attr__( 'Products by category %s', 'purism' ), $sc->name ) . '" ' . '>'  . esc_html( $sc->name ) . '</a>';
      $first_cat = 0;
    } else {
      $cat = $cat . '<span class="separator">' . esc_html( $sep ) . '</span>' . '<a href="' . esc_url( get_term_link( $sc->slug, $sc->taxonomy ) ) . '" title="' . sprintf( esc_attr__( 'Products by category %s', 'purism' ), $sc->name ) . '" ' . '>' . esc_html( $sc->name ) . '</a>';
    }
  }
  if( $cat != '' ) {
    return '<p class="post-category">' . $cat . '</p>';
  }
}

/**
* Product Categories
*/

function pm_product_cat( $sep ) {
  $sep = '<span class="separator">' . $sep . '</span>';
  $taxonomy = 'product_cat';
  $product_id = get_the_id();
  $terms = get_the_terms( $product_id, $taxonomy );

  if ( is_wp_error( $terms ) ) {
    return $terms;
  }

  if ( empty( $terms ) ) {
    return false;
  }

  $links = array();

  foreach ( $terms as $term ) {
    $link = get_term_link($term, $taxonomy);
    $links[] = '<a href="' . esc_url( $link ) . '" class="product_cat_' . esc_attr( $term->term_id ) . '" rel="category">' . esc_html( $term->name ) . '</a>';
  }
  $term_links = apply_filters("term_links-$taxonomy", $links);

  return '<p class="post-category">' . implode( $sep, $term_links ) . '</p>';
}

/**
* Ensure cart contents update when products are added to the cart via AJAX
*/

function pm_add_to_cart_fragments( $fragments ) {
  ob_start();
  $count = WC()->cart->cart_contents_count;
  ?><a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'purism' ); ?>">
    <i class="fa fa-shopping-cart"></i>
    <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
  </a><?php

  $fragments['a.cart-contents'] = ob_get_clean();

  return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'pm_add_to_cart_fragments' );

/**
* Shop Content
*/

function pm_shop_content() { ?>

  <?php if ( is_singular( 'product' ) ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

      <?php wc_get_template_part( 'content', 'single-product' ); ?>

    <?php endwhile; ?>

  <?php else : ?>

    <?php if ( have_posts() ) : ?>

      <?php do_action( 'woocommerce_before_shop_loop' ); ?>
      <div class="clear"></div>

      <?php
      $args = array(
        'before'        => '<li><ul class="subcategories ">',
        'after'         => '</ul></li>',
      );
      ?>

      <?php woocommerce_product_loop_start(); ?>

      <?php woocommerce_product_subcategories($args); ?>

      <?php while ( have_posts() ) : the_post(); ?>

        <?php wc_get_template_part( 'content', 'product' ); ?>

      <?php endwhile; ?>

      <?php woocommerce_product_loop_end(); ?>

      <?php do_action( 'woocommerce_after_shop_loop' ); ?>

    <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

      <?php do_action( 'woocommerce_no_products_found' ); ?>

    <?php endif; ?>

  <?php endif; ?>

  <?php
}
