<?php
if( !function_exists('slugify') ) {
  /**
   * Slugify
   * @param $text
   */
  function slugify($text) {
    $text = preg_replace("/[^A-Za-z0-9 -]/", '', $text);
  	$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
  	$text = trim($text, '-');
  	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  	$text = strtolower($text);
  	$text = preg_replace('~[^-\w]+~', '', $text);

  	if (empty($text)) {
  		return 'n-a';
  	}

  	return $text;
  }
}

if( !function_exists('qcmptAutoCopyright') ) {
  /**
   * Auto Copyright
   * @param $year
   */
  function qcmptAutoCopyright($year = 'auto'){
    if(intval($year) == 'auto'){ $year = date('Y'); }
    if(intval($year) == date('Y')){ echo intval($year); }
    if(intval($year) < date('Y')){ echo intval($year) . ' - ' . date('Y'); }
    if(intval($year) > date('Y')){ echo date('Y'); }
  }
}

/**
 * Customizer: Sanitization Callbacks
 *
 * This file demonstrates how to define sanitization callback functions for various data types.
 *
 * @package   code-examples
 * @copyright Copyright (c) 2015, WordPress Theme Review Team
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 */

if( !function_exists('qcmptSanitizeCheckbox') ) {
  /**
   * Checkbox sanitization callback example.
   *
   * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
   * as a boolean value, either TRUE or FALSE.
   *
   * @param bool $checked Whether the checkbox is checked.
   * @return bool Whether the checkbox is checked.
   */
  function qcmptSanitizeCheckbox( $checked ) {
  	// Boolean check.
  	return ( (  !empty( $checked ) && true == $checked ) ? true : false );
  }
}

if( !function_exists('qcmptSanitizeCss') ) {
  /**
   * CSS sanitization callback example.
   *
   * - Sanitization: css
   * - Control: text, textarea
   *
   * Sanitization callback for 'css' type textarea inputs. This callback sanitizes
   * `$css` for valid CSS.
   *
   * NOTE: wp_strip_all_tags() can be passed directly as `$wp_customize->add_setting()`
   * 'sanitize_callback'. It is wrapped in a callback here merely for example purposes.
   *
   * @see wp_strip_all_tags() https://developer.wordpress.org/reference/functions/wp_strip_all_tags/
   *
   * @param string $css CSS to sanitize.
   * @return string Sanitized CSS.
   */
  function qcmptSanitizeCss( $css ) {
  	return wp_strip_all_tags( $css );
  }
}

if( !function_exists('qcmptSanitizeDropdownPages') ) {
  /**
   * Drop-down Pages sanitization callback example.
   *
   * - Sanitization: dropdown-pages
   * - Control: dropdown-pages
   *
   * Sanitization callback for 'dropdown-pages' type controls. This callback sanitizes `$page_id`
   * as an absolute integer, and then validates that $input is the ID of a published page.
   *
   * @see absint() https://developer.wordpress.org/reference/functions/absint/
   * @see get_post_status() https://developer.wordpress.org/reference/functions/get_post_status/
   *
   * @param int                  $page    Page ID.
   * @param WP_Customize_Setting $setting Setting instance.
   * @return int|string Page ID if the page is published; otherwise, the setting default.
   */
  function qcmptSanitizeDropdownPages( $page_id, $setting ) {
  	// Ensure $input is an absolute integer.
  	$page_id = absint( $page_id );

  	// If $page_id is an ID of a published page, return it; otherwise, return the default.
  	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
  }
}

if( !function_exists('qcmptSanitizeEmail') ) {
  /**
   * Email sanitization callback example.
   *
   * - Sanitization: email
   * - Control: text
   *
   * Sanitization callback for 'email' type text controls. This callback sanitizes `$email`
   * as a valid email address.
   *
   * @see sanitize_email() https://developer.wordpress.org/reference/functions/sanitize_key/
   * @link sanitize_email() https://codex.wordpress.org/Function_Reference/sanitize_email
   *
   * @param string               $email   Email address to sanitize.
   * @param WP_Customize_Setting $setting Setting instance.
   * @return string The sanitized email if not null; otherwise, the setting default.
   */
  function qcmptSanitizeEmail( $email, $setting ) {
  	// Strips out all characters that are not allowable in an email address.
  	$email = sanitize_email( $email );

  	// If $email is a valid email, return it; otherwise, return the default.
  	return ( ! is_null( $email ) ? $email : $setting->default );
  }
}

if( !function_exists('qcmptSanitizeHexColor') ) {
  /**
   * HEX Color sanitization callback example.
   *
   * - Sanitization: hex_color
   * - Control: text, WP_Customize_Color_Control
   *
   * Note: sanitize_hex_color_no_hash() can also be used here, depending on whether
   * or not the hash prefix should be stored/retrieved with the hex color value.
   *
   * @see sanitize_hex_color() https://developer.wordpress.org/reference/functions/sanitize_hex_color/
   * @link sanitize_hex_color_no_hash() https://developer.wordpress.org/reference/functions/sanitize_hex_color_no_hash/
   *
   * @param string               $hex_color HEX color to sanitize.
   * @param WP_Customize_Setting $setting   Setting instance.
   * @return string The sanitized hex color if not null; otherwise, the setting default.
   */
  function qcmptSanitizeHexColor( $hex_color, $setting ) {
  	// Sanitize $input as a hex value without the hash prefix.
  	$hex_color = sanitize_hex_color( $hex_color );

  	// If $input is a valid hex value, return it; otherwise, return the default.
  	return ( ! is_null( $hex_color ) ? $hex_color : $setting->default );
  }
}

if( !function_exists('qcmptSanitizeHtml') ) {
  /**
   * HTML sanitization callback example.
   *
   * - Sanitization: html
   * - Control: text, textarea
   *
   * Sanitization callback for 'html' type text inputs. This callback sanitizes `$html`
   * for HTML allowable in posts.
   *
   * NOTE: wp_filter_post_kses() can be passed directly as `$wp_customize->add_setting()`
   * 'sanitize_callback'. It is wrapped in a callback here merely for example purposes.
   *
   * @see wp_filter_post_kses() https://developer.wordpress.org/reference/functions/wp_filter_post_kses/
   *
   * @param string $html HTML to sanitize.
   * @return string Sanitized HTML.
   */
  function qcmptSanitizeHtml( $html ) {
  	return wp_filter_post_kses( $html );
  }
}

if( !function_exists('qcmptSanitizeImage') ) {
  /**
   * Image sanitization callback example.
   *
   * Checks the image's file extension and mime type against a whitelist. If they're allowed,
   * send back the filename, otherwise, return the setting default.
   *
   * - Sanitization: image file extension
   * - Control: text, WP_Customize_Image_Control
   *
   * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
   *
   * @param string               $image   Image filename.
   * @param WP_Customize_Setting $setting Setting instance.
   * @return string The image filename if the extension is allowed; otherwise, the setting default.
   */
  function qcmptSanitizeImage( $image, $setting ) {
  	/*
  	 * Array of valid image file types.
  	 *
  	 * The array includes image mime types that are included in wp_get_mime_types()
  	 */
      $mimes = array(
          'jpg|jpeg|jpe' => 'image/jpeg',
          'gif'          => 'image/gif',
          'png'          => 'image/png',
          'bmp'          => 'image/bmp',
          'tif|tiff'     => 'image/tiff',
          'ico'          => 'image/x-icon'
      );
  	// Return an array with file extension and mime_type.
      $file = wp_check_filetype( $image, $mimes );
  	// If $image has a valid mime_type, return it; otherwise, return the default.
      return ( $file['ext'] ? $image : $setting->default );
  }
}

if( !function_exists('qcmptSanitizeNohtml') ) {
  /**
   * No-HTML sanitization callback example.
   *
   * - Sanitization: nohtml
   * - Control: text, textarea, password
   *
   * Sanitization callback for 'nohtml' type text inputs. This callback sanitizes `$nohtml`
   * to remove all HTML.
   *
   * NOTE: wp_filter_nohtml_kses() can be passed directly as `$wp_customize->add_setting()`
   * 'sanitize_callback'. It is wrapped in a callback here merely for example purposes.
   *
   * @see wp_filter_nohtml_kses() https://developer.wordpress.org/reference/functions/wp_filter_nohtml_kses/
   *
   * @param string $nohtml The no-HTML content to sanitize.
   * @return string Sanitized no-HTML content.
   */
  function qcmptSanitizeNohtml( $nohtml ) {
  	return wp_filter_nohtml_kses( $nohtml );
  }
}

if( !function_exists('qcmptSanitizeNumberAbsint') ) {
  /**
   * Number sanitization callback example.
   *
   * - Sanitization: number_absint
   * - Control: number
   *
   * Sanitization callback for 'number' type text inputs. This callback sanitizes `$number`
   * as an absolute integer (whole number, zero or greater).
   *
   * NOTE: absint() can be passed directly as `$wp_customize->add_setting()` 'sanitize_callback'.
   * It is wrapped in a callback here merely for example purposes.
   *
   * @see absint() https://developer.wordpress.org/reference/functions/absint/
   *
   * @param int                  $number  Number to sanitize.
   * @param WP_Customize_Setting $setting Setting instance.
   * @return int Sanitized number; otherwise, the setting default.
   */
  function qcmptSanitizeNumberAbsint( $number, $setting ) {
  	// Ensure $number is an absolute integer (whole number, zero or greater).
  	$number = absint( $number );

  	// If the input is an absolute integer, return it; otherwise, return the default
  	return ( $number ? $number : $setting->default );
  }
}

if( !function_exists('qcmptSanitizeNumberRange') ) {
  /**
   * Number Range sanitization callback example.
   *
   * - Sanitization: number_range
   * - Control: number, tel
   *
   * Sanitization callback for 'number' or 'tel' type text inputs. This callback sanitizes
   * `$number` as an absolute integer within a defined min-max range.
   *
   * @see absint() https://developer.wordpress.org/reference/functions/absint/
   *
   * @param int                  $number  Number to check within the numeric range defined by the setting.
   * @param WP_Customize_Setting $setting Setting instance.
   * @return int|string The number, if it is zero or greater and falls within the defined range; otherwise,
   *                    the setting default.
   */
  function qcmptSanitizeNumberRange( $number, $setting ) {

  	// Ensure input is an absolute integer.
  	$number = absint( $number );

  	// Get the input attributes associated with the setting.
  	$atts = $setting->manager->get_control( $setting->id )->input_attrs;

  	// Get minimum number in the range.
  	$min = (  !empty( $atts['min'] ) ? $atts['min'] : $number );

  	// Get maximum number in the range.
  	$max = (  !empty( $atts['max'] ) ? $atts['max'] : $number );

  	// Get step.
  	$step = (  !empty( $atts['step'] ) ? $atts['step'] : 1 );

  	// If the number is within the valid range, return it; otherwise, return the default
  	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
  }
}

if( !function_exists('qcmptSanitizeSelect') ) {
  /**
   * Select sanitization callback example.
   *
   * - Sanitization: select
   * - Control: select, radio
   *
   * Sanitization callback for 'select' and 'radio' type controls. This callback sanitizes `$input`
   * as a slug, and then validates `$input` against the choices defined for the control.
   *
   * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
   * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
   *
   * @param string               $input   Slug to sanitize.
   * @param WP_Customize_Setting $setting Setting instance.
   * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
   */
  function qcmptSanitizeSelect( $input, $setting ) {

  	// Ensure input is a slug.
  	$input = sanitize_key( $input );

  	// Get list of choices from the control associated with the setting.
  	$choices = $setting->manager->get_control( $setting->id )->choices;

  	// If the input is a valid key, return it; otherwise, return the default.
  	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
  }
}

if( !function_exists('qcmptSanitizeUrl') ) {
  /**
   * URL sanitization callback example.
   *
   * - Sanitization: url
   * - Control: text, url
   *
   * Sanitization callback for 'url' type text inputs. This callback sanitizes `$url` as a valid URL.
   *
   * NOTE: esc_url_raw() can be passed directly as `$wp_customize->add_setting()` 'sanitize_callback'.
   * It is wrapped in a callback here merely for example purposes.
   *
   * @see esc_url_raw() https://developer.wordpress.org/reference/functions/esc_url_raw/
   *
   * @param string $url URL to sanitize.
   * @return string Sanitized URL.
   */
  function qcmptSanitizeUrl( $url ) {
  	return esc_url_raw( $url );
  }
}

if( !function_exists('qcmptSanitizeJs') ) {
  /**
   * js sanitization callback example.
   *
   * - Sanitization: js
   * - Control: text, js
   *
   * Sanitization callback for 'js' type text inputs. This callback sanitizes `$js` as a valid js.
   * 
   * @see esc_js() https://developer.wordpress.org/reference/functions/esc_js/
   *
   * @param string $url URL to sanitize.
   * @return string Sanitized JS.
   */
  function qcmptSanitizeJs( $js ) {
  	return esc_js( $js );
  }
}

if( !function_exists('qcmptSanitizeDec') ) {
    //Sanitize a decimal/float value
    function qcmptSanitizeDec( $number, $setting ) {
        return ( is_float($number) ? $number : $setting->default );
    }
  }