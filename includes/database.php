<?php

namespace dcms\we\includes;

class Database{
    private $wpdb;

    public function __construct(){
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public function get_authors(){
        $result = [];
        $authors = get_users( [ 'role__in' => [ 'author', 'editor', 'Administrator', 'Contributor'] ]);

        foreach($authors as $author){
            $result[$author->data->ID] = $author->data->display_name;
        }
        return $result;
    }

}

