<?php
/**
* Share template
*
* @author Your Inspiration Themes
* @package YITH WooCommerce Wishlist
* @version 2.0.13
*/

if ( ! defined( 'YITH_WCWL' ) ) {
  exit;
} // Exit if accessed directly
?>

<?php if( $share_facebook_enabled || $share_twitter_enabled || $share_pinterest_enabled || $share_googleplus_enabled || $share_email_enabled): ?>
<div class="post-meta meta-bottom">
  <div class="box-full">
    <div class="post-share">
      <span class="title-share"><?php echo $share_title ?></span>
        <?php if( $share_facebook_enabled ): ?>
            <a target="_blank" href="https://www.facebook.com/sharer.php?s=100&amp;p%5Btitle%5D=<?php echo $share_link_title ?>&amp;p%5Burl%5D=<?php echo urlencode( $share_link_url ) ?>" title="<?php _e( 'Facebook', 'yith-woocommerce-wishlist' ) ?>"><i class="fa fa-facebook"></i></a>
        <?php endif; ?>

        <?php if( $share_twitter_enabled ): ?>
            <a target="_blank" href="https://twitter.com/share?url=<?php echo urlencode( $share_link_url ) ?>&amp;text=<?php echo $share_twitter_summary ?>" title="<?php _e( 'Twitter', 'yith-woocommerce-wishlist' ) ?>"><i class="fa fa-twitter"></i></a>
        <?php endif; ?>

        <?php if( $share_pinterest_enabled ): ?>
            <a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( $share_link_url ) ?>&amp;description=<?php echo $share_summary ?>&amp;media=<?php echo $share_image_url ?>" title="<?php _e( 'Pinterest', 'yith-woocommerce-wishlist' ) ?>" onclick="window.open(this.href); return false;"><i class="fa fa-pinterest"></i></a>
        <?php endif; ?>

        <?php if( $share_googleplus_enabled ): ?>
            <a target="_blank" class="googleplus" href="https://plus.google.com/share?url=<?php echo urlencode( $share_link_url ) ?>&amp;title=<?php echo $share_link_title ?>" title="<?php _e( 'Google+', 'yith-woocommerce-wishlist' ) ?>" onclick='javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;'><i class="fa fa-google-plus"></i></a>
        <?php endif; ?>

        <?php if( $share_email_enabled ): ?>
            <a class="email" href="mailto:?subject=<?php echo urlencode( apply_filters( 'yith_wcwl_email_share_subject', __( 'I wanted you to see this site', 'yith-woocommerce-wishlist' ) ) )?>&amp;body=<?php echo apply_filters( 'yith_wcwl_email_share_body', urlencode( $share_link_url ) ) ?>&amp;title=<?php echo $share_link_title ?>" title="<?php _e( 'Email', 'yith-woocommerce-wishlist' ) ?>"><i class="fa fa-envelope"></i></a>
        <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; ?>
