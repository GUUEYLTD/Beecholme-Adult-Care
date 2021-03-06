<?php

class WPF_Salesforce_Admin {

	private $slug;
	private $name;
	private $crm;

	/**
	 * Get things started
	 *
	 * @access  public
	 * @since   1.0
	 */

	public function __construct( $slug, $name, $crm ) {

		$this->slug = $slug;
		$this->name = $name;
		$this->crm  = $crm;

		add_filter( 'wpf_configure_settings', array( $this, 'register_connection_settings' ), 15, 2 );
		add_action( 'show_field_salesforce_header_begin', array( $this, 'show_field_salesforce_header_begin' ), 10, 2 );
		add_action( 'show_field_sf_token_end', array( $this, 'show_field_sf_token_end' ), 10, 2 );

		// AJAX
		add_action( 'wp_ajax_wpf_test_connection_' . $this->slug, array( $this, 'test_connection' ) );

		if ( wp_fusion()->settings->get( 'crm' ) == $this->slug ) {
			$this->init();
		}

	}

	/**
	 * Hooks to run when this CRM is selected as active
	 *
	 * @access  public
	 * @since   1.0
	 */

	public function init() {

		add_filter( 'wpf_initialize_options', array( $this, 'add_default_fields' ), 10 );

	}


	/**
	 * Loads Salesforce connection information on settings page
	 *
	 * @access  public
	 * @since   1.0
	 */

	public function register_connection_settings( $settings, $options ) {

		$new_settings = array();

		$new_settings['salesforce_header'] = array(
			'title'   => __( 'Salesforce Configuration', 'wp-fusion' ),
			'std'     => 0,
			'type'    => 'heading',
			'section' => 'setup'
		);

		$new_settings['sf_username'] = array(
			'title'   => __( 'Username', 'wp-fusion' ),
			'desc'    => __( 'Enter the username for the administrator of your Salesforce account (usually an email address).', 'wp-fusion' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'setup'
		);

		$new_settings['sf_pass'] = array(
			'title'   => __( 'Password', 'wp-fusion' ),
			'std'     => '',
			'type'    => 'password',
			'section' => 'setup'
		);

		$new_settings['sf_token'] = array(
			'title'       => __( 'Security Token', 'wp-fusion' ),
			'desc'        => __( 'You can generate a security token by visiting the My Settings page and navigating to Personal >> Reset My Security Token.', 'wp-fusion' ),
			'type'        => 'api_validate',
			'section'     => 'setup',
			'class'       => 'api_key',
			'post_fields' => array( 'sf_username', 'sf_pass', 'sf_token' )
		);

		if($settings['connection_configured'] == true && wp_fusion()->settings->get('crm') == 'salesforce') {

			$new_settings['sf_tag_type'] = array(
				'title'   => __( 'Salesforce Tag Type', 'wp-fusion' ),
				'std'     => 'Topics',
				'type'    => 'radio',
				'section' => 'setup',
				'choices' => array(
					'Topics'	=> 'Topics',
					'Personal'	=> 'Personal tags',
					'Public'	=> 'Public tags'
					),
				'desc'	  => __( 'After changing the tag type, save the settings page and click Resynchronize above.', 'wp-fusion' ),
			);

		}

		$settings = wp_fusion()->settings->insert_setting_after( 'crm', $settings, $new_settings );

		return $settings;

	}


	/**
	 * Loads standard Salesforce field names and attempts to match them up with standard local ones
	 *
	 * @access  public
	 * @since   1.0
	 */

	public function add_default_fields( $options ) {

		if ( $options['connection_configured'] == true ) {

			require_once dirname( __FILE__ ) . '/salesforce-fields.php';

			foreach ( $options['contact_fields'] as $field => $data ) {

				if ( isset( $salesforce_fields[ $field ] ) && empty( $options['contact_fields'][ $field ]['crm_field'] ) ) {
					$options['contact_fields'][ $field ] = array_merge( $options['contact_fields'][ $field ], $salesforce_fields[ $field ] );
				}

			}

		}

		return $options;

	}


	/**
	 * Puts a div around the Salesforce configuration section so it can be toggled
	 *
	 * @access  public
	 * @since   1.0
	 */

	public function show_field_salesforce_header_begin( $id, $field ) {

		echo '</table>';
		$crm = wp_fusion()->settings->get( 'crm' );
		echo '<div id="' . $this->slug . '" class="crm-config ' . ( $crm == false || $crm != $this->slug ? 'hidden' : 'crm-active' ) . '" data-name="' . $this->name . '" data-crm="' . $this->slug . '">';

	}

	/**
	 * Close out Active Campaign section
	 *
	 * @access  public
	 * @since   1.0
	 */


	public function show_field_sf_token_end( $id, $field ) {

		if ( $field['desc'] != '' ) {
			echo '<span class="description">' . $field['desc'] . '</span>';
		}
		echo '</td>';
		echo '</tr>';

		echo '</table><div id="connection-output"></div>';
		echo '</div>'; // close #salesforce div
		echo '<table class="form-table">';

	}

	/**
	 * Verify connection credentials
	 *
	 * @access public
	 * @return bool
	 */

	public function test_connection() {

		$username 		= sanitize_text_field( $_POST['sf_username'] );
		$token 			= sanitize_text_field( $_POST['sf_token'] );
		$combined_token = $_POST['sf_pass'] . $token;

		$connection = $this->crm->connect( $username, $combined_token, true );

		if ( is_wp_error( $connection ) ) {

			wp_send_json_error( $connection->get_error_message() );

		} else {

			$options = wp_fusion()->settings->get_all();

			$options['sf_username'] 			= $username;
			$options['sf_token']   				= $token;
			$options['sf_combined_token']   	= $combined_token;
			$options['crm']             		= $this->slug;
			$options['connection_configured'] 	= true;

			wp_fusion()->settings->set_all( $options );

			wp_send_json_success();

		}

	}


}