<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Micro_Contact_Form_Settings' ) ) {
	class Micro_Contact_Form_Settings {
		private $options;

		public function __construct() {
			add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
			add_action( 'admin_init', array( $this, 'page_init' ) );
			add_filter( 'plugin_action_links_' . plugin_basename( MICRO_CONTACT_FORM_FILE ), array( $this, 'plugin_action_links_handler' ) );
		}

		public function add_plugin_page() {
			add_options_page( __( 'Micro Contact Form', 'micro-contact-form' ), __( 'Micro Contact Form', 'micro-contact-form' ), 'manage_options', 'micro-contact-form-settings', array( $this, 'create_admin_page' ) );
		}

		public function create_admin_page() {
			$this->options = get_option( 'micro_contact_form_settings_db' );

			echo( '<div class="wrap"><h1>' . esc_html__( 'Micro Contact Form', 'micro-contact-form' ) . '</h1><form method="post" action="options.php">' );

			settings_fields( 'micro-contact-form-settings-group' );
			do_settings_sections( 'micro-contact-form-settings' );
			submit_button();

			echo( '</form></div>' );
		}

		public function page_init() {
			register_setting( 'micro-contact-form-settings-group', 'micro_contact_form_settings_db', array( $this, 'sanitize' ) );

			add_settings_section( 'micro-contact-form-settings-section-general', __( 'General Settings', 'micro-contact-form' ), array( $this, 'print_section_info_general' ), 'micro-contact-form-settings' );

			add_settings_field( 'label_for_from_name_field', __( 'Label for Name Field', 'micro-contact-form' ), array( $this, 'label_for_from_name_field_callback' ), 'micro-contact-form-settings', 'micro-contact-form-settings-section-general' );
			add_settings_field( 'label_for_from_email_field', __( 'Label for Email Field', 'micro-contact-form' ), array( $this, 'label_for_from_email_field_callback' ), 'micro-contact-form-settings', 'micro-contact-form-settings-section-general' );
			add_settings_field( 'label_for_subject_field', __( 'Label for Subject Field', 'micro-contact-form' ), array( $this, 'label_for_subject_field_callback' ), 'micro-contact-form-settings', 'micro-contact-form-settings-section-general' );
			add_settings_field( 'label_for_message_field', __( 'Label for Message Field', 'micro-contact-form' ), array( $this, 'label_for_message_field_callback' ), 'micro-contact-form-settings', 'micro-contact-form-settings-section-general' );
			add_settings_field( 'label_for_submit_button', __( 'Label for Send Message Button', 'micro-contact-form' ), array( $this, 'label_for_submit_button_callback' ), 'micro-contact-form-settings', 'micro-contact-form-settings-section-general' );
			add_settings_field( 'required_field_indicator', __( 'Character to Indicate Required Field', 'micro-contact-form' ), array( $this, 'required_field_indicator_callback' ), 'micro-contact-form-settings', 'micro-contact-form-settings-section-general' );
			add_settings_field( 'email_address_to_receive_messages', __( 'Email address to receive submitted messages', 'micro-contact-form' ), array( $this, 'email_address_to_receive_messages_callback' ), 'micro-contact-form-settings', 'micro-contact-form-settings-section-general' );
			add_settings_field( 'flag_include_blog_name_in_subject', __( 'Include Blog Name in Subject?', 'micro-contact-form' ), array( $this, 'flag_include_blog_name_in_subject_callback' ), 'micro-contact-form-settings', 'micro-contact-form-settings-section-general' );
			add_settings_field( 'subject_prefix_text', __( 'Additional Text to Include in Subject', 'micro-contact-form' ), array( $this, 'subject_prefix_text_callback' ), 'micro-contact-form-settings', 'micro-contact-form-settings-section-general' );
			add_settings_field( 'flag_use_default_styles', __( 'Use Default Styles?', 'micro-contact-form' ), array( $this, 'flag_use_default_styles_callback' ), 'micro-contact-form-settings', 'micro-contact-form-settings-section-general' );
		}

		public function plugin_action_links_handler( $links ) {
			$settings_link = '<a href="' . admin_url( 'options-general.php?page=micro-contact-form-settings' ) . '">' . esc_html__( 'Settings', 'micro-contact-form' ) . '</a>';
			array_unshift( $links, $settings_link );

			return $links;
		}

		public function print_section_info_general() {
			esc_html_e( 'Configure general settings:', 'micro-contact-form' );
		}

		public function label_for_from_name_field_callback() {
			echo( '<input type="text" id="label_for_from_name_field" name="micro_contact_form_settings_db[label_for_from_name_field]" value="' . ( isset( $this->options['label_for_from_name_field'] ) ? esc_attr( $this->options['label_for_from_name_field'] ) : '' ) . '" />' );
			echo( '<label for="label_for_from_name_field">' . esc_html__( 'Label to display for the Name field. Default value is "Name".', 'micro-contact-form' ) . '</label>' );
		}

		public function label_for_from_email_field_callback() {
			echo( '<input type="text" id="label_for_from_email_field" name="micro_contact_form_settings_db[label_for_from_email_field]" value="' . ( isset( $this->options['label_for_from_email_field'] ) ? esc_attr( $this->options['label_for_from_email_field'] ) : '' ) . '" />' );
			echo( '<label for="label_for_from_email_field">' . esc_html__( 'Label to display for the Email field. Default value is "Email".', 'micro-contact-form' ) . '</label>' );
		}

		public function label_for_subject_field_callback() {
			echo( '<input type="text" id="label_for_subject_field" name="micro_contact_form_settings_db[label_for_subject_field]" value="' . ( isset( $this->options['label_for_subject_field'] ) ? esc_attr( $this->options['label_for_subject_field'] ) : '' ) . '" />' );
			echo( '<label for="label_for_subject_field">' . esc_html__( 'Label to display for the Subject field. Default value is "Subject".', 'micro-contact-form' ) . '</label>' );
		}

		public function label_for_message_field_callback() {
			echo( '<input type="text" id="label_for_message_field" name="micro_contact_form_settings_db[label_for_message_field]" value="' . ( isset( $this->options['label_for_message_field'] ) ? esc_attr( $this->options['label_for_message_field'] ) : '' ) . '" />' );
			echo( '<label for="label_for_message_field">' . esc_html__( 'Label to display for the Message field. Default value is "Message".', 'micro-contact-form' ) . '</label>' );
		}

		public function label_for_submit_button_callback() {
			echo( '<input type="text" id="label_for_submit_button" name="micro_contact_form_settings_db[label_for_submit_button]" value="' . ( isset( $this->options['label_for_submit_button'] ) ? esc_attr( $this->options['label_for_submit_button'] ) : '' ) . '" />' );
			echo( '<label for="label_for_submit_button">' . esc_html__( 'Label to display for the submit button. Default value is "Send Message".', 'micro-contact-form' ) . '</label>' );
		}

		public function required_field_indicator_callback() {
			echo( '<input type="text" id="required_field_indicator" name="micro_contact_form_settings_db[required_field_indicator]" value="' . ( isset( $this->options['required_field_indicator'] ) ? esc_attr( $this->options['required_field_indicator'] ) : '' ) . '" />' );
			echo( '<label for="required_field_indicator">' . esc_html__( 'Single character to display next to labels for required fields. Default value is "*".', 'micro-contact-form' ) . '</label>' );
		}

		public function email_address_to_receive_messages_callback() {
			$to_email = get_option( 'admin_email' );

			echo( '<input type="text" id="email_address_to_receive_messages" name="micro_contact_form_settings_db[email_address_to_receive_messages]" value="' . ( isset( $this->options['email_address_to_receive_messages'] ) ? esc_attr( $this->options['email_address_to_receive_messages'] ) : '' ) . '" />' );
			/* translators: %s: email address to receive submissions */
			echo( '<label for="email_address_to_receive_messages">' . sprintf( esc_html__( 'Email address to receive contact form submissions. Default value is "%s".', 'micro-contact-form' ), esc_html( $to_email ) ) . '</label>' );
		}

		public function flag_include_blog_name_in_subject_callback() {
			echo( '<input type="checkbox" id="flag_include_blog_name_in_subject" name="micro_contact_form_settings_db[flag_include_blog_name_in_subject]" value="1"' . checked( 1, ( isset( $this->options['flag_include_blog_name_in_subject'] ) ? esc_attr( $this->options['flag_include_blog_name_in_subject'] ) : 1 ), false ) . '/>' );
			/* translators: %s: blog name */
			echo( '<label for="flag_include_blog_name_in_subject">' . sprintf( esc_html__( 'Include the blog name in the subject of receved contact form submissions. Default value is "%s".', 'micro-contact-form' ), esc_html( get_bloginfo( 'name' ) ) ) . '</label>' );
		}

		public function subject_prefix_text_callback() {
			echo( '<input type="text" id="subject_prefix_text" name="micro_contact_form_settings_db[subject_prefix_text]" value="' . ( isset( $this->options['subject_prefix_text'] ) ? esc_attr( $this->options['subject_prefix_text'] ) : '' ) . '" />' );
			echo( '<label for="subject_prefix_text">' . esc_html__( 'Additional text to include in subject of received contact form submissions. Default value is "" (empty).', 'micro-contact-form' ) . '</label>' );
		}

		public function flag_use_default_styles_callback() {
			echo( '<input type="checkbox" id="flag_use_default_styles" name="micro_contact_form_settings_db[flag_use_default_styles]" value="1"' . checked( 1, ( isset( $this->options['flag_use_default_styles'] ) ? esc_attr( $this->options['flag_use_default_styles'] ) : 1 ), false ) . '/>' );
			echo( '<label for="flag_use_default_styles">' . esc_html__( 'Include default plugin styles for displayed success/error messages when the shortcode is used.', 'micro-contact-form' ) . '</label>' );
		}

		public function sanitize( $input ) {
			$label_for_from_name_field = '';
			$label_for_from_email_field = '';
			$label_for_subject_field = '';
			$label_for_message_field = '';
			$label_for_submit_button = '';
			$required_field_indicator = '';
			$email_address_to_receive_messages = '';
			$b_flag_include_blog_name_in_subject = 1;
			$b_flag_use_default_styles = 1;
			$subject_prefix_text = '';

			$sanitized_input = array();

			if ( isset( $input['label_for_from_name_field'] ) ) {
				$label_for_from_name_field = sanitize_text_field( wp_unslash( $input['label_for_from_name_field'] ) );
			}
			$sanitized_input['label_for_from_name_field'] = $label_for_from_name_field;

			if ( isset( $input['label_for_from_email_field'] ) ) {
				$label_for_from_email_field = sanitize_text_field( wp_unslash( $input['label_for_from_email_field'] ) );
			}
			$sanitized_input['label_for_from_email_field'] = $label_for_from_email_field;

			if ( isset( $input['label_for_subject_field'] ) ) {
				$label_for_subject_field = sanitize_text_field( wp_unslash( $input['label_for_subject_field'] ) );
			}
			$sanitized_input['label_for_subject_field'] = $label_for_subject_field;

			if ( isset( $input['label_for_message_field'] ) ) {
				$label_for_message_field = sanitize_text_field( wp_unslash( $input['label_for_message_field'] ) );
			}
			$sanitized_input['label_for_message_field'] = $label_for_message_field;

			if ( isset( $input['label_for_submit_button'] ) ) {
				$label_for_submit_button = sanitize_text_field( wp_unslash( $input['label_for_submit_button'] ) );
			}
			$sanitized_input['label_for_submit_button'] = $label_for_submit_button;

			if ( isset( $input['required_field_indicator'] ) ) {
				$required_field_indicator = sanitize_text_field( wp_unslash( $input['required_field_indicator'] ) );
			}

			if ( strlen( $required_field_indicator ) > 1 ) {
				$required_field_indicator = $required_field_indicator[0];
			}
			$sanitized_input['required_field_indicator'] = $required_field_indicator;

			if ( isset( $input['email_address_to_receive_messages'] ) ) {
				$email_address_to_receive_messages = sanitize_email( wp_unslash( $input['email_address_to_receive_messages'] ) );
			}
			$sanitized_input['email_address_to_receive_messages'] = $email_address_to_receive_messages;

			if ( isset( $input['flag_include_blog_name_in_subject'] ) ) {
				if ( 1 == intval( $input['flag_include_blog_name_in_subject'] ) ) {
					$b_flag_include_blog_name_in_subject = 1;
				} else {
					$b_flag_include_blog_name_in_subject = 0;
				}
			} else {
				$b_flag_include_blog_name_in_subject = 0;
			}
			$sanitized_input['flag_include_blog_name_in_subject'] = $b_flag_include_blog_name_in_subject;

			if ( isset( $input['subject_prefix_text'] ) ) {
				$subject_prefix_text = sanitize_text_field( wp_unslash( $input['subject_prefix_text'] ) );
			}
			$sanitized_input['subject_prefix_text'] = $subject_prefix_text;

			if ( isset( $input['flag_use_default_styles'] ) ) {
				if ( 1 == intval( $input['flag_use_default_styles'] ) ) {
					$b_flag_use_default_styles = 1;
				} else {
					$b_flag_use_default_styles = 0;
				}
			} else {
				$b_flag_use_default_styles = 0;
			}
			$sanitized_input['flag_use_default_styles'] = $b_flag_use_default_styles;

			return $sanitized_input;
		}
	}
}

if ( class_exists( 'Micro_Contact_Form_Settings' ) ) {
	if ( is_admin() ) {
		$micro_contact_form_settings = new Micro_Contact_Form_Settings();
	}
}
