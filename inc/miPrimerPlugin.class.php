<?php
/**
 * MiPrimerPlugin  
 * Clase de ejemplo que gestiona el Plugin de WordPress "MiPrimerPlugin"
 * 
 * @author José Luis Rojo Sánchez
 */

class miPrimerPlugin {

    /**
     * Activación del Plugin
     * @desc creación de tablas personalizadas 
     */
     public function activation() {  
      
        global $wpdb;
        $table = $wpdb->prefix . 'miPrimerPlugin';

        $sql = 'CREATE TABLE IF NOT EXISTS '.$table.' (
          `id` int(9) NOT NULL AUTO_INCREMENT,
          `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,          
          `nombre` varchar(50) DEFAULT NULL,
          `description` text,
          PRIMARY KEY (`id`),
          KEY nombre (nombre)
        ) COLLATE '.$wpdb->collate;  
       
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
             
    }   

    /**
     * menus
     * @desc inclusión de menus y submenús al Plugin
     */
    public function addAdminMenu() {

        // main menu
        add_menu_page('Mi Plugin', 'Mi Plugin', 'manage_options', 'mi-plugin', [ __CLASS__, 'pageDashboard' ], 'dashicons-visibility');
        
        // submenus
        add_submenu_page('mi-plugin', 'SubMenu 1', 'SubMenu 1', 'manage_options', "mi-plugin-submenu-1", [ __CLASS__, 'pageSubMenu1' ] );
        add_submenu_page('mi-plugin', 'SubMenu 2', 'SubMenu 2', 'manage_options', "mi-plugin-submenu-2", [ __CLASS__, 'pageSubMenu2' ] );

        // opciones
        add_options_page ('My Options', 'My Plugin', 'manage_options', 'my-plugin.php', 'my_plugin_page' );

    }

    /**
     * Pagina: dashboard
     */
    static function pageDashboard() {
    
        include _MY_PLUGIN_DIR.'admin/dashboard.php';
        
    }

    public function pageSubmenu1 () { }
    public function pageSubmenu2 () { }

    /**
     * Scripts
     * @desc inclusión de scripts a nuestro plugin
     */
    public function addScripts() {

        $_pages = [
            'mi-plugin',
            'mi-plugin-submenu-1',
            'mi-plugin-submenu-2'
        ];       

        // cargar scripts sólo en las páginas de nuestro plugin
        if ( in_array(FILTER_INPUT(INPUT_GET, 'page'), $_pages )) {    
            wp_enqueue_style( 'mi-plugin-css', _MY_PLUGIN_DIR_URL . 'assets/css/style.css', [], null, false );
            wp_enqueue_script( 'mi-plugin-js', _MY_PLUGIN_DIR_URL . 'assets/js/test.js', [], null, false );
        }

    }

}