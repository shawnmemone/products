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
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
define( 'PRODUCTS_PATH', plugin_dir_path( __FILE__ ) );
define( 'PRODUCTS_DIR_PATH', plugin_dir_url( __FILE__ ) );
// include the main plugin class file
require_once( PRODUCTS_PATH . 'classes/classes-main.php' );
$wp_plugin_template = new Product_class();
register_activation_hook( __FILE__, array('Product_Class', 'activate'));
?>
where is it ?