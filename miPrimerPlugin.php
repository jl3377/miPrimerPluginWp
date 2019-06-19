<?php
/**
 * Plugin Name: Mi primer Plugin de WordPress
 * Plugin URI: https://wwww.artegrafico.net
 * Description: Aprendiendo a crear Plugins con WordPress 
 * Author: José Luis Rojo Sánchez
 * Author URI: https://wwww.artegrafico.net
 * Version: 1.0
 * Date: 2019-07-01
 * License: GPLv2
 * Text Domain: miPrimerPlugin
*/

define ( '_MY_PLUGIN_DIR', plugin_dir_path(__FILE__) );
define ( '_MY_PLUGIN_DIR_URL', plugin_dir_url(__FILE__) );

if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {    

    require_once( _MY_PLUGIN_DIR . 'inc/miPrimerPlugin.class.php' );    
    $miPrimerPlugin = new miPrimerPlugin();  
    $miPrimerPlugin->init();

    // activation de plugin
    register_activation_hook( __FILE__, [ $miPrimerPlugin, 'activation' ] );    
   
}