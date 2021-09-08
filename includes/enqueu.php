<?php

namespace dcms\we\includes;

// Custom post type class
class Enqueu{

    public function __construct(){
        add_action('admin_enqueue_scripts', [$this, 'register_scripts_backend']);
    }

    // Backend scripts
    public function register_scripts_backend(){
        wp_register_script('we-vue',
                            DCMS_WE_URL.'/library/vue.min.js',
                            [],
                            DCMS_WE_VERSION,
                            true);

        wp_register_script('we-search-replace-script',
                            DCMS_WE_URL.'/assets/script.js',
                            ['jquery', 'we-vue'],
                            DCMS_WE_VERSION,
                            true);


        wp_register_style('we-search-replace-style',
                            DCMS_WE_URL.'/assets/style.css',
                            [],
                            DCMS_WE_VERSION );
    }

}