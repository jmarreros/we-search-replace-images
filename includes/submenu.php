<?php

namespace dcms\we\includes;

/**
 * Class for creating a dashboard submenu
 */
class Submenu{
    // Constructor
    public function __construct(){
        add_action('admin_menu', [$this, 'register_submenu']);
    }

    // Register submenu
    public function register_submenu(){
        add_submenu_page(
            DCMS_WE_SUBMENU,
            __('Search Replace images','dcms-we-yyyy'),
            __('Search Replace images','dcms-we-yyyy'),
            'manage_options',
            'we-search-replace-images',
            [$this, 'submenu_page_callback']
        );
    }

    // Callback, show view
    public function submenu_page_callback(){
        include_once (DCMS_WE_PATH. '/views/main-screen.php');
    }
}