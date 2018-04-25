<?php
/*
Plugin Name: products
Plugin URI: http://fyaconiello.github.com/wp-plugin-template
Description: This plugin adds a cpt called product and allows user to add products 
Version: 1.0
Author: Shawn Memone
Author URI: http://www.yaconiello.com
License: GPL2
*/
if(!class_exists('Product_class'))
{
    class Product_class
    {
        /**
         * Construct the plugin object
         */
        public function __construct()
        {
            // register actions
            add_action('init', array( $this,'product_new'));
            add_action('init', array( $this,'product_taxonomies'));
            add_action( 'add_meta_boxes', array( $this, 'add_products_meta' ) );
            add_action( 'save_post', array( $this, 'cd_meta_box_save' ) ); 
        } // END public function __construct
    
    public function product_new() {

         $labels = array(
            'name' => __( 'Products'),
            'singular_name' => __( 'Products'),
            'add_new_item' => __( 'Add New Products'),
            'edit_item' => __( 'Edit Products'),
            'new_item' => __( 'New Products' ),
            'not_found' => __( 'No Products found' ),
            'all_items' => __( 'All Products'),
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'has_archive' => true,
            'map_meta_cap' => true,
            'menu_icon' => 'dashicons-carrot',      
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author', 'custom-fields','background-color' ),
            'taxonomies' => array( 'food-type' ),
        );
        register_post_type( 'Products', $args );
    }

    //Register Texonomies

   public function product_taxonomies(){
        $labels = array(
            'name' => __( 'Product type'),
            'label' => __( 'Product type'),
            'add_new_item' => __( 'Add New type'),
        );
        $args = array(
            'labels' => $labels,
            'label' => __( 'type'),
            'show_ui' => true,
            'show_admin_column' => true
        );
        register_taxonomy( 'Product-type', array( 'products' ), $args );
    }


      public  function add_products_meta() {
        add_meta_box(
            'my-meta-box',
            __( 'My Meta Box', 'textdomain' ),
            array( $this, 'render_metabox' ),
            'products',
            'advanced',
            'default'
            );
    }
     
        public function render_metabox() 
        {
            global $post;
            // Metabox content
?>
        <label for="my_meta_box_text">Background Color</label>
        <input type="text" name="my_meta_box_text" id="my_meta_box_text" value="<?php echo get_post_meta($post->ID, 'my_meta_box_text', true); ?>">   
    <?php 
        }





  public function cd_meta_box_save($post_id)
{
    //global $post;
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    //if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
     

     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['my_meta_box_text'] ) )
        update_post_meta( $post_id, 'my_meta_box_text', $_POST['my_meta_box_text'] );
         
         
}

    } // END class WP_Plugin_Template
} // END if(!class_exists('WP_Plugin_Template'))
$wp_plugin_template = new Product_class();
// Installation and uninstallation hooks
register_activation_hook( __FILE__, array('Product_Class', 'activate'));
register_deactivation_hook( __FILE__, array('Product_Class', 'deactivate'));