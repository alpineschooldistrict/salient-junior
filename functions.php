<?php 

add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles');
function salient_child_enqueue_styles() {
	
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array('font-awesome'));

    if ( is_rtl() ) 
   		wp_enqueue_style(  'salient-rtl',  get_template_directory_uri(). '/rtl.css', array(), '1', 'screen' );
}




// Add Paypal Donate Shortcode #asd-modified
function paypal_donate( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'id' => 'your-paypal-id',
		), $atts )
	);
	// Code
$output = false;
	if (is_String($id) && trim($id) != '' && $id != 'your-paypal-id') {
		$output =  '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="'.$id.'">
					<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>';
	}
	return $output;
}

add_shortcode( 'paypal-donate', 'paypal_donate' );

// Add Twitter Shortcode #asd-modified
function twitter_feed( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'twitter_id' => 'twitter_id',
			'twitter_name' => 'twitter_name',
		), $atts )
	);
	// Code
$output = false;
	if (is_String($twitter_id) && trim($twitter_id) != '' && $twitter_id != 'twitter-id') {
		$script = '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'."'http'".":"."'https'".';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';

		$output = '<a class="twitter-timeline" href="https://twitter.com/'.trim($twitter_name).'" data-widget-id="'.$twitter_id.'">Tweets by @'.trim($twitter_name).'</a>'.$script;

	} 	
	return $output;
}

add_shortcode( 'twitter-feed', 'twitter_feed' );

//Loads custom stylesheets #asd-modified

function custom_style_sheets()  
{  

   wp_register_style('doc-search','http://alpineschools.org/assets/functions/doc_search/css/search-primary.css');
   wp_enqueue_style('doc-search');
}  
add_action( 'wp_enqueue_scripts', 'custom_style_sheets' );   

//Loads custom javascript #asd-modified

function custom_scripts()  
{  

    wp_register_script('mix-it-up','//cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js');
    //wp_enqueue_script( 'mix-it-up' );
    wp_register_script('autocomplete', '//cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.2.7/jquery.devbridge-autocomplete.min.js');
    //wp_enqueue_script('autocomplete');
    wp_register_script('jquery-cookie', '//cdn.jsdelivr.net/jquery.cookie/1.4.1/jquery.cookie.min.js');
    wp_enqueue_script('jquery-cookie');
    wp_register_script('click-and-search','http://alpineschools.org/assets/functions/click_stats/js/click-stats.js');
    //wp_enqueue_script('click-and-search');
    wp_register_script('feedback','http://alpineschools.org/assets/js/feedback.js');
    wp_enqueue_script('feedback');
    wp_register_script('scroll-depth','//cdnjs.cloudflare.com/ajax/libs/jquery-scrolldepth/0.6/jquery.scrolldepth.min.js');
    wp_enqueue_script( 'scroll-depth' ); 



}  
add_action( 'wp_enqueue_scripts', 'custom_scripts');



//Woocommerce Code for Warehouse
if (get_current_blog_id() == 44) {

	/**
	 * Check if WooCommerce is active
	 **/
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	    // Put your plugin code here
	    //fixes woocommerce jquery cookie issue
		add_action( 'wp_enqueue_scripts', 'custom_frontend_scripts' );function custom_frontend_scripts() {global $post, $woocommerce;

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? : '.min';
		wp_deregister_script( 'jquery-cookie' );
		wp_register_script( 'jquery-cookie', $woocommerce->plugin_url() . '/assets/js/jquery-cookie/jquery_cookie' . $suffix . '.js', array( 'jquery' ), '1.3.1', true );

		}
	}	

}

?>