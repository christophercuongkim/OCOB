<?php

/**
 * @class FLHtmlModule
 */
class FLContactFormModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(array(
			'name'				=> __( 'Contact Form', 'bb-booster' ),
			'description'		=> __( 'A very simple contact form.', 'bb-booster' ),
			'category'			=> __( 'Advanced Modules', 'bb-booster' ),
			'editor_export'		=> false,
			'partial_refresh'	=> true,
		));

		add_action( 'wp_ajax_fl_builder_email', array( $this, 'send_mail' ) );
		add_action( 'wp_ajax_nopriv_fl_builder_email', array( $this, 'send_mail' ) );
		add_filter( 'script_loader_tag', array( $this, 'add_async_attribute' ), 10, 2 );
	}

	/**
	 * @method enqueue_scripts
	 */
	public function enqueue_scripts() {
		$settings = $this->settings;
		if ( isset( $settings->recaptcha_toggle ) && 'show' == $settings->recaptcha_toggle
			&& isset( $settings->recaptcha_site_key ) && ! empty( $settings->recaptcha_site_key )
			) {

			$site_lang = substr( get_locale(), 0, 2 );
			$post_id    = FLBuilderModel::get_post_id();

			$this->add_js(
				'g-recaptcha',
				'https://www.google.com/recaptcha/api.js?onload=onLoadFLReCaptcha&render=explicit&hl=' . $site_lang,
				array( 'fl-builder-layout-' . $post_id ),
				'2.0',
				true
			);
		}
	}

	/**
	 * @method  add_async_attribute for the enqueued `g-recaptcha` script
	 * @param string $tag    Script tag
	 * @param string $handle Registered script handle
	 */
	public function add_async_attribute( $tag, $handle ) {
		if ( ('g-recaptcha' !== $handle) || ('g-recaptcha' === $handle && strpos( $tag, 'g-recaptcha-api' ) !== false ) ) {
			return $tag;
		}

		return str_replace( ' src', ' id="g-recaptcha-api" async="async" defer="defer" src', $tag );
	}

	/**
	 * @method send_mail
	 */
	public function send_mail() {

		// Get the contact form post data
		$node_id			= isset( $_POST['node_id'] ) ? sanitize_text_field( $_POST['node_id'] ) : false;
		$template_id	 	= isset( $_POST['template_id'] ) ? sanitize_text_field( $_POST['template_id'] ) : false;
		$template_node_id	  = isset( $_POST['template_node_id'] ) ? sanitize_text_field( $_POST['template_node_id'] ) : false;
		$recaptcha_response	= isset( $_POST['recaptcha_response'] ) ? $_POST['recaptcha_response'] : false;

		$subject 			= (isset( $_POST['subject'] ) ? $_POST['subject'] : __( 'Contact Form Submission', 'bb-booster' ));
		$admin_email 		= get_option( 'admin_email' );
		$site_name 			= get_option( 'blogname' );
		$response 			= array(
			'error' => true,
			'message' => __( 'Message failed. Please try again.', 'bb-booster' ),
		);

		if ( $node_id ) {

			// Get the module settings.
			if ( $template_id ) {
				$post_id  = FLBuilderModel::get_node_template_post_id( $template_id );
				$data		= FLBuilderModel::get_layout_data( 'published', $post_id );
				$settings = $data[ $template_node_id ]->settings;
			} else {
				$module	  = FLBuilderModel::get_module( $node_id );
				$settings = $module->settings;
			}

			if ( isset( $settings->mailto_email ) && ! empty( $settings->mailto_email ) ) {
				$mailto	  = $settings->mailto_email;
			} else {
				$mailto   = $admin_email;
			}

			if ( isset( $settings->subject_toggle ) && ( 'hide' == $settings->subject_toggle ) && isset( $settings->subject_hidden ) && ! empty( $settings->subject_hidden ) ) {
				$subject   = $settings->subject_hidden;
			}

			// Validate reCAPTCHA if enabled
			if ( isset( $settings->recaptcha_toggle ) && 'show' == $settings->recaptcha_toggle && $recaptcha_response ) {
				if ( ! empty( $settings->recaptcha_secret_key ) && ! empty( $settings->recaptcha_site_key ) ) {
					if ( version_compare( phpversion(), '5.3', '>=' ) ) {
						include $module->dir . 'includes/validate-recaptcha.php';
					} else {
						$response['error'] = false;
					}
				} else {
					$response = array(
						'error' => true,
						'message' => __( 'Your reCAPTCHA Site or Secret Key is missing!', 'bb-booster' ),
					);
				}
			} else {
				$response['error'] = false;
			}

			$fl_contact_from_email = (isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : null);
			$fl_contact_from_name = (isset( $_POST['name'] ) ? $_POST['name'] : '');

			$headers = array(
				'From: ' . $site_name . ' <' . $admin_email . '>',
				  'Reply-To: ' . $fl_contact_from_name . ' <' . $fl_contact_from_email . '>',
			);

			// Build the email
			$template = '';

			if ( isset( $_POST['name'] ) ) {  $template .= "Name: $_POST[name] \r\n";
			}
			if ( isset( $_POST['email'] ) ) { $template .= "Email: $_POST[email] \r\n";
			}
			if ( isset( $_POST['phone'] ) ) { $template .= "Phone: $_POST[phone] \r\n";
			}

			$template .= __( 'Message', 'bb-booster' ) . ": \r\n" . $_POST['message'];

			// Double check the mailto email is proper and no validation error found, then send.
			if ( $mailto && false === $response['error'] ) {
				wp_mail( $mailto, $subject, $template, $headers );
				$response['message'] = __( 'Sent!', 'bb-booster' );
			}

			wp_send_json( $response );
		}// End if().
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLContactFormModule', array(
	'general'		 => array(
		'title'		  => __( 'General', 'bb-booster' ),
		'sections'	  => array(
			'general'	   => array(
				'title'			=> '',
				'fields'		=> array(
					'mailto_email'		=> array(
						'type'		  => 'text',
						'label'		  => __( 'Send To Email', 'bb-booster' ),
						'default'		  => '',
						'placeholder'	  => __( 'example@mail.com', 'bb-booster' ),
						'help'		  => __( 'The contact form will send to this e-mail. Defaults to the admin email.', 'bb-booster' ),
						'preview'		  => array(
							'type'		   => 'none',
						),
						'connections'   => array( 'custom_field' ),
					),
					'name_toggle'	 => array(
						'type'		  => 'select',
						'label'		  => __( 'Name Field', 'bb-booster' ),
						'default'		  => 'show',
						'options'		  => array(
							'show'	   => __( 'Show', 'bb-booster' ),
							'hide'	   => __( 'Hide', 'bb-booster' ),
						),
						'toggle'		=> array(
							'show'			=> array(
								'fields'		=> array( 'name_placeholder' ),
							),
						),
					),
					'name_placeholder'	=> array(
						'type'		=> 'text',
						'label'		=> __( 'Name Field Placeholder', 'bb-booster' ),
						'default'	=> __( 'Your name', 'bb-booster' ),
					),
					'subject_toggle'	=> array(
						'type'		  => 'select',
						'label'		  => __( 'Subject Field', 'bb-booster' ),
						'default'		  => 'hide',
						'options'		  => array(
							'show'	   => __( 'Show', 'bb-booster' ),
							'hide'	   => __( 'Hide', 'bb-booster' ),
						),
						'toggle'		=> array(
							'show'			=> array(
								'fields'		=> array( 'subject_placeholder' ),
							),
							'hide'			=> array(
								'fields'		=> array( 'subject_hidden' ),
							),
						),
					),
					'subject_placeholder'	=> array(
						'type'		=> 'text',
						'label'		=> __( 'Subject Field Placeholder', 'bb-booster' ),
						'default'	=> __( 'Subject', 'bb-booster' ),
					),
					'subject_hidden'   => array(
						'type'		  => 'text',
						'label'		  => __( 'Email Subject', 'bb-booster' ),
						'default'		=> 'Contact Form Submission',
						'help'			=> __( 'You can choose the subject of the email. Defaults to Contact Form Submission.', 'bb-booster' ),
					),
					'email_toggle'	  => array(
						'type'		  => 'select',
						'label'		  => __( 'Email Field', 'bb-booster' ),
						'default'		  => 'show',
						'options'		  => array(
							'show'	   => __( 'Show', 'bb-booster' ),
							'hide'	   => __( 'Hide', 'bb-booster' ),
						),
						'toggle'		=> array(
							'show'			=> array(
								'fields'		=> array( 'email_placeholder' ),
							),
						),
					),
					'email_placeholder'	=> array(
						'type'		=> 'text',
						'label'		=> __( 'Email Field Placeholder', 'bb-booster' ),
						'default'	=> __( 'Your email', 'bb-booster' ),
					),
					'phone_toggle'	  => array(
						'type'		  => 'select',
						'label'		  => __( 'Phone Field', 'bb-booster' ),
						'default'		  => 'hide',
						'options'		  => array(
							'show'	   => __( 'Show', 'bb-booster' ),
							'hide'	   => __( 'Hide', 'bb-booster' ),
						),
						'toggle'		=> array(
							'show'			=> array(
								'fields'		=> array( 'phone_placeholder' ),
							),
						),
					),
					'phone_placeholder'	=> array(
						'type'		=> 'text',
						'label'		=> __( 'Phone Field Placeholder', 'bb-booster' ),
						'default'	=> __( 'Your phone', 'bb-booster' ),
						),
					'message_placeholder'	=> array(
						'type'		=> 'text',
						'label'		=> __( 'Your Message Placeholder', 'bb-booster' ),
						'default'	=> __( 'Your message', 'bb-booster' ),
					),
				),
			),
			'success'	   => array(
				'title'			=> __( 'Success', 'bb-booster' ),
				'fields'		=> array(
					'success_action' => array(
						'type'		  => 'select',
						'label'		  => __( 'Success Action', 'bb-booster' ),
						'options'		  => array(
							'none'		   => __( 'None', 'bb-booster' ),
							'show_message'  => __( 'Show Message', 'bb-booster' ),
							'redirect'	   => __( 'Redirect', 'bb-booster' ),
						),
						'toggle'		  => array(
							'show_message'		=> array(
								'fields'		=> array( 'success_message' ),
							),
							'redirect'	   => array(
								'fields'		=> array( 'success_url' ),
							),
						),
						'preview'		  => array(
							'type'			  => 'none',
						),
					),
					'success_message' => array(
						'type'		  => 'editor',
						'label'		  => '',
						'media_buttons' => false,
						'rows'          => 8,
						'default'       => __( 'Thanks for your message! We’ll be in touch soon.', 'bb-booster' ),
						'preview'       => array(
							'type'             => 'none',
						),
						'connections'   => array( 'string' ),
					),
					'success_url'  => array(
						'type'          => 'link',
						'label'         => __( 'Success URL', 'bb-booster' ),
						'preview'       => array(
							'type'             => 'none',
						),
						'connections'   => array( 'url' ),
					),
				),
			),
		),
	),
	'button'		 => array(
		'title'		  => __( 'Button', 'bb-booster' ),
		'sections'	  => array(
			'btn_general'   => array(
				'title'			=> '',
				'fields'		=> array(
					'btn_text'		 => array(
						'type'		  => 'text',
						'label'		  => __( 'Button Text', 'bb-booster' ),
						'default'		  => __( 'Send', 'bb-booster' ),
					),
					'btn_icon'		 => array(
						'type'		  => 'icon',
						'label'		  => __( 'Button Icon', 'bb-booster' ),
						'show_remove'	  => true,
					),
					'btn_icon_position' => array(
						'type'		  => 'select',
						'label'		  => __( 'Icon Position', 'bb-booster' ),
						'default'		  => 'after',
						'options'		  => array(
							'before'		   => __( 'Before Text', 'bb-booster' ),
							'after'		   => __( 'After Text', 'bb-booster' ),
						),
					),
					'btn_icon_animation' => array(
						'type'		  => 'select',
						'label'		  => __( 'Icon Visibility', 'bb-booster' ),
						'default'		  => 'disable',
						'options'		  => array(
							'disable'		=> __( 'Always Visible', 'bb-booster' ),
							'enable'			=> __( 'Fade In On Hover', 'bb-booster' ),
						),
					),
				),
			),
			'btn_colors'		=> array(
				'title'			=> __( 'Button Colors', 'bb-booster' ),
				'fields'		=> array(
					'btn_bg_color'	 => array(
						'type'		  => 'color',
						'label'		  => __( 'Background Color', 'bb-booster' ),
						'default'		  => '',
						'show_reset'	  => true,
					),
					'btn_bg_hover_color' => array(
						'type'		  => 'color',
						'label'		  => __( 'Background Hover Color', 'bb-booster' ),
						'default'		  => '',
						'show_reset'	  => true,
						'preview'		  => array(
							'type'		   => 'none',
						),
					),
					'btn_text_color' => array(
						'type'		  => 'color',
						'label'		  => __( 'Text Color', 'bb-booster' ),
						'default'		  => '',
						'show_reset'	  => true,
					),
					'btn_text_hover_color' => array(
						'type'		  => 'color',
						'label'		  => __( 'Text Hover Color', 'bb-booster' ),
						'default'		  => '',
						'show_reset'	  => true,
						'preview'		  => array(
							'type'		   => 'none',
						),
					),
				),
			),
			'btn_style'	   => array(
				'title'			=> __( 'Button Style', 'bb-booster' ),
				'fields'		=> array(
					'btn_style'	 => array(
						'type'		  => 'select',
						'label'		  => __( 'Style', 'bb-booster' ),
						'default'		  => 'flat',
						'options'		  => array(
							'flat'		   => __( 'Flat', 'bb-booster' ),
							'gradient'	   => __( 'Gradient', 'bb-booster' ),
							'transparent'   => __( 'Transparent', 'bb-booster' ),
						),
						'toggle'		  => array(
							'transparent'   => array(
								'fields'		=> array( 'btn_bg_opacity', 'btn_bg_hover_opacity', 'btn_border_size' ),
							),
						),
					),
					'btn_border_size' => array(
						'type'		  => 'text',
						'label'		  => __( 'Border Size', 'bb-booster' ),
						'default'		  => '2',
						'description'	  => 'px',
						'maxlength'	  => '3',
						'size'		  => '5',
						'placeholder'	  => '0',
					),
					'btn_bg_opacity' => array(
						'type'		  => 'text',
						'label'		  => __( 'Background Opacity', 'bb-booster' ),
						'default'		  => '0',
						'description'	  => '%',
						'maxlength'	  => '3',
						'size'		  => '5',
						'placeholder'	  => '0',
					),
					'btn_bg_hover_opacity' => array(
						'type'		  => 'text',
						'label'		  => __( 'Background Hover Opacity', 'bb-booster' ),
						'default'		  => '0',
						'description'	  => '%',
						'maxlength'	  => '3',
						'size'		  => '5',
						'placeholder'	  => '0',
					),
					'btn_button_transition' => array(
						'type'		  => 'select',
						'label'		  => __( 'Transition', 'bb-booster' ),
						'default'		  => 'disable',
						'options'		  => array(
							'disable'		=> __( 'Disabled', 'bb-booster' ),
							'enable'			=> __( 'Enabled', 'bb-booster' ),
						),
					),
				),
			),
			'btn_structure' => array(
				'title'			=> __( 'Button Structure', 'bb-booster' ),
				'fields'		=> array(
					'btn_width'	 => array(
						'type'		  => 'select',
						'label'		  => __( 'Width', 'bb-booster' ),
						'default'		  => 'auto',
						'options'		  => array(
							'auto'		   => _x( 'Auto', 'Width.', 'bb-booster' ),
							'full'		   => __( 'Full Width', 'bb-booster' ),
						),
					),
					'btn_align'		=> array(
						'type'		  => 'select',
						'label'		  => __( 'Alignment', 'bb-booster' ),
						'default'		  => 'left',
						'options'		  => array(
							'left'		   => __( 'Left', 'bb-booster' ),
							'center'		=> __( 'Center', 'bb-booster' ),
							'right'		   => __( 'Right', 'bb-booster' ),
						),
					),
					'btn_font_size' => array(
						'type'		  => 'text',
						'label'		  => __( 'Font Size', 'bb-booster' ),
						'default'		  => '14',
						'maxlength'	  => '3',
						'size'		  => '4',
						'description'	  => 'px',
					),
					'btn_padding'	 => array(
						'type'		  => 'text',
						'label'		  => __( 'Padding', 'bb-booster' ),
						'default'		  => '10',
						'maxlength'	  => '3',
						'size'		  => '4',
						'description'	  => 'px',
					),
					'btn_border_radius' => array(
						'type'		  => 'text',
						'label'		  => __( 'Round Corners', 'bb-booster' ),
						'default'		  => '4',
						'maxlength'	  => '3',
						'size'		  => '4',
						'description'	  => 'px',
					),
				),
			),
		),
	),
	'reCAPTCHA'	=> array(
		'title'		  => __( 'reCAPTCHA', 'bb-booster' ),
		'sections'	  => array(
			'recaptcha_general' => array(
				'title'			=> '',
				'fields'		=> array(
					'recaptcha_toggle' => array(
						'type' 			=> 'select',
						'label' 		=> 'reCAPTCHA Field',
						'default'		  => 'hide',
						'options'		  => array(
							'show'	   => __( 'Show', 'bb-booster' ),
							'hide'	   => __( 'Hide', 'bb-booster' ),
						),
						'help' 			=> __( 'If you want to show this field, please provide valid Site and Secret Keys.', 'bb-booster' ),
						'preview'		  => array(
							'type'		   => 'none',
						),
					),
					'recaptcha_site_key'		=> array(
						'type'			=> 'text',
						'label' 		=> __( 'Site Key', 'bb-booster' ),
						'default'		  => '',
						'preview'		  => array(
							'type'		   => 'none',
						),
					),
					'recaptcha_secret_key'	=> array(
						'type'			=> 'text',
						'label' 		=> __( 'Secret Key', 'bb-booster' ),
						'default'		  => '',
						'preview'		  => array(
							'type'		   => 'none',
						),
					),
				),
			),
		),
		'description'	  => sprintf( __( 'Please register keys for your website at the <a%s>Google Admin Console</a>.', 'bb-booster' ), ' href="https://www.google.com/recaptcha/admin" target="_blank"' ),
	),
));
