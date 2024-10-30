<?php
/**
 * Plugin Name: Micro Contact Form
 * Plugin URI: https://wordpress.org/plugins/micro-contact-form/
 * Description: Contact form plugin requiring only basic data entry (message subject, message content, from name, and return e-mail address) to send a brief message to the site administrator's e-mail address.
 * Version: 1.0.4
 * Author: John Dalesandro
 * Author URI: https://johndalesandro.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: micro-contact-form
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'MICRO_CONTACT_FORM_FILE' ) ) {
	define( 'MICRO_CONTACT_FORM_FILE', __FILE__ );
}

if ( ! class_exists( 'Micro_Contact_Form' ) ) {
	require_once trailingslashit( dirname( MICRO_CONTACT_FORM_FILE ) ) . 'classes/class-micro-contact-form.php';
}

if ( is_admin() && ! class_exists( 'Micro_Contact_Form_Settings' ) ) {
	require_once trailingslashit( dirname( MICRO_CONTACT_FORM_FILE ) ) . 'classes/class-micro-contact-form-settings.php';
}
