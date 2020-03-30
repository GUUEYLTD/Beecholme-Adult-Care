<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://authlab.io
 * @since      1.0.0
 *
 * @package    ninja-tables
 * @subpackage ninja-tables/admin
 */
class NinjaTablesAdmin {
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;
	/**
	 * Custom Post Type Name
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $cpt_name .
	 */
	private $cpt_name;
	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->cpt_name    = 'ninja-table';
	}

	/**
	 * Register form post types
	 *
	 * @return void
	 */
	public function register_post_type() {
		register_post_type( $this->cpt_name, array(
			'label'           => __( 'Ninja Tables', 'ninja-tables' ),
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => false,
			'capability_type' => 'post',
			'hierarchical'    => false,
			'query_var'       => false,
			'supports'        => array( 'title' ),
			'labels'          => array(
				'name'               => __( 'Ninja Tables', 'ninja-tables' ),
				'singular_name'      => __( 'Table', 'ninja-tables' ),
				'menu_name'          => __( 'Ninja Tables', 'ninja-tables' ),
				'add_new'            => __( 'Add Table', 'ninja-tables' ),
				'add_new_item'       => __( 'Add New Table', 'ninja-tables' ),
				'edit'               => __( 'Edit', 'ninja-tables' ),
				'edit_item'          => __( 'Edit Table', 'ninja-tables' ),
				'new_item'           => __( 'New Table', 'ninja-tables' ),
				'view'               => __( 'View Table', 'ninja-tables' ),
				'view_item'          => __( 'View Table', 'ninja-tables' ),
				'search_items'       => __( 'Search Table', 'ninja-tables' ),
				'not_found'          => __( 'No Table Found', 'ninja-tables' ),
				'not_found_in_trash' => __( 'No Table Found in Trash',
					'ninja-tables' ),
				'parent'             => __( 'Parent Table', 'ninja-tables' ),
			),
		) );
	}


	/**
	 * Adds a settings page link to a menu
	 *
	 * @link  https://codex.wordpress.org/Administration_Menus
	 * @since 1.0.0
	 * @return void
	 */
	public function add_menu() {
		global $submenu;
		$capability = ninja_table_admin_role();
		// Top-level page
        $menuName = __( 'NinjaTables', 'ninja-tables' );
		if(defined('NINJATABLESPRO')) {
			$menuName .= ' Pro';
        }
        
		add_menu_page( $menuName,
			$menuName, $capability, 'ninja_tables',
			array( $this, 'main_page' ),
			'data:image/svg+xml;base64,'
			. base64_encode( '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 321.98 249.25"><defs><style>.cls-1{fill:#fff;}.cls-2,.cls-3{fill:none;stroke-miterlimit:10;stroke-width:7px;}.cls-2{stroke:#9fa3a8;}.cls-3{stroke:#38444f;}</style></defs><title>Asset 7</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M312.48,249.25H9.5a9.51,9.51,0,0,1-9.5-9.5V9.5A9.51,9.51,0,0,1,9.5,0h303A9.51,9.51,0,0,1,322,9.5V239.75A9.51,9.51,0,0,1,312.48,249.25ZM9.5,7A2.53,2.53,0,0,0,7,9.5V239.75a2.53,2.53,0,0,0,2.5,2.5h303a2.53,2.53,0,0,0,2.5-2.5V9.5a2.53,2.53,0,0,0-2.5-2.5Z"/><rect class="cls-1" x="74.99" y="44.37" width="8.75" height="202.71"/><path class="cls-2" d="M129.37,234.08"/><path class="cls-2" d="M129.37,44.37"/><path class="cls-3" d="M189.37,234.08"/><path class="cls-3" d="M189.37,44.37"/><path class="cls-3" d="M249.37,234.08"/><path class="cls-3" d="M249.37,44.37"/><path class="cls-1" d="M6.16.51H315.82a6,6,0,0,1,6,6V50.32a.63.63,0,0,1-.63.63H.79a.63.63,0,0,1-.63-.63V6.51A6,6,0,0,1,6.16.51Z"/><rect class="cls-1" x="4.88" y="142.84" width="312.61" height="15.1"/><rect class="cls-1" x="22.47" y="89.99" width="28.27" height="16.97"/><rect class="cls-1" x="111.61" y="89.99" width="165.67" height="16.97"/><rect class="cls-1" x="22.47" y="189.99" width="28.27" height="16.97"/><rect class="cls-1" x="111.61" y="189.99" width="165.67" height="16.97"/></g></g></svg>' ),
			25 );

		if ( current_user_can( $capability ) ) {
		    
			$submenu['ninja_tables'][] = array(
				__( 'All Tables', 'ninja-tables' ),
				$capability,
				'admin.php?page=ninja_tables#/'
			);
			$submenu['ninja_tables'][] = array(
				__( 'Tools', 'ninja-tables' ),
				$capability,
				'admin.php?page=ninja_tables#/tools'
			);
			$submenu['ninja_tables'][] = array(
				__( 'Import a Table', 'ninja-tables' ),
				$capability,
				'admin.php?page=ninja_tables#/tools'
			);
			if(!defined('NINJATABLESPRO')) {
				$submenu['ninja_tables'][] = array(
					__( 'Get Pro', 'ninja-tables' ),
					$capability,
					'https://wpmanageninja.com/downloads/ninja-tables-pro-add-on/?utm_source=ninja-tables&utm_medium=wp&utm_campaign=wp_plugin&utm_term=upgrade_menu'
				);
			}
			
			$submenu['ninja_tables'][] = array(
				__( 'Help', 'ninja-tables' ),
				$capability,
				'admin.php?page=ninja_tables#/help'
			);
		}
	}

	public function main_page() {
		$this->enqueue_data_tables_scripts();
		include( plugin_dir_path( __FILE__ )
		         . 'partials/wp_data_tables_display.php' );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name,
			plugin_dir_url( __DIR__ ) . "assets/css/ninja-tables-admin.css",
			array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		if ( function_exists( 'wp_enqueue_editor' ) ) {
			wp_enqueue_editor();
			wp_enqueue_media();
		}
		
		wp_enqueue_script(
			$this->plugin_name,
			plugin_dir_url( __DIR__ ) . "assets/js/ninja-tables-admin.js",
			array( 'jquery' ),
			$this->version,
			false
		);

		$fluentUrl = admin_url( 'plugin-install.php?s=FluentForm&tab=search&type=term' );
		
		$isInstalled = defined( 'FLUENTFORM' ) ||  defined('NINJATABLESPRO');
		$dismissed = false;
        $dismissedTime = get_option('_ninja_tables_plugin_suggest_dismiss');
        
        if($dismissedTime) {
            if( ( time() - intval($dismissedTime) ) < 518400 )  {
	            $dismissed = true;
            }
        } else {
	        $dismissed = true;
            update_option('_ninja_tables_plugin_suggest_dismiss', time() - 345600);
        }
        
		wp_localize_script( $this->plugin_name, 'ninja_table_admin', array(
			'img_url'        => plugin_dir_url( __DIR__ ) . "assets/img/",
			'fluentform_url' => $fluentUrl,
			'fluent_wp_url'  => 'https://wordpress.org/plugins/fluentform/',
            'dismissed' => $dismissed,
            'isInstalled' => $isInstalled,
            'hasPro' => defined('NINJATABLESPRO')
		) );
        
        // Elementor plugin have a bug where they throw error to parse #url, and I really don't know why they want to parse
        // other plugin's page's uri. They should fix it.
        // For now I am de-registering their script in ninja-table admin pages.
        wp_deregister_script('elementor-admin-app');
	}

	public function enqueue_data_tables_scripts() {
		$this->enqueue_scripts();
		$this->enqueue_styles();
	}

	public function ajax_routes() {
		if ( ! current_user_can( ninja_table_admin_role() ) ) {
			return;
		}

		$valid_routes = array(
			'get-all-tables'           => 'getAllTables',
			'store-a-table'            => 'storeTable',
			'delete-a-table'           => 'deleteTable',
			'import-table'             => 'importTable',
			'import-table-from-plugin' => 'importTableFromPlugin',
			'get-tables-from-plugin'   => 'getTablesFromPlugin',
			'update-table-settings'    => 'updateTableSettings',
			'get-table-settings'       => 'getTableSettings',
			'get-table-data'           => 'getTableData',
			'store-table-data'         => 'storeData',
			'edit-data'                => 'editData',
			'delete-data'              => 'deleteData',
			'upload-data'              => 'uploadData',
			'duplicate_table'          => 'duplicateTable',
			'export-data'              => 'exportData',
			'dismiss_fluent_suggest'   => 'dismissPluginSuggest' 
		);

		$requested_route = $_REQUEST['target_action'];

		if ( isset( $valid_routes[ $requested_route ] ) ) {
			$this->{$valid_routes[ $requested_route ]}();
		}

		wp_die();
	}

	public function getAllTables() {
		$perPage = intval( $_REQUEST['per_page'] ) ?: 10;

		$currentPage = intval( $_GET['page'] );

		$skip = $perPage * ( $currentPage - 1 );

		$args = array(
			'posts_per_page' => $perPage,
			'offset'         => $skip,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'post_type'      => $this->cpt_name,
			'post_status'    => 'any',
            
		);
		
		if(isset($_REQUEST['search']) && $_REQUEST['search']) {
			$args['s'] = sanitize_text_field($_REQUEST['search']);
        }
        
		$tables = get_posts( $args );

		$total    = wp_count_posts( 'ninja-table' );
		$total    = intval( $total->publish );
		$lastPage = ceil( $total / $perPage );
		wp_send_json( array(
			'total'        => $total,
			'per_page'     => $perPage,
			'current_page' => $currentPage,
			'last_page'    => ( $lastPage ) ? $lastPage : 1,
			'data'         => $tables,
		), 200 );
	}

	public function storeTable() {
		if ( ! $_REQUEST['post_title'] ) {
			wp_send_json_error( array(
				'message' => __( 'The name field is required.', 'ninja-tables' )
			), 423 );
			die();
		}

		$postId = intval( $_REQUEST['tableId'] );


		$attributes = array(
			'post_title'   => sanitize_text_field( $_REQUEST['post_title'] ),
			'post_content' => wp_kses_post( $_REQUEST['post_content'] ),
			'post_type'    => $this->cpt_name,
			'post_status'  => 'publish'
		);
		if ( ! $postId ) {
			$postId = wp_insert_post( $attributes );
			wp_send_json( array(
				'message'  => __( 'Successfully added table.', 'ninja-tables' ),
				'table_id' => $postId
			), 200 );
		} else {
			$attributes['ID'] = $postId;
			wp_update_post( $attributes );
			wp_send_json( array(
				'message'  => __( 'Successfully updated table.',
					'ninja-tables' ),
				'table_id' => $postId
			), 200 );
		}
	}

	public function importTable() {
		$format = $_REQUEST['format'];
		
		if ( $format == 'csv' ) {
			$this->uploadTableCsv();
		} elseif ( $format == 'json' ) {
			$this->uploadTableJson();
		} elseif ( $format == 'ninjaJson' ) {
			$this->uploadTableNinjaJson();
		}

		wp_send_json( array(
			'message' => __( 'No appropriate driver found for the import format.',
				'ninja-tables' )
		), 423 );
	}

	public function importTableFromPlugin() {
		$mapper = array(
			'Table Press' => 'TablePress'
		);

		$plugin = esc_attr( $_REQUEST['plugin'] );

		$this->{lcfirst( $mapper[ $plugin ] ) . 'Import'}();
	}

	private function tablePressImport() {
		try {
			$tableId = intval( $_REQUEST['tableId'] );

			$table = get_post( $tableId );
			update_post_meta( $tableId, '_imported_to_ninja_table', 'yes' );
			$ninjaTableId = $this->createTable( array(
				'post_author'  => intval( $table->post_author ),
				'post_title'   => sanitize_text_field( '[Table Press] ' . $table->post_title ),
				'post_content' => wp_kses_post( $table->post_excerpt ),
				'post_status'  => $table->post_status,
				'post_type'    => $this->cpt_name,
			) );

			$rows = json_decode( $table->post_content, true );


			$tableSettings = get_post_meta( $table->ID, '_tablepress_table_options', true );

			$tableSettings = json_decode( $tableSettings, true );

			if ( $tableSettings['table_head'] ) {
				$header = array_shift( $rows );
			} else {
				$header = array();
				for ( $i = 0; $i < count( $rows ); $i ++ ) {
					$header[] = 'header-' . $i + 1;
				}
			}


			$rows = array_reverse( $rows );

			$this->storeTableConfigWhenImporting( $ninjaTableId, $header );

			$this->insertDataToTable( $ninjaTableId, $rows, $header );

			$message = __( 'Successfully imported '
			               . $table->post_title .
			               ' table from Table Press Plugin. Please go to all tables and review your table.'
			);
		} catch ( Exception $exception ) {
			$message = __( 'Sorry, we could not import the table.', 'ninja-tables' );
		}

		wp_send_json( array(
			'message' => $message
		), 200 );
	}

	private function getTablesFromPlugin() {
		$postTypes = array(
			'Table Press' => 'tablepress_table'
		);

		$plugin = sanitize_text_field( $_REQUEST['plugin'] );

		$arguments = array(
			'post_type'   => $postTypes[ $plugin ],
			'post_status' => 'any'
		);

		$tables = get_posts( $arguments );

		$formattedTables = array();
		foreach ( $tables as $table ) {
			$temp              = array(
				'ID'                  => $table->ID,
				'post_title'          => $table->post_title,
				'is_already_imported' => get_post_meta( $table->ID, '_imported_to_ninja_table', true )
			);
			$formattedTables[] = $temp;
		}

		wp_send_json( array(
			'tables' => $formattedTables
		), 200 );
	}

	private function formatHeader( $header ) {
		$data = array();

		foreach ( $header as $item ) {
			$item    = strip_tags( $item );
			$item    = strtolower( preg_replace( '/[\W]+/', '', trim( $item ) ) );
			$key     = sanitize_title( $item );
			$counter = 0;
			while ( isset( $data[ $key ] ) ) {
				$key = $key . '_' . $counter + 1;
				$counter ++;
			}
			$data[ $key ] = $item;
		}

		return ninja_table_renameDuplicateValues( $data );
	}

	private function uploadTableCsv() {
		$tableId = $this->createTable();

		$tmpName = $_FILES['file']['tmp_name'];

		$reader = \League\Csv\Reader::createFromFileObject(
			new SplFileObject( $tmpName )
		)->fetchAll();

		$header = array_shift( $reader );
		$reader = array_reverse( $reader );
		$this->storeTableConfigWhenImporting( $tableId, $header );

		$this->insertDataToTable( $tableId, $reader, $header );

		wp_send_json( array(
			'message' => __( 'Successfully added a table.', 'ninja-tables' ),
			'tableId' => $tableId
		) );
	}

	private function uploadTableJson() {
		$tableId = $this->createTable();

		$tmpName = $_FILES['file']['tmp_name'];

		$content = json_decode( file_get_contents( $tmpName ), true );

		$header = array_keys( array_pop( array_reverse( $content ) ) );

		$this->storeTableConfigWhenImporting( $tableId, $header );

		$this->insertDataToTable( $tableId, $content, $header );

		wp_send_json( array(
			'message' => __( 'Successfully added a table.', 'ninja-tables' ),
			'tableId' => $tableId
		) );
	}

	private function uploadTableNinjaJson() {
		$tmpName = $_FILES['file']['tmp_name'];

		$content = json_decode( file_get_contents( $tmpName ), true );

		// validation
		if ( ! $content['post'] || ! $content['columns']
		     || ! $content['settings']
		) {
			wp_send_json( array(
				'message' => __( 'You have a faulty JSON file. Please export a new one.',
					'ninja-tables' )
			), 423 );
		}

		$tableAttributes = array(
			'post_title'   => sanitize_title( $content['post']['post_title'] ),
			'post_content' => wp_kses_post( $content['post']['post_content'] ),
			'post_type'    => $this->cpt_name,
			'post_status'  => 'publish'
		);

		$tableId = $this->createTable( $tableAttributes );

		update_post_meta( $tableId, '_ninja_table_columns',
			$content['columns'] );

		update_post_meta( $tableId, '_ninja_table_settings',
			$content['settings'] );

		if ( $rows = $content['rows'] ) {
			$header = array_map( function ( $column ) {
				return $column['key'];
            }, $content['columns'] );
            
			$this->insertDataToTable( $tableId, $rows, $header );
		}

		wp_send_json( array(
			'message' => __( 'Successfully added a table.', 'ninja-tables' ),
			'tableId' => $tableId
		) );
	}

	private function createTable( $data = null ) {
		return wp_insert_post( $data
			? $data
			: array(
				'post_title'   => __( 'Temporary table name', 'ninja-tables' ),
				'post_content' => __( 'Temporary table description',
					'ninja-tables' ),
				'post_type'    => $this->cpt_name,
				'post_status'  => 'publish'
			) );
	}

	private function storeTableConfigWhenImporting( $tableId, $header ) {

		$header = array_combine( ninja_table_renameDuplicateValues(
			$this->formatHeader( $header )
		), $header );

		// ninja_table_columns
		$ninjaTableColumns = array();
		foreach ( $header as $key => $name ) {
			$ninjaTableColumns[] = array(
				'key'         => esc_attr( $key ),
				'name'        => esc_attr( $name ),
				'breakpoints' => ''
			);
		}
		update_post_meta( $tableId, '_ninja_table_columns',
			$ninjaTableColumns );

		// ninja_table_settings
		$ninjaTableSettings = ninja_table_get_table_settings( $tableId,
			'admin' );
		update_post_meta( $tableId, '_ninja_table_settings',
			$ninjaTableSettings );
		ninjaTablesClearTableDataCache($tableId);
	}

	private function insertDataToTable( $tableId, $values, $header ) {
		$header = $this->formatHeader( $header );

		$data = array();
		$time = current_time( 'mysql' );

		$headerCount = count( $header );
		foreach ( $values as $item ) {
			if ( $headerCount == count( $item ) ) {
				$itemTemp = array_combine( $header, $item );
			} else {
                // The item can have less/more entry than the header has.
                // We have to ensure that the header and values match.
				$itemTemp = array_combine(
                    $header,
                    // We'll get the appropriate values by merging Array1 & Array2
					array_merge(
                        // Array1 = Only the entries that the header has.
                        array_intersect_key($item, array_fill_keys(array_values($header), null)),
                        // Array2 = The remaining header entries will be blank. 
						array_fill_keys(array_diff(array_values($header), array_keys($item)), null)
					)
                );
            }

			array_push( $data, array(
				'table_id'   => $tableId,
				'attribute'  => 'value',
				'value'      => json_encode( $itemTemp ),
				'created_at' => $time,
				'updated_at' => $time
            ) );
		}
		ninja_tables_DbTable()->batch_insert( $data );
		
	}

	public function getTableSettings() {
		$tableID      = intval( $_REQUEST['table_id'] );
		$table        = get_post( $tableID );
		$tableColumns = ninja_table_get_table_columns( $tableID, 'admin' );

		$tableSettings = ninja_table_get_table_settings( $tableID, 'admin' );

		wp_send_json( array(
			'columns'  => $tableColumns,
			'settings' => $tableSettings,
			'table'    => $table,
            'preview_url' => site_url('?ninjatable_preview='.$tableID)
		), 200 );
	}

	public function updateTableSettings() {
		$tableId = intval( $_REQUEST['table_id'] );

		$rawColumns   = $_REQUEST['columns'];
		$tableColumns = array();

		if ( $rawColumns && is_array( $rawColumns ) ) {
			foreach ( $rawColumns as $column ) {
				$tableColumns[] = array_map( 'sanitize_text_field', $column );
			}
			update_post_meta( $tableId, '_ninja_table_columns', $tableColumns );
		}


		$tablePreference          = $_REQUEST['table_settings'];
		$formattedTablePreference = array();
		if ( $tablePreference && is_array( $tablePreference ) ) {
			foreach ( $tablePreference as $key => $tab_pref ) {

				if ( $tab_pref == 'false' ) {
					$tab_pref = false;
				}

				if ( $tab_pref == 'true' ) {
					$tab_pref = true;
				}

				if ( is_array( $tab_pref ) ) {
					$tab_pref = array_map( 'sanitize_text_field', $tab_pref );
				} else {
					$tab_pref = sanitize_text_field( $tab_pref );
				}

				$formattedTablePreference[ $key ] = $tab_pref;
			}
			update_post_meta( $tableId, '_ninja_table_settings',
				$formattedTablePreference );
		}

		ninjaTablesClearTableDataCache($tableId);
		wp_send_json( array(
			'message'  => __( 'Successfully updated configuration.',
				'ninja-tables' ),
			'columns'  => $tableColumns,
			'settings' => $formattedTablePreference
		), 200 );
	}

	public function getTable() {
		$tableId = intval( $_REQUEST['id'] );
		$table   = get_post( $tableId );

		wp_send_json( array(
			'data' => $table
		), 200 );
	}

	public function deleteTable() {
		$tableId = intval( $_REQUEST['table_id'] );
        
		if ( get_post_type( $tableId ) != $this->cpt_name ) {
			wp_send_json( array(
				'message' => __( 'Invalid Table to Delete', 'ninja-tables' )
			), 300 );
		}

        
		wp_delete_post( $tableId, true );
		// Delete the post metas
		delete_post_meta( $tableId, '_ninja_table_columns' );
		delete_post_meta( $tableId, '_ninja_table_settings' );
		delete_post_meta( $tableId, '_ninja_table_cache_object' );

		// now delete the data
		try {
			ninja_tables_DbTable()->where( 'table_id', $tableId )->delete();
		} catch ( Exception $e ) {
			//
		}

		wp_send_json( array(
			'message' => __( 'Successfully deleted the table.', 'ninja-tables' )
		), 200 );

	}

	public function getTableData() {
		$perPage = intval( $_REQUEST['per_page'] ) ?: 10;

		$currentPage = isset( $_GET['page'] ) ? intval( $_GET['page'] ) : 1;

		$skip = $perPage * ( $currentPage - 1 );

		$tableId = intval( $_REQUEST['table_id'] );

		$search = esc_attr( $_REQUEST['search'] );

		$query = ninja_tables_DbTable()->where( 'table_id', $tableId );

		if ( $search ) {
			$query->search( $search, array( 'value' ) );
		}

		$data = $query->take( $perPage )
		              ->skip( $skip )
		              ->orderBy( 'id', 'desc' )
		              ->get();

		$total = ninja_tables_DbTable()->where( 'table_id', $tableId )->count();

		$response = array();

		foreach ( $data as $item ) {
			$response[] = array(
				'id'     => $item->id,
				'values' => json_decode( $item->value, true )
			);
		}

		wp_send_json( array(
			'total'        => $total,
			'per_page'     => $perPage,
			'current_page' => $currentPage,
			'last_page'    => ceil( $total / $perPage ),
			'data'         => $response
		), 200 );
	}

	public function storeData() {
		$tableId = intval( $_REQUEST['table_id'] );

		$row          = $_REQUEST['row'];
		$formattedRow = array();
		foreach ( $row as $key => $item ) {
			$item                 = str_replace( "\'", "'", $item );
			$item                 = str_replace( "\'", "'", $item );
			$item                 = str_replace( '\"', '"', $item );
			$item                 = str_replace( '\"', '"', $item );
			$formattedRow[ $key ] = wp_kses( $item, wp_kses_allowed_html( 'post' ) );
		}

		$attributes = array(
			'table_id'   => $tableId,
			'attribute'  => 'value',
			'value'      => json_encode( $formattedRow, true ),
			'updated_at' => date( 'Y-m-d H:i:s' )
		);

		if ( $id = intval( $_REQUEST['id'] ) ) {
			ninja_tables_DbTable()->where( 'id', $id )->update( $attributes );
		} else {
			$attributes['created_at'] = date( 'Y-m-d H:i:s' );
			$insertId                 = ninja_tables_DbTable()->insert( $attributes );
			$id                       = $insertId;
		}

		$item = ninja_tables_DbTable()->find( $id );

		ninjaTablesClearTableDataCache($tableId);
		wp_send_json( array(
			'message' => __( 'Successfully saved the data.', 'ninja-tables' ),
			'item'    => array(
				'id'     => $item->id,
				'values' => $formattedRow,
				'row'    => json_decode( $item->value )
			)
		), 200 );
	}

	public function deleteData() {
		$tableId = intval( $_REQUEST['table_id'] );

		$id = $_REQUEST['id'];

		$ids = is_array( $id ) ? $id : array( $id );

		$ids = array_map( function ( $item ) {
			return intval( $item );
		}, $ids );

		$query = ninja_tables_DbTable()->where( 'table_id', $tableId )
		                               ->whereIn( 'id', $ids )->delete();
		
		ninjaTablesClearTableDataCache($tableId);
		wp_send_json( array(
			'message' => __( 'Successfully deleted data.', 'ninja-tables' )
		), 200 );
	}

	public function uploadData() {
		$tableId = intval( $_REQUEST['table_id'] );
		$tmpName = $_FILES['file']['tmp_name'];

		$reader = \League\Csv\Reader::createFromPath($tmpName)
									->appendStreamFilter('convert.iconv.ISO-8859-1/UTF-8//TRANSLIT')
									->fetchAll();

		$csvHeader = array_shift( $reader );
		$csvHeader = array_map( 'esc_attr', $csvHeader );

		$config = get_post_meta( $tableId, '_ninja_table_columns', true );
		if ( ! $config ) {
			wp_send_json( array(
				'message' => __( 'Please set table configuration.',
					'ninja-tables' )
			), 423 );
		}

		$header = array();

		foreach ( $csvHeader as $item ) {
			foreach ( $config as $column ) {
				$column = array_map( 'esc_attr', $column );
				if ( $item == $column['key'] || $item == $column['name'] ) {
					$header[] = $column['key'];
				}
			}
		}

		if ( count( $header ) != count( $config ) ) {
			wp_send_json( array(
				'message' => __( 'Please use the provided CSV header structure.',
					'ninja-tables' )
			), 423 );
		}

		$data = array();
		$time = current_time( 'mysql' );

		foreach ( $reader as $item ) {
			$itemTemp = array_combine( $header, $item );

			array_push( $data, array(
				'table_id'   => $tableId,
				'attribute'  => 'value',
				'value'      => json_encode($itemTemp),
				'created_at' => $time,
				'updated_at' => $time
			) );
		}

		ninja_tables_DbTable()->batch_insert( $data );
		ninjaTablesClearTableDataCache($tableId);
		wp_send_json( array(
			'message' => __( 'Successfully uploaded data.', 'ninja-tables' )
		) );
	}

	public function exportData() {
		$format = esc_attr( $_REQUEST['format'] );

		$tableId = intval( $_REQUEST['table_id'] );

		$tableColumns = ninja_table_get_table_columns( $tableId, 'admin' );

		$data = ninja_tables_DbTable()->where( 'table_id', $tableId )
		                              ->orderBy( 'id', 'DESC' )
		                              ->get();

		if ( $format == 'csv' ) {

			$header = array();

			foreach ( $tableColumns as $item ) {
				$header[ $item['key'] ] = $item['name'];
			}

			$exportData = array();

			foreach ( $data as $item ) {
				$temp = array();
				$item = json_decode( $item->value, true );

				foreach ( $header as $accessor => $name ) {
					$temp[] = $item[ $accessor ];
				}

				array_push( $exportData, $temp );
			}

			$this->exportAsCSV( array_values( $header ), $exportData );
		} elseif ( $format == 'json' ) {
			$tableSettings = ninja_table_get_table_settings( $tableId,
				'admin' );

			$table = get_post( $tableId );

			$tableItems = array_map( function ( $item ) {
				return json_decode( $item->value, true );
			}, $data );

			$exportData = array(
				'post'     => $table,
				'columns'  => $tableColumns,
				'settings' => $tableSettings,
				'rows'     => $tableItems
			);

			$this->exportAsJSON( $exportData );
		}
	}

	private function exportAsCSV( $header, $data, $fileName = null ) {
		$fileName = $fileName ?: 'export-data-' . date( 'd-m-Y' );

		$writer
			= \League\Csv\Writer::createFromFileObject( new SplTempFileObject() );
		$writer->setDelimiter( "," );
		$writer->setNewline( "\r\n" );
		$writer->insertOne( $header );
		$writer->insertAll( $data );
		$writer->output( $fileName . '.csv' );
		die();
	}

	private function exportAsJSON( $data, $fileName = null ) {
		$fileName = $fileName ?: 'export-data-' . date( 'd-m-Y' ) . '.json';

		header( 'Content-disposition: attachment; filename=' . $fileName );

		header( 'Content-type: application/json' );

		echo json_encode( $data );

		die();
	}

	public function add_tabales_to_editor() {
		if ( user_can_richedit() ) {
			$pages_with_editor_button = array( 'post.php', 'post-new.php' );
			foreach ( $pages_with_editor_button as $editor_page ) {
				add_action( "load-{$editor_page}", array( $this, 'init_ninja_mce_buttons' ) );
			}
		}
	}

	public function init_ninja_mce_buttons() {
		add_filter( "mce_external_plugins", array( $this, 'ninja_table_add_button' ) );
		add_filter( 'mce_buttons', array( $this, 'ninja_table_register_button' ) );
		add_action( 'admin_footer', array( $this, 'pushNinjaTablesToEditorFooter' ) );
	}

	public function pushNinjaTablesToEditorFooter() {
		$tables = $this->getAllTablesForMce();
		?>
        <script type="text/javascript">
            window.ninja_tables_tiny_mce = {
                label: '<?php _e( 'Select a Table to insert', 'ninja-tables' ) ?>',
                title: '<?php _e( 'Insert Ninja Tables Shortcode', 'ninja-tables' ) ?>',
                select_error: '<?php _e( 'Please select a table' ); ?>',
                insert_text: '<?php _e( 'Insert Shortcode', 'ninja-tables' ); ?>',
                tables: <?php echo json_encode( $tables );?>
            }
        </script>
		<?php
	}

	private function getAllTablesForMce() {
		$args = array(
			'posts_per_page' => - 1,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'post_type'      => $this->cpt_name,
			'post_status'    => 'any'
		);

		$tables      = get_posts( $args );
		$formatted   = array();
		$formatted[] = array(
			'text'  => __( 'Select a Table', 'ninja-tables' ),
			'value' => ''
		);

		foreach ( $tables as $table ) {
			$formatted[] = array(
				'text'  => $table->post_title,
				'value' => $table->ID
			);
		}

		return $formatted;
	}


	/**
	 * add a button to Tiny MCE editor
	 *
	 * @param $plugin_array
	 *
	 * @return mixed
	 */
	public function ninja_table_add_button( $plugin_array ) {
		$plugin_array['ninja_table'] = NINJA_TABLES_DIR_URL . 'assets/js/ninja-table-tinymce-button.js';

		return $plugin_array;
	}

	/**
	 * register a button to Tiny MCE editor
	 *
	 * @param $buttons
	 *
	 * @return mixed
	 */
	public function ninja_table_register_button( $buttons ) {
		array_push( $buttons, 'ninja_table' );
		return $buttons;
	}
	
	public function dismissPluginSuggest()
    {
        update_option('_ninja_tables_plugin_suggest_dismiss', time());
	}
}