<?php

    add_action('wp_ajax_get_acf_field', 'get_acf_field');
    add_action('wp_ajax_nopriv_get_acf_field', 'get_acf_field');

    add_action('wp_ajax_get_title_by_id', 'get_title_by_id');
    add_action('wp_ajax_nopriv_get_title_by_id', 'get_title_by_id');


    function get_acf_field() {
        if( function_exists('get_field') ) {
            echo json_encode(get_field($_POST['name'], $_POST['post_id']));
        }
        die;
    }

    function get_title_by_id() {
        echo json_encode(get_the_title($_POST['post_id']));
        die;
    }