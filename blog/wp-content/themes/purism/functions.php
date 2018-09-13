<?php
$pm_includes = array(
  '/inc/kirki/kirki.php',                   // Kirki Customizer Library
  '/inc/functions/theme-mods.php',          // Theme Assets
  '/inc/functions/assets.php',              // Theme Mods
  '/inc/functions/init.php',                // Initial Theme Setup
  '/inc/functions/plugins.php',             // List of Required Plugins
  '/inc/functions/post-like.php',           // Post Like
  '/inc/functions/template-functions.php',  // Functions
  '/inc/functions/custom-fields.php',       // Custom Fields
  '/inc/functions/shop.php',                // Shop
);

foreach ($pm_includes as $file) {
  include_once get_template_directory() . $file;
}
?>
