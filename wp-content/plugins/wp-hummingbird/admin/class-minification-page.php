<?php

class WP_Hummingbird_Minification_Page extends WP_Hummingbird_Admin_Page {


	public function on_load() {

		wphb_minification_maybe_stop_checking_files();
		if ( isset( $_POST['submit'] ) ) {
			check_admin_referer( 'wphb-enqueued-files' );

			$options = wphb_get_settings();

			$options = $this->_sanitize_type( 'styles', $options );
			$options = $this->_sanitize_type( 'scripts', $options );

			wphb_update_settings( $options );

			wp_redirect( add_query_arg( 'updated', 'true' ) );
			exit;
		}

		if ( isset( $_POST['clear-cache'] ) ) {
			wphb_clear_minification_cache( false  );
			$url = remove_query_arg( 'updated' );
			wp_redirect( add_query_arg( 'wphb-cache-cleared', 'true', $url ) );
			exit;
		}

	}

	private function _sanitize_type( $type, $options ) {

		$current_options = wphb_get_settings();

		// We'll save what groups have changed so we reset the cache for those groups
		$changed_groups = array();

		if ( ! empty( $_POST[ $type ] ) ) {
			foreach ( $_POST[ $type ] as $handle => $item ) {
				$key = array_search( $handle, $options['block'][ $type ] );
				if ( ! isset( $item['include'] ) ) {
					$options['block'][ $type ][] = $handle;
				}
				elseif ( $key !== false ) {
					unset( $options['block'][ $type ][ $key ] );
				}
				$options['block'][ $type ] = array_unique( $options['block'][ $type ] );
				$diff = array_merge(
					array_diff( $current_options['block'][ $type ], $options['block'][ $type ] ),
					array_diff( $options['block'][ $type ], $current_options['block'][ $type ] )
				);
				if ( $diff ) {
					foreach ( $diff as $diff_handle ) {
						$_groups = WP_Hummingbird_Module_Minify_Group::get_groups_from_handle( $diff_handle, $type );
						if ( $_groups ) {
							$changed_groups = array_merge( $changed_groups, $_groups );
						}
					}
				}

				$key = array_search( $handle, $options['dont_minify'][ $type ] );
				if ( ! isset( $item['minify'] ) ) {
					$options['dont_minify'][ $type ][] = $handle;
				}
				elseif ( $key !== false ) {
					unset( $options['dont_minify'][ $type ][ $key ] );
				}
				$options['dont_minify'][ $type ] = array_unique( $options['dont_minify'][ $type ] );
				$diff = array_merge(
					array_diff( $current_options['dont_minify'][ $type ], $options['dont_minify'][ $type ] ),
					array_diff( $options['dont_minify'][ $type ], $current_options['dont_minify'][ $type ] )
				);
				if ( $diff ) {
					foreach ( $diff as $diff_handle ) {
						$_groups = WP_Hummingbird_Module_Minify_Group::get_groups_from_handle( $diff_handle, $type );
						if ( $_groups ) {
							$changed_groups = array_merge( $changed_groups, $_groups );
						}
					}
				}

				$key = array_search( $handle, $options['dont_combine'][ $type ] );
				if ( ! isset( $item['combine'] ) ) {
					$options['dont_combine'][ $type ][] = $handle;
				}
				elseif ( $key !== false ) {
					unset( $options['dont_combine'][ $type ][ $key ] );
				}
				$options['dont_combine'][ $type ] = array_unique( $options['dont_combine'][ $type ] );
				$diff = array_merge(
					array_diff( $current_options['dont_combine'][ $type ], $options['dont_combine'][ $type ] ),
					array_diff( $options['dont_combine'][ $type ], $current_options['dont_combine'][ $type ] )
				);
				if ( $diff ) {
					foreach ( $diff as $diff_handle ) {
						$_groups = WP_Hummingbird_Module_Minify_Group::get_groups_from_handle( $diff_handle, $type );
						if ( $_groups ) {
							$changed_groups = array_merge( $changed_groups, $_groups );
						}
					}
				}

				$key_exists = array_key_exists( $handle, $options['position'][ $type ] );
				if ( in_array( $item['position'], array( 'header', 'footer' ) ) ) {
					$options['position'][ $type ][ $handle ] = $item['position'];
				}
				elseif ( $key_exists ) {
					unset( $options['position'][ $type ][ $handle ] );
				}
				if ( $diff = array_diff_key( $current_options['position'][ $type ], $options['position'][ $type ] ) ) {
					foreach ( $diff as $diff_handle ) {
						$_groups = WP_Hummingbird_Module_Minify_Group::get_groups_from_handle( $diff_handle, $type );
						if ( $_groups ) {
							$changed_groups = array_merge( $changed_groups, $_groups );
						}
					}
				}
				$diff = array_merge(
					array_diff_key( $current_options['position'][ $type ], $options['position'][ $type ] ),
					array_diff_key( $options['position'][ $type ], $current_options['position'][ $type ] )
				);
				if ( $diff ) {
					foreach ( $diff as $diff_handle => $position) {
						$_groups = WP_Hummingbird_Module_Minify_Group::get_groups_from_handle( $diff_handle, $type );
						if ( $_groups ) {
							$changed_groups = array_merge( $changed_groups, $_groups );
						}
					}
				}
			}
		}

		// Delete those groups
		foreach ( $changed_groups as $group ) {
			/** @var WP_Hummingbird_Module_Minify_Group $group */
			$group->delete_file();
		}


		return $options;
	}

	/**
	 * Render the page
	 */
	public function render() {
		?>

		<div id="container" class="wrap wrap-wp-hummingbird wrap-wp-hummingbird-page <?php echo 'wrap-' . $this->slug; ?>">

			<?php
			if ( isset( $_GET['updated'] ) ) :
				$this->show_notice( 'updated', __( 'Your new minify settings have been saved. Simply refresh your homepage and Hummingbird will minify and serve your newly compressed files.', 'wphb' ), 'success' );
			endif;

			$this->render_header();

			$this->render_inner_content();
			?>

		</div><!-- end container -->

		<script>
            jQuery(document).ready( function() {
                WPHB_Admin.getModule( 'notices' );
            });

            // Avoid moving dashboard notice under h2
            var wpmuDash = document.getElementById( 'wpmu-install-dashboard' );
            if ( wpmuDash )
                wpmuDash.className = wpmuDash.className + " inline";

            jQuery( 'div.updated, div.error' ).addClass( 'inline' );
		</script>
		<?php
	}

	/**
	 * Overriden from parent class
	 */
	protected function render_inner_content() {
		$collection = wphb_minification_get_resources_collection();
		$args = array(
			'instructions' => empty( $collection['styles'] ) && empty( $collection['scripts'] )
		);

		$this->view( $this->slug . '-page', $args );
	}

	public function register_meta_boxes() {
		$collection = wphb_minification_get_resources_collection();
		$module = wphb_get_module( 'minify' );

		if ( ( empty( $collection['styles'] ) && empty( $collection['scripts'] ) ) || wphb_minification_is_checking_files() || ! $module->is_active() ) {
			$this->add_meta_box( 'minification/enqueued-files-empty', __( 'Enqueued Files', 'wphb' ), array( $this, 'enqueued_files_empty_metabox' ), null, null, 'box-enqueued-files-empty', array( 'box_class' => 'dev-box content-box content-box-one-col-center') );
		}
		else {
			$this->add_meta_box( 'minification/enqueued-files', __( 'Enqueued Files', 'wphb' ), array( $this, 'enqueued_files_metabox' ), null, null, 'main', array( 'box_content_class' => 'box-content no-side-padding', 'box_footer_class' => 'box-footer') );
		}

		if ( ! is_multisite() ) {
			$this->add_meta_box( 'minification/advanced-settings', __( 'Advanced Settings', 'wphb' ), array( $this, 'advanced_settings_metabox' ), array( $this, 'advanced_settings_metabox_header' ), null, 'main', array( 'box_content_class' => 'box-content', 'box_footer_class' => 'box-footer') );
		}
	}

	public function enqueued_files_empty_metabox() {
		// Get current user name
		$user = wphb_get_current_user_info();
		$checking_files = wphb_minification_is_checking_files();
		$this->view( 'minification/enqueued-files-empty-meta-box', array( 'user' => $user, 'checking_files' => $checking_files ) );
	}


	public function enqueued_files_metabox() {
		$collection = wphb_minification_get_resources_collection();
		$styles_rows = $this->_collection_rows( $collection['styles'], 'styles' );
		$scripts_rows = $this->_collection_rows( $collection['scripts'], 'scripts' );

		$active_plugins = get_option('active_plugins', array() );
		if ( is_multisite() ) {
			foreach ( get_site_option('active_sitewide_plugins', array() ) as $plugin => $item ) {
				$active_plugins[] = $plugin;
			}
		}
		$theme = wp_get_theme();

		$selector_filter = array();
		$selector_filter[ $theme->Name ] = $theme->Name;
		foreach ( $active_plugins as $plugin ) {
			if ( ! is_file( WP_PLUGIN_DIR . '/' . $plugin ) ) {
				continue;
			}
			$plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
			if ( $plugin_data['Name'] ) {
				// Found plugin, add it as a filter
				$selector_filter[ $plugin_data['Name'] ] = $plugin_data['Name'];
			}
		}

		/** @var WP_Hummingbird_Module_Minify $module */
		$module = wphb_get_module( 'minify' );
		$is_server_error = $module->errors_controller->is_server_error();
		$server_errors = $module->errors_controller->get_server_errors();
		$error_time_left = $module->errors_controller->server_error_time_left();

		if ( isset( $_GET['view-export-form'] ) ) {
			$this->view( 'minification/export-form' );
		}

		$args = compact( 'collection', 'styles_rows', 'scripts_rows', 'selector_filter', 'is_server_error', 'server_errors', 'error_time_left' );
		$this->view( 'minification/enqueued-files-meta-box', $args );
	}


	private function _collection_rows( $collection, $type ) {
		$options = wphb_get_settings();

		// This will be used for filtering
		$theme = wp_get_theme();
		$active_plugins = get_option('active_plugins', array() );
		if ( is_multisite() ) {
			foreach ( get_site_option('active_sitewide_plugins', array() ) as $plugin => $item ) {
				$active_plugins[] = $plugin;
			}
		}

		/**
		 * @var WP_Hummingbird_Module_Minify $minification_module
		 */
		$minification_module = wphb_get_module( 'minify' );

		$content = '';

		foreach ( $collection as $item ) {
			/**
			 * Filter minification enqueued files items displaying
			 *
			 * @param bool $display If set to true, display the item. Default false
			 * @param array $item Item data
			 * @param string $type Type of the current item (scripts|styles)
			 */
			if ( ! apply_filters( 'wphb_minification_display_enqueued_file', true, $item, $type ) ) {
				continue;
			}

			if ( ! empty( $options['position'][ $type ][ $item['handle'] ] ) && in_array( $options['position'][ $type ][ $item['handle'] ], array( 'header', 'footer' ) ) ) {
				$position = $options['position'][ $type ][ $item['handle'] ];
			}
			else {
				$position = '';
			}

			$original_size = false;
			$compressed_size = false;

			$base_name = $type . '[' . $item['handle'] . ']';

			if ( isset ( $item['original_size'] ) )
				$original_size = $item['original_size'];

			if ( isset( $item['compressed_size'] ) )
				$compressed_size = $item['compressed_size'];

			$site_url = str_replace( array( 'http://', 'https://' ), '', get_option('siteurl') );
			$rel_src = str_replace( array( 'http://', 'https://', $site_url ), '', $item['src'] );
			$rel_src = ltrim( $rel_src, '/' );
			$full_src = $item['src'];

			$info = pathinfo( $full_src );
			$ext = isset( $info['extension'] ) ? strtoupper( $info['extension'] ) : __( 'OTHER', 'wphb' );
			if ( ! in_array( $ext, array( __( 'OTHER', 'wphb' ), 'CSS', 'JS' ) ) ) {
				$ext = __( 'OTHER', 'wphb' );
			}
			$row_error = $minification_module->errors_controller->get_handle_error( $item['handle'], $type );
			$disable_switchers = array();
			if ( $row_error ) {
				$disable_switchers = $row_error['disable'];
			}

			$filter = '';
			if ( preg_match( '/wp-content\/themes\/(.*)\//', $full_src, $matches ) ) {
				$filter = $theme->Name;
			}
			elseif ( preg_match( '/wp-content\/plugins\/([\w-_]*)\//', $full_src, $matches ) ) {
				// The source comes from a plugin
				foreach ( $active_plugins as $active_plugin ) {
					if ( stristr( $active_plugin, $matches[1] ) ) {
						// It seems that we found the plguin but let's double check
						$plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/' . $active_plugin );
						if ( $plugin_data['Name'] ) {
							// Found plugin, add it as a filter
							$filter = $plugin_data['Name'];
						}
						break;
					}

				}
			}

			/**
			 * Allows to enable/disable switchers in minification page
			 *
			 * @param array $disable_switchers List of switchers disabled for an item ( include, minify, combine)
			 * @param array $item Info about the current item
			 * @param string $type Type of the current item (scripts|styles)
			 */
			$disable_switchers = apply_filters( 'wphb_minification_disable_switchers', $disable_switchers, $item, $type );

			$args = compact( 'item', 'options', 'type', 'position', 'base_name', 'original_size', 'compressed_size', 'rel_src', 'full_src', 'ext', 'row_error', 'disable_switchers', 'filter' );
			$content .= $this->view( 'minification/enqueued-files-rows', $args, false );
		}

		return $content;
	}

	function advanced_settings_metabox() {
		$settings = wphb_get_settings();
		$args = array(
			'use_cdn' => $settings['use_cdn'],
			'disabled' => ! wphb_is_member(),
			'super_minify' => wphb_is_member()
		);
		$this->view( 'minification/advanced-settings', $args );
	}

	function advanced_settings_metabox_header() {
		$args = array(
			'is_member' => wphb_is_member(),
			'title' => __( 'Advanced Settings', 'wphb' )
		);
		$this->view( 'minification/advanced-settings-header', $args );
	}
}