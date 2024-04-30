<?php

/**
 * Plugin Name: Responsive Tabs
 * Description: Extend custom tabs for woocommerce product page
 * Version: 1.0
 * Text Domain: responsivetabs
 * Author: Sara Medhat
 * Author URI: https://www.linkedin.com/in/sara-m-elskhawy/
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
//adding text domain
add_action('init', 'rtabs_load_text_domain');
function rtabs_load_text_domain(){
// 	 $loaded = load_plugin_textdomain( 'responsivetabs', false, dirname(dirname( plugin_basename( __FILE__ ) )) . '/languages/' );
	  load_plugin_textdomain( 'responsivetabs', false, dirname( plugin_basename( __FILE__ ) ) );
}

// Adding form scripts and styles
add_action('wp_enqueue_scripts', 'responsive_tabs_script');
function responsive_tabs_script()
{
    wp_enqueue_style('responsive_tabs_style', plugin_dir_url(__FILE__) . 'assets/css/tabs.css', false, '1.1', 'all');
    wp_enqueue_script('responsive_tabs_script', plugin_dir_url(__FILE__) . 'assets/js/tabs.js');
}

// adding ACF fields and display it in woocommerce tabs
add_action('woocommerce_after_single_product_summary', 'display_product_tabs', 2);
function display_product_tabs()
{ 
    global $product;
    // // Assign ACF fields
    // create ACF fields with the names typed here in the get_field
    $description_display = get_field('display_description');
    $questions_display   = get_field('display_questions');
    $product_name        = $product->get_name();
	$product_questions   = get_field('questions');
    $manual_display      = get_field('display_manual');
    $product_manual      = get_field('manual');
    $measures_display    = get_field('display_measures');
    $product_measures    = get_field('measures');
    $reviews_display     = get_field('display_reviews');
    $product_reviews     = get_reviews_tab( $product->get_id() );


    // Display the tabs
    echo '   
    <!-- Tab links -->
    <div class="tab">
        ';
        if($description_display == true){
        echo '
            <button class="tablinks" onclick="productTabs(event, \'Description\')">
                ';
            printf(__( 'Description', 'responsivetabs' ));
            echo '
                <span class="chevron">></span>
            </button>
            <p class="more" onclick="productTabs(event, \'Description\')">'. $product_name.' ...<strong>more</strong></p>
            ';
        }
        if($questions_display == true){
        echo '
            <button class="tablinks" onclick="productTabs(event, \'Questions\')">
            ';
            printf(__( 'Frequent Questions', 'responsivetabs' ));
                
            echo '		   
                <span class="chevron">></span>
            </button>
            ';
        }
        if($manual_display == true){
        echo '
            <button class="tablinks" onclick="productTabs(event, \'manual\')">
            ';
            printf(__( 'Manual', 'responsivetabs' ));
                
            echo '
                <span class="chevron">></span>
            </button>
            ';
        }
        if($measures_display == true){
        echo '
            <button class="tablinks" onclick="productTabs(event, \'measures\')">
            ';
            printf(__( 'Measures', 'responsivetabs' ));
                
                echo '
                <span class="chevron">></span>
            </button>
            ';
        }
        if($reviews_display == true){
        echo '
            <button class="tablinks" onclick="productTabs(event, \'reviews\')">
                ';
            printf(__( 'Reviews', 'responsivetabs' ));
                
            echo '
                <span class="chevron">></span>
            </button>
    
        ';
        }
        echo '
    </div>
    <!-- Tab content -->
    <div class="contentarea">
        <div id="Description" class="tabcontent description">
	      <div id="backdrop" class="backdrop" onclick="this.parentNode.style.width=\'0\'; this.parentNode.style.transition=\'width 0.5s ease\'; this.style.display=\'none\'">
          </div>
          <div class="tabheader" onclick="this.parentNode.style.width=\'0\'; this.parentNode.style.transition=\'width 0.5s ease\'; this.previousElementSibling.style.display=\'none\'">
            <div class="header">
				<span class="x">X</span>
                <h3 class="close">
					   ';
		         printf(__( 'Close Tab', 'responsivetabs' ));
	             echo '
				</h3>
            </div>
          </div>
          <div class="content">';
                the_content();
                echo '  
           </div>
        </div>
    
        <div id="Questions" class="tabcontent">
           <div id="backdrop" class="backdrop" onclick="this.parentNode.style.width=\'0\'; this.parentNode.style.transition=\'width 0.5s ease\'; this.style.display=\'none\'"></div>
            <div class="tabheader" onclick="this.parentNode.style.width=\'0\'; this.parentNode.style.transition=\'width 0.5s ease\'; this.previousElementSibling.style.display=\'none\'">
                <div class="header">
				    <span class="x">X</span>
                    <h3 class="close">
						   ';
		             printf(__( 'Close Tab', 'responsivetabs' ));
	                   echo '
					</h3>
                </div>
            </div>
            <div class="content">'. $product_questions.'</div>
        </div>
    
        <div id="manual" class="tabcontent">
            <div id="backdrop" class="backdrop" onclick="this.parentNode.style.width=\'0\'; this.parentNode.style.transition=\'width 0.5s ease\'; this.style.display=\'none\'"></div>
            <div class="tabheader" onclick="this.parentNode.style.width=\'0\'; this.parentNode.style.transition=\'width 0.5s ease\'; this.previousElementSibling.style.display=\'none\'">
                <div class="header">
				    <span class="x">X</span>
                    <h3 class="close">
						   ';
		              printf(__( 'Close Tab', 'responsivetabs' ));
	                  echo '
					</h3>
                </div>
            </div>
            <div class="content">'. $product_manual .'</div>
        </div>
    
        <div id="measures" class="tabcontent">
            <div id="backdrop" class="backdrop" onclick="this.parentNode.style.width=\'0\'; this.parentNode.style.transition=\'width 0.5s ease\'; this.style.display=\'none\'"></div>
            <div class="tabheader" onclick="this.parentNode.style.width=\'0\'; this.parentNode.style.transition=\'width 0.5s ease\'; this.previousElementSibling.style.display=\'none\'">
                <div class="header">
				    <span class="x">X</span>
                    <h3 class="close">
						   ';
	                	printf(__( 'Close Tab', 'responsivetabs' ));
	                    echo '
					</h3>
                </div>
            </div>
            <div class="content">'. $product_measures .'</div>
        </div>
    
        <div id="reviews" class="tabcontent">
            <div id="backdrop" class="backdrop" onclick="this.parentNode.style.width=\'0\'; this.parentNode.style.transition=\'width 0.5s ease\'; this.style.display=\'none\'"></div>
            <div class="tabheader" onclick="this.parentNode.style.width=\'0\'; this.parentNode.style.transition=\'width 0.5s ease\'; this.previousElementSibling.style.display=\'none\'">
                <div class="header">
                    <span class="x">X</span>
				    <h3 class="close">
						   ';
	                	printf(__( 'Close Tab', 'responsivetabs' ));
	                    echo '
					</h3>
                </div>
            </div>
            <div class="content">'. $product_reviews .'</div>
        </div>
    </div>
    ';

}
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] );      	// Remove the reviews tab

    return $tabs;
}
 
function get_reviews_tab( $product_id ) {
    
   if ( empty( $product_id ) ) return '';
 
   if ( ! isset( $product_id ) ) return '';
       
   $comments = get_comments( 'post_id=' . $product_id );
    
   if ( ! $comments ) return '';
    
   $html = '<div class="woocommerce-tabs"><div id="reviews"><ol class="commentlist">';
    
   foreach ( $comments as $comment ) { 
      $rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
      $html .= '<li class="review">';
      $html .= get_avatar( $comment, '60' );
      $html .= '<div class="comment-text">';
      if ( $rating ) $html .= wc_get_rating_html( $rating );
      $html .= '<p class="meta"><strong class="woocommerce-review__author">';
      $html .= get_comment_author( $comment );
      $html .= '</strong></p>';
      $html .= '<div class="description">';
      $html .= $comment->comment_content;
      $html .= '</div></div>';
      $html .= '</li>';
   }
    
   $html .= '</ol></div></div>';
    
   return $html;
}
