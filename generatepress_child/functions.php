<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file. 
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

function generatepress_child_enqueue_scripts() {
	if ( is_rtl() ) {
		wp_enqueue_style( 'generatepress-rtl', trailingslashit( get_template_directory_uri() ) . 'rtl.css' );
	}
}

function print_menu_shortcode($atts, $content = null) {
	extract(shortcode_atts(array( 'name' => null, 'class' => null ), $atts));
	return wp_nav_menu( array( 'menu' => $name, 'menu_class' => $class, 'echo' => false ) );
}

function single_post_title_before( $post_id, $attributes ) {
  if (get_post_type($post_id) =="events") {
   $event_category = get_field( 'event_category',$post_id );
    echo  "<p class=\"events-data-text\"><i class=\"fa fa-bookmark\" aria-hidden=\"true\"></i><span class=\"events-icon-padding\">$event_category</span></p>";
   }
} 



function single_post_meta_before( $post_id, $attributes ) {
  if (get_post_type($post_id) =="events") {
//get_field('custom_field_name',Post_ID); to get the value of ACF custom field
      $event_subtitle = get_field( 'event_subtitle', $post_id );
      $event_strat_date = get_field( 'event_strat_date', $post_id );
      $event_end_date = get_field( 'event_end_date', $post_id );
      $event_time = get_field( 'event_time', $post_id );
      $event_location = get_field( 'event_location', $post_id );

      
echo  "<p class=\" event-subtitle\">$event_subtitle</p>";
echo '<div class="events-data">';
echo  "<p class=\" events-data-text\"><i class=\"fa fa-map-marker\" aria-hidden=\"true\"></i><span class=\"events-icon-padding\">$event_location</span></p>";

if ($event_time) {
  $st =  "<span style=\" padding-right: 30px; \"><i class=\"fa fa-clock\" aria-hidden=\"true\"></i><span class=\"events-icon-padding\">$event_time</span></span>";
}

if ($event_end_date) {
   echo  "<p class=\" events-data-text\">$st<i class=\"fa fa-calendar\" aria-hidden=\"true\"> </i><span class=\"events-icon-padding\">$event_strat_date - $event_end_date</span></p>";
}

else  {
 echo  "<p class=\"events-data-text\">$st<i class=\"fa fa-calendar\" aria-hidden=\"true\"> </i><span class=\"events-icon-padding\">$event_strat_date 2020</span></p>";
}

echo '</div>';
}

}

function single_post_cta_before( $post_id, $attributes ) {
  if (get_post_type($post_id) =="newbooks") {
    $cover_image = get_the_post_thumbnail_url( $post_id, 'full' );//get_field( 'cover_image', $post_id );
    $newbook_title = mb_strimwidth(get_field( 'newbook_title', $post_id ), 0, 50, "...");
    $newbook_author = get_field( 'newbook_author', $post_id );
    $newbook_filial = get_field( 'newbook_filial', $post_id );


    echo ' <div class="book-card-wrapper"><a href="'.get_permalink($post_id ).'"><div class="book-card">
    <div class="book-card__cover">
      <div class="book-card__book">
        <div class="book-card__book-front">
          <img class="book-card__img" src="'.$cover_image.'" />
        </div>
        <div class="book-card__book-back"></div>
        <div class="book-card__book-side"></div>
      </div>
    </div>
    <div class="book-card__text-block">

      <div class="book-card__title">
         <span>'.$newbook_title.'</span>
      </div>

      <div class="book-card__author">
        '.$newbook_author.'
      </div>

       <div class="book-card__filial"><i class="fa fa-building" aria-hidden="true"></i><span class="book-card-icon-padding">
        '.$newbook_filial.'
</span>
      </div>
    </div>
  </div></a></div>'; 
}
} 
add_action( 'uagb_single_post_before_cta_grid', 'single_post_cta_before', 10, 2 );

add_action( 'uagb_single_post_before_cta_carousel', 'single_post_cta_before', 10, 2 );

add_action( 'uagb_single_post_before_title_grid', 'single_post_title_before', 10, 2 );
add_action( 'uagb_single_post_before_meta_grid', 'single_post_meta_before', 10, 2 );


//function bootstrapstarter_enqueue_styles() {
//    wp_register_style('bootstrap', get_theme_file_uri('/css/grid.min.css' ));
//    $dependencies = array('bootstrap');
//    wp_enqueue_style( 'bootstrapstarter-style',  get_theme_file_uri('/css/grid.min.css' ), $dependencies ); 
//}

//function bootstrapstarter_enqueue_scripts() {
//    $dependencies = array('jquery');
//    wp_enqueue_script('bootstrap', get_theme_file_uri('/js/bootstrap.min.js'), $dependencies, '3.3.6', true );
//}

add_action( 'wp_enqueue_scripts', 'generatepress_child_enqueue_scripts', 100 );
add_shortcode('menu', 'print_menu_shortcode');
//add_action( 'wp_enqueue_scripts', 'bootstrapstarter_enqueue_styles' );
//add_action( 'wp_enqueue_scripts', 'bootstrapstarter_enqueue_scripts' );