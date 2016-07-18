<?php 
//function 
add_action( 'add_meta_boxes', 'ashu_add_custom_box' );

function ashu_add_custom_box(){

	if ( function_exists('add_meta_box') ) {

		add_meta_box( 'page_custom_menu','Page Menu', 'page_custom_menu_box', 'page');
		add_meta_box( 'page_custom_menu','Page Menu', 'page_custom_menu_box', 'category_edit');
	}

}

function page_custom_menu_box(){

	global $post;

	

	if ( metadata_exists( 'post', $post->ID, 'page_menu' ) ) {

		$menu_id = get_post_meta( $post->ID, 'page_menu', true );

	} 

	$entries = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

	echo '<select class="postform" id="page_menu" name="page_menu"> ';
	echo '<option value="">Select</option> ';


	foreach ($entries as $key => $entry){

		$id = $entry->term_id;

		$title = $entry->name;

		if ( $id == $menu_id ){

			$selected = "selected='selected'";	

		}else{

			$selected = "";		

		}

		echo"<option $selected value='". $id."'>". $title."</option>";

	}

	echo '</select>';


 

}



add_action('save_post', 'save_postdata');

function save_postdata( $post_id ) {   

    global $post;

	if( !isset($_POST['page_menu']) )

		return;

	$data = $_POST['page_menu'];
	

    if(get_post_meta($post_id, 'page_menu') == "") { 

       add_post_meta($post_id, 'page_menu', $data, true);

    }elseif($data != get_post_meta($post_id, 'page_menu', true)) { 

        update_post_meta($post_id, 'page_menu', $data); 	

    }elseif($data == "")  { 

       delete_post_meta($post_id, 'page_menu', get_post_meta($post_id, 'page_menu', true));

	}

	// $data1=$_POST['location'];
	//  if(get_post_meta($post_id, 'location') == "") { 

 //       add_post_meta($post_id, 'location', $data1, true);

 //    }elseif($data != get_post_meta($post_id, 'location', true)) { 

 //        update_post_meta($post_id, 'location', $data1); 	

 //    }elseif($data == "")  { 

 //       delete_post_meta($post_id, 'location', get_post_meta($post_id, 'location', true));

	// }

}
//call
 if (is_category()) {

//if ( get_metadata($term_id)) {

		global $post;						   

		$term_meta = get_option( "taxonomy_$term_id" ); 

		if ($term_meta) {

		wp_nav_menu( array( 'menu' => $term_meta['page_menu'] ) );

		}else{

		wp_nav_menu( array('theme_location' => 'secondary' ) );

		}
							   								 
		}else{
		if( is_page() && get_post_meta( $post->ID, 'page_menu', true )!='' ){
		global $post;
		$menu_id = get_post_meta( $post->ID, 'page_menu', true );
		wp_nav_menu( array( 'menu' => $menu_id ) );
		}else{

		wp_nav_menu( array('theme_location' => 'secondary' ) );

		}
		}

		?>
 ?>