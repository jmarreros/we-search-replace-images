<?php

namespace dcms\we\includes;

use dcms\we\includes\Database;

class Process{

    public function __construct(){
        add_action('wp_ajax_we_authors', [$this, 'get_authors']);
    }

    function get_authors(){

        $this->validate_nonce('ajax-admin-sr');

        $db = new Database();
        $authors = $db->get_authors();

        echo json_encode($authors);

        wp_die();
    }

    // Security, verify nonce
    private function validate_nonce( $nonce_name ){
        if ( ! wp_verify_nonce( $_POST['nonce'], $nonce_name ) ) {
            $res = [
                'status' => 0,
                'message' => '✋ Error nonce validation!!'
            ];
            echo json_encode($res);
            wp_die();
        }
    }

}

