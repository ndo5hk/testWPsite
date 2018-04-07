<?php
/**
 * Enqueue scripts and stylesheets
 *
 */
function virtue_get_wc_version() {return defined( 'WC_VERSION' ) && WC_VERSION ? WC_VERSION : null;}
function virtue_is_wc_version_gte_2_3() {return virtue_get_wc_version() && version_compare(virtue_get_wc_version(), '2.3', '>=' );}

function kadence_scripts() {
  global $virtue;
  wp_enqueue_style('kadence_theme', get_template_directory_uri() . '/assets/css/virtue.css', false, "306");
 if(isset($virtue['skin_stylesheet']) || !empty($virtue['skin_stylesheet'])) {$skin = $virtue['skin_stylesheet'];} else { $skin = 'default.css';} 
 wp_enqueue_style('virtue_skin', get_template_directory_uri() . '/assets/css/skins/'.$skin.'', false, null);
 if(is_rtl()) {
  wp_enqueue_style('kadence_rtl', get_template_directory_uri() . '/assets/css/rtl.css', false, null);
 }

  if (is_child_theme()) {
   wp_enqueue_style('virtue_child', get_stylesheet_uri(), false, null);
  } 

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_register_script('kadence_plugins', get_template_directory_uri() . '/assets/js/min/plugins-min.js', false, '306', true);
  wp_register_script('kadence_main', get_template_directory_uri() . '/assets/js/main.js', false, '306', true);
  wp_enqueue_script('jquery');
  wp_enqueue_script('masonry');
  wp_enqueue_script('kadence_plugins');
  wp_enqueue_script('kadence_main');
  
   if(class_exists('woocommerce')) {
      wp_register_script( 'kt-wc-add-to-cart-variation', get_template_directory_uri() . '/assets/js/min/kt-add-to-cart-variation-min.js' , array( 'jquery' ), false, '261', true );
      wp_enqueue_script( 'kt-wc-add-to-cart-variation');

      if(isset($virtue['product_quantity_input']) && $virtue['product_quantity_input'] == 1) {
          if (virtue_is_wc_version_gte_2_3() ) {
            wp_register_script( 'wcqi-js', get_template_directory_uri() . '/assets/js/min/wc-quantity-increment-min.js' , array( 'jquery' ), false, '297', true );
            wp_enqueue_script( 'wcqi-js' );
          }
        }
  }


}
add_action('wp_enqueue_scripts', 'kadence_scripts', 100);

/**
 * Add Respond.js for IE8 support of media queries
 */
function kadence_ie_support_header() {
    echo '<!--[if lt IE 9]>'. "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/assets/js/vendor/respond.min.js' ) . '"></script>'. "\n";
    echo '<![endif]-->'. "\n";
}
add_action( 'wp_head', 'kadence_ie_support_header', 15 );