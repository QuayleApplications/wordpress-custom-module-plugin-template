<?php

    add_action('wp_ajax_qcmptGetAcfField', 'qcmptGetAcfField');
    add_action('wp_ajax_nopriv_qcmptGetAcfField', 'qcmptGetAcfField');

    add_action('wp_ajax_qcmptGetTitleById', 'qcmptGetTitleById');
    add_action('wp_ajax_nopriv_qcmptGetTitleById', 'qcmptGetTitleById');


    function qcmptGetAcfField() {
        if( function_exists('get_field') ) {
            echo json_encode(get_field($_POST['name'], $_POST['post_id']));
        }
        die;
    }

    function qcmptGetTitleById() {
        echo json_encode(get_the_title($_POST['post_id']));
        die;
    }