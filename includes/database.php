<?php

namespace dcms\we\includes;

class Database{
    private $wpdb;

    public function __construct(){
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    // Get users that can write
    public function get_authors(){
        $result = [];
        $authors = get_users( [ 'role__in' => [ 'author', 'editor', 'Administrator', 'Contributor'] ]);

        foreach($authors as $author){
            $result[$author->data->ID] = $author->data->display_name;
        }
        return $result;
    }


    // Get entries' bye user id
    public function get_entries_author($id_user){
        $post_table = $this->wpdb->prefix . 'posts';

        $sql = "SELECT id, post_title AS title, post_date AS created, post_modified AS modified
                                    FROM {$post_table}
                                    WHERE post_status IN ('publish', 'draft')
                                        AND post_type = 'post'
                                        AND post_author = {$id_user}
                                    ORDER BY post_modified DESC";

        $entries = $this->wpdb->get_results($sql);

        return $entries;
    }
}

