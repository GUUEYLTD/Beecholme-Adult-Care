<?php namespace NinjaTable\TableDrivers;

class NinjaFooTable {
	public static $version = '1.9.5';

	public static function run( $tableArray ) {
		self::enqueue_assets();
		self::render( $tableArray );
	}

	private static function enqueue_assets() {
		wp_enqueue_script( 'footable',
			NINJA_TABLES_PUBLIC_DIR_URL . "libs/footable/js/footable.js",
			array( 'jquery' ), '3.1.5', true );

		wp_enqueue_script( 'footable_init',
			NINJA_TABLES_DIR_URL . "assets/js/ninja-tables-footable.js",
			array( 'footable' ), self::$version, true );

		wp_localize_script( 'footable_init', 'ninja_footables', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'tables'   => array(),
			'i18n'     => array(
				'search_in'  => __( 'Search in', 'ninja-tables' ),
				'search'     => __( 'Search', 'ninja-tables' ),
				'empty_text' => __( 'No Result Found', 'ninja-tables' ),
			)
		) );

		wp_enqueue_style( 'footable', NINJA_TABLES_PUBLIC_DIR_URL
		                              . "libs/footable/css/footable.standalone.css",
			array(), '3.1.5', 'all' );
		wp_enqueue_style( 'footable_styles',
			NINJA_TABLES_DIR_URL . "assets/css/ninja-tables-public.css",
			array(), self::$version, 'all' );
	}

	private static function render( $tableArray ) {
		extract( $tableArray );
		if ( ! count( $columns ) ) {
			return;
		}
		$formatted_columns = array();
		$sortingType = ( isset( $settings['sorting_type'] ) ) ? $settings['sorting_type'] : 'by_created_at';

		$globalSorting = ( isset( $settings['column_sorting'] ) )
			? (bool) $settings['column_sorting'] : false;
		foreach ( $columns as $column ) {
			$columnType       = self::getColumnType( $column );
			$formatted_column = array(
				'name'        => $column['key'],
				'title'       => $column['name'],
				'breakpoints' => $column['breakpoints'],
				'type'        => $columnType,
				'sortable'    => $globalSorting,
				'visible'     => ( $column['breakpoints'] == 'hidden' ) ? false : true
			);
			
			if ( $sortingType == 'by_column' && $column['key'] == $settings['sorting_column'] ) {
				$formatted_column['sorted']    = true;
				$formatted_column['direction'] = $settings['sorting_column_by'];
			}
			
			$formatted_columns[] = apply_filters( 'ninja_table_column_attributes', $formatted_column, $column,
				$table_id, $tableArray );
		}
		
		if ( $settings['show_all'] ) {
			$pagingSettings = false;
		} else {
			$pagingSettings = ( $settings['perPage'] ) ? $settings['perPage']
				: 20;
		}


		$enableSearch = ( isset( $settings['enable_search'] ) )
			? $settings['enable_search'] : false;
		
		$configSettings = array(
			'filtering'       => $enableSearch,
			'paging'          => $pagingSettings,
			'sorting'         => true,
			'default_sorting' => ( isset( $settings['default_sorting'] ) ) ? $settings['default_sorting'] : false,
            'defualt_filter' => isset($default_filter) ? $default_filter : false
		);

		$table_classes = self::getTableCssClass( $settings );

		$tableHasColor = '';
		
		if ( isset( $settings['table_color'] ) && $settings['table_color']
		     && $settings['table_color'] != 'ninja_no_color_table'
		) {
			$tableHasColor = 'colored_table';
			$table_classes .= ' inverted';
		}
		
		if(isset($settings['hide_all_borders']) && $settings['hide_all_borders']) {
			$table_classes .= ' hide_all_borders';
        }
		
        if(isset($settings['hide_header_row']) && $settings['hide_header_row']) {
	        $table_classes .= ' ninjatable_hide_header_row';
        }
        
        if(!$enableSearch) {
	        $table_classes .= ' ninja_table_search_disabled';
        }
        
		if(isset($settings['table_color']) && $settings['table_color'] == 'ninja_table_custom_color') {
		    $table_color_primary = isset($settings['table_color_primary']) ? $settings['table_color_primary'] : '';
		    $table_color_secondary = isset($settings['table_color_secondary']) ? $settings['table_color_secondary'] : '';
		    if($table_color_primary && $table_color_secondary) {
			    $css = '#footable_parent_'.$table_id.'.colored_table table.foo-table.inverted.table {
                        background: '.$table_color_primary.';
                        color: '.$table_color_secondary.';
                        border: none;
                    }';
			    wp_add_inline_style('footable', $css);
            }
        }
		
		$table_vars = array(
			'table_id' => $table_id,
			'columns'  => $formatted_columns,
			'settings' => $configSettings
		);
		self::addInlineVars( json_encode( $table_vars, true ), $table_id );
		
		$foo_table_attributes = self::getFootableAtrributes( $table_id );
		?>
        <div id="footable_parent_<?php echo $table_id; ?>"
             class="footable_parent wp_table_data_press_parent <?php echo $settings['css_lib']; ?> <?php echo $tableHasColor; ?>">
			<?php if ( isset( $settings['show_title'] )
			           && $settings['show_title']
			) : ?>
				<?php do_action( 'ninja_tables_before_table_title', $table ); ?><h3
                        class="table_title footable_title"><?php echo esc_attr( $table->post_title ); ?></h3>
				<?php do_action( 'ninja_tables_after_table_title', $table ); ?>
			<?php endif; ?>
			<?php if ( isset( $settings['show_description'] )
			           && $settings['show_description']
			) : ?>
				<?php do_action( 'ninja_tables_before_table_description',
					$table ); ?>
                <div class="table_description footable_description"><?php echo wp_kses_post( $table->post_content ); ?></div>
				<?php do_action( 'ninja_tables_after_table_description',
					$table ); ?>
			<?php endif; ?>
			<?php do_action( 'ninja_tables_before_table_print', $table ); ?>
            <table <?php echo $foo_table_attributes; ?>
                                                        id="footable_<?php echo intval( $table_id ); ?>"
                                                        class=" foo-table ninja_footable foo_table_<?php echo intval( $table_id ); ?> <?php echo esc_attr( $table_classes ); ?>"></table><?php do_action( 'ninja_tables_after_table_print',
				$table ); ?>
        </div>
		<?php
	}

	private static function getTableCssClass( $settings ) {
		$baseClass      = self::getTableClassByLib( $settings['css_lib'] );
		$userClass      = ( isset( $settings['extra_css_class'] ) )
			? $settings['extra_css_class'] : '';
		$colorClass     = ( isset( $settings['table_color'] ) )
			? $settings['table_color'] : '';
		$definedClass   = implode( ' ', $settings['css_classes'] );
		$concatClasses  = $baseClass . ' ' . $userClass . ' ' . $definedClass
		                  . ' ' . $colorClass;
		$classArray     = explode( ' ', $concatClasses );
		$uniqueCssArray = array_unique( $classArray );

		return implode( ' ', $uniqueCssArray );
	}

	private static function getTableClassByLib( $lib = 'bootstrap3' ) {
		switch ( $lib ) {
			case 'bootstrap3':
			case 'bootstrap4':
				return 'table';
			case 'semantic_ui':
				return 'ui table';
			default:
				return '';
		}
	}

	private static function addInlineVars( $vars, $table_id ) {
		if ( function_exists( 'wp_add_inline_script' ) ) {
			wp_add_inline_script( 'footable_init',
				'window.ninja_footables.tables["table_' . $table_id . '"] = ' . $vars . ';' );
		} else {
			add_action( 'wp_footer', function () use ( $vars, $table_id ) {
				?>
                <script type="text/javascript">
                    window.ninja_footables.tables["table_<?php echo $table_id;?>"] = <?php echo $vars ?>;
                </script>
				<?php
			}, 100 );
		}
	}

	public static function getColumnType( $column ) {
		$type          = ( isset( $column['data_type'] ) ) ? $column['data_type'] : 'text';
		$acceptedTypes = array(
			'text',
			'number',
			'date'
		);

		if ( in_array( $type, $acceptedTypes ) ) {
			return $type;
		}

		return 'text';
	}

	private static function getFootableAtrributes( $tableID ) {
		$atts = array(
			'data-footable_id' => $tableID,
		);
		
		$atts_string = '';
		foreach ($atts as $att_name => $att) {
			$atts_string .= $att_name.'="'.$att.'"';
        }
        return (string) $atts_string;
	}
}
