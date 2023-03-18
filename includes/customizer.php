<?php
/**
 * WordPress Custom Module Plugin Template Settings
 *
 * @package qcmpt
 */

/**
 * Setup Global Content Panel
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function qcmptRegisterSettingsPanel( $wp_customize ) {

    //Settings
    if($wp_customize->get_panel('qcmpt_settings') !== '') {
        $wp_customize->add_panel('qcmpt_settings', array(
            'title' => PLUGIN_NAME.' Settings',
            'priority' => 120,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'description' => PLUGIN_NAME.' Settings'
        ));
    }

	//Headers & Content
	$wp_customize->add_section('qcmpt_headers_content', array(
        'title' => __( 'Headers & Content', TEXT_DOMAIN ),
        'priority' => 10,
        'panel' => 'qcmpt_settings'
	));

	//Constants
	$wp_customize->add_section('qcmpt_constants', array(
        'title' => __( 'Constants', TEXT_DOMAIN ),
        'priority' => 10,
        'panel' => 'qcmpt_settings'
	));

	//UI/UX
	$wp_customize->add_section('qcmpt_uiux', array(
        'title' => __( 'UI/UX', TEXT_DOMAIN ),
        'priority' => 10,
        'panel' => 'qcmpt_settings'
	));
}
add_action( 'customize_register', 'qcmptRegisterSettingsPanel' );

/**
 * Add Input Fields to Sections
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function qcmptFieldRegister( $wp_customize ) {
    /**
     * Headers & Content
     * */

    //Text Input
    $wp_customize->add_setting('qcmpt_text', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => '',
        'sanitize_callback' => 'qcmptSanitizeNohtml'
    ));
    $wp_customize->add_control( 'qcmpt_text', array(
        'label'   => __( 'Text Input', TEXT_DOMAIN ),
        'description' => __( 'This is a Text Input', TEXT_DOMAIN ),
        'section'  => 'qcmpt_headers_content',
        'type'    => 'text',
    ));

    //Textarea
    $wp_customize->add_setting('qcmpt_textarea', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => '',
        'sanitize_callback' => 'qcmptSanitizeNohtml'
    ));
    $wp_customize->add_control( 'qcmpt_textarea', array(
        'label'   => __( 'Textarea', TEXT_DOMAIN ),
        'description' => __( 'This is a Textarea', TEXT_DOMAIN ),
        'section'  => 'qcmpt_headers_content',
        'type'    => 'textarea',
    ));

    //Email
    $wp_customize->add_setting('qcmpt_email', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => '',
        'sanitize_callback' => 'qcmptSanitizeEmail'
    ));
    $wp_customize->add_control( 'qcmpt_email', array(
        'label'   => __( 'Email', TEXT_DOMAIN ),
        'description' => __( 'This is an email input', TEXT_DOMAIN ),
        'section'  => 'qcmpt_headers_content',
        'type'    => 'email',
    ));

    //URL
    $wp_customize->add_setting('qcmpt_url', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => '',
        'sanitize_callback' => 'qcmptSanitizeUrl'
    ));
    $wp_customize->add_control( 'qcmpt_url', array(
        'label'   => __( 'URL', TEXT_DOMAIN ),
        'description' => __( 'This is an url input', TEXT_DOMAIN ),
        'section'  => 'qcmpt_headers_content',
        'type'    => 'url',
    ));

    //Telephone
    $wp_customize->add_setting('qcmpt_tel', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => '',
        'sanitize_callback' => 'qcmptSanitizeNumberRange'
    ));
    $wp_customize->add_control( 'qcmpt_tel', array(
        'label'   => __( 'Telephone Number', TEXT_DOMAIN ),
        'description' => __( 'This is a tel input', TEXT_DOMAIN ),
        'section'  => 'qcmpt_headers_content',
        'type'    => 'tel',
    ));

    /**
     * Constants
     * */

    //Range
    $wp_customize->add_setting('qcmpt_range', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => '',
        'sanitize_callback' => 'qcmptSanitizeNumberRange'
    ));
    $wp_customize->add_control('qcmpt_range', array(
        'type' => 'range',
        'section' => 'qcmpt_constants',
        'label' => __( 'Range', TEXT_DOMAIN ),
        'description' => __( 'This is the range control description.', TEXT_DOMAIN ),
        'input_attrs' => array(
            'min' => 0,
            'max' => 10,
            'step' => 2,
        ),
    ) );

    //Time
    $wp_customize->add_setting('qcmpt_time', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => '',
        'sanitize_callback' => ''
    ));
    $wp_customize->add_control( 'qcmpt_time', array(
        'label'   => __( 'Time', TEXT_DOMAIN ),
        'description' => __( 'This is a time input', TEXT_DOMAIN ),
        'section'  => 'qcmpt_constants',
        'type'    => 'time',
    ));

    //Date
    $wp_customize->add_setting('qcmpt_date', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => '',
        'sanitize_callback' => ''
    ));
    $wp_customize->add_control( 'qcmpt_date', array(
        'label'   => __( 'Date', TEXT_DOMAIN ),
        'description' => __( 'This is a date input', TEXT_DOMAIN ),
        'section'  => 'qcmpt_constants',
        'type'    => 'date',
    ));

    //Radio
    $wp_customize->add_setting( 'qcmpt_radio', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'blue',
        'sanitize_callback' => 'qcmptSanitizeSelect',
    ) );

    $wp_customize->add_control( 'qcmpt_radio', array(
        'type' => 'radio',
        'section' => 'qcmpt_constants',
        'label' => __( 'Radio Selection', TEXT_DOMAIN ),
        'description' => __( 'This is a custom radio input.', TEXT_DOMAIN ),
        'choices' => array(
            'red' => __( 'Red', TEXT_DOMAIN ),
            'blue' => __( 'Blue', TEXT_DOMAIN ),
            'green' => __( 'Green', TEXT_DOMAIN ),
        ),
    ) );

    //Select
    $wp_customize->add_setting( 'qcmpt_select', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'qcmptSanitizeSelect',
        'default' => 'value1',
      ) );
      
      $wp_customize->add_control( 'qcmpt_select', array(
        'type' => 'select',
        'section' => 'qcmpt_constants', 
        'label' => __( 'Custom Select Option' ),
        'description' => __( 'This is a custom select option.' ),
        'choices' => array(
          'value1' => __( 'Value 1' ),
          'value2' => __( 'Value 2' ),
          'value3' => __( 'Value 3' ),
        ),
      ) );

    /**
     * UI/UX
     * */
    
    //Color Selector
    $wp_customize->add_setting('qcmpt_color_control', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => '',
        'sanitize_callback' => 'qcmptSanitizeHexColor'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'qcmpt_color_control', array(
        'label' => __( 'Select Color', TEXT_DOMAIN ),
        'section' => 'qcmpt_uiux',
    ) ) );

    //Image Upload
    $wp_customize->add_setting('qcmpt_image_control', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => '',
        'sanitize_callback' => 'qcmptSanitizeImage'
    ));
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'qcmpt_image_control', array(
        'label' => __( 'Image Upload', TEXT_DOMAIN ),
        'section' => 'qcmpt_uiux',
        'mime_type' => 'image',
    ) ) );

    //Custom CSS
    $wp_customize->add_setting('qcmpt_css', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => '',
        'sanitize_callback' => 'qcmptSanitizeCss'
    ));  
    $wp_customize->add_control( 'qcmpt_css', array(
        'label'   => __( 'Plugin Specific CSS', TEXT_DOMAIN ),
        'description' => __( '', TEXT_DOMAIN ),
        'section'  => 'qcmpt_uiux',
        'type'    => 'textarea',
    ));  

}
add_action( 'customize_register', 'qcmptFieldRegister' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function qcmptCustomizePreviewJs() {
	wp_enqueue_script( 'qcmpt-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20230319', true );
}
add_action( 'customize_preview_init', 'qcmptCustomizePreviewJs' );
