<li class="<?php echo esc_attr( $liclass ); ?>">
  <a href="<?php echo esc_url( $item['link'] ); ?>" target="<?php echo esc_attr( $target ); ?>"  class="<?php echo esc_attr( $aclass ); ?>">
    <img src="<?php echo esc_url( $item[$size] ); ?>" class="<?php echo esc_attr( $imgclass ); ?>" alt="<?php echo esc_attr( $item['description'] ); ?>"/>
    <span class="instagram-meta">
      <span class="instagram-likes"><i class="fa fa-heart-o"></i> <?php echo esc_html( $item['likes'] ); ?></span>
      <span class="instagram-comments"><i class="fa fa-comment-o"></i> <?php echo esc_html( $item['comments'] ); ?></span>
    </span>
  </a>
</li>
