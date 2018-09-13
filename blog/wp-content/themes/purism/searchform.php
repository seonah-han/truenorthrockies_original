<div class="search-form-container">
  <form method="get" class="search-form form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

    <label class="sr-only"><?php esc_html_e('Search for:', 'purism'); ?> </label>

    <div class="input-group">
      <input type="search" value="<?php the_search_query(); ?>" name="s" class="search-field form-control" placeholder="<?php esc_attr_e( 'Enter Keyword...', 'purism' ); ?>" required>
      <span class="input-group-btn">
        <button type="submit" class="btn search-submit"><i class="fa fa-search"></i></button>
      </span>
    </div>

    <p class="search-text"><?php esc_html_e( 'Input your search keywords and press Enter.', 'purism' ) ?></p>

  </form>
</div>
