<?php 
/// file function
add_action( 'add_meta_boxes', 'add_sidebar_metabox' );
add_action( 'save_post', 'save_sidebar_postdata' );
 
/* Adds a box to the side column on the Post and Page edit screens */
function add_sidebar_metabox()
{
    add_meta_box( 
        'custom_sidebar',
        __( 'Custom Sidebar', 'twentyeleven' ),
        'custom_sidebar_callback',
        'post',
        'side'
    );
    add_meta_box( 
        'custom_sidebar',
        __( 'Custom Sidebar', 'twentyeleven' ),
        'custom_sidebar_callback',
        'page',
        'side'
    );
}

function custom_sidebar_callback( $post )
{
    global $wp_registered_sidebars;
     
    $custom = get_post_custom($post->ID);
     
    if(isset($custom['custom_sidebar']))
        $val = $custom['custom_sidebar'][0];
    else
        $val = "default";
 
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'custom_sidebar_nonce' );
 
    // The actual fields for data entry
    $output = '<p><label for="myplugin_new_field">'.__("Choose a sidebar to display", 'twentyeleven' ).'</label></p>';
    $output .= "<select name='custom_sidebar'>";
 
    // Add a default option
    $output .= "<option";
    if($val == "default")
        $output .= " selected='selected'";
    $output .= " value='Select'>".__('Select', $themename)."</option>";
     
    // Fill the select element with all registered sidebars
    foreach($wp_registered_sidebars as $sidebar_id => $sidebar)
    {
        $output .= "<option";
        if($sidebar_id == $val)
            $output .= " selected='selected'";
        $output .= " value='".$sidebar_id."'>".$sidebar['name']."</option>";
    }
   
    $output .= "</select>";
     
    echo $output;
}
function save_sidebar_postdata( $post_id )
{
    // verify if this is an auto save routine. 
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;
 
    // verify this came from our screen and with proper authorization,
    // because save_post can be triggered at other times
 
    if ( !wp_verify_nonce( $_POST['custom_sidebar_nonce'], plugin_basename( __FILE__ ) ) )
      return;
 
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
 
    $data = $_POST['custom_sidebar'];
 
    update_post_meta($post_id, "custom_sidebar", $data);
}
// call 

                            $options = get_post_custom(get_the_ID());
 
                                if(isset($options['custom_sidebar']))
                                {
                                    //$sidebar_choice = ;
                                     dynamic_sidebar( $options['custom_sidebar'][0] ); 
                                }
                                else
                                {
                                    dynamic_sidebar( 'sidebar-2' ); 
                                }
                            ?>
