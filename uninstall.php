<?php
// si este fichero no es ejecutado por Wordpress, exit()
if (!defined('WP_UNINSTALL_PLUGIN')) { die; }

// borrar opciones
//$option_name = 'wporg_option';
//delete_option($option_name);
 
// for site options in Multisite
//delete_site_option($option_name);
 
// drop a custom database table
global $wpdb;
$table = $wpdb->prefix . 'miPrimerPlugin';
$sql = 'DROP TABLE IF EXISTS '.$table;  
$wpdb->query($sql);