<?php
/**
 * The admin-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Simple_Alert
 * @subpackage Simple_Alert/admin
 */

/**
 * The admin-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-facing stylesheet and JavaScript.
 *
 * @package    Simple_Alert
 * @subpackage Simple_Alert/admin
 * @author     Your Name <email@example.com>
 */
class Simple_Alert_Admin {
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		/**
		 * Constructor.
		 *
		 * @var $plugin_name Description.
		 */
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		add_action( 'admin_init', array( $this, 'settings_init' ) );
		add_action( 'admin_menu', array( $this, 'options_page' ) );

	}
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		/**
		 * Added admin css.
		 *
		 * @var $plugin_name Description.
		 */
	
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simple-alert-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Alert_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Alert_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

	
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-alert-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Custom option and settings.
	 */
	public function settings_init() {
		// Register a new setting for "simplealert" page.
		register_setting( 'simplealert', 'sa_settings' );

		add_settings_section(
			'section',
			__( 'Plugin settings', 'simple-alert' ),
			'',
			'simplealert'
		);

		add_settings_field(
			'sa_message',
			__( 'Alert message to be displayed', 'simple-alert' ),
			array( $this, 'sa_render_message' ),
			'simplealert',
			'section'
		);

		add_settings_field(
			'sa_posts',
			__( 'Select Posts', 'simple-alert' ),
			array( $this, 'sa_render_posts' ),
			'simplealert',
			'section'
		);
		 // New Settings Fields for Customizing the Alert Box
		 add_settings_field(
			'sa_position',
			__('Position of the Alert', 'simple-alert'),
			array($this, 'sa_render_position'),
			'simplealert',
			'section'
		);
	
		add_settings_field(
			'sa_padding',
			__('Padding of the Alert', 'simple-alert'),
			array($this, 'sa_render_padding'),
			'simplealert',
			'section'
		);
	
		add_settings_field(
			'sa_background_color',
			__('Background Color of the Alert', 'simple-alert'),
			array($this, 'sa_render_background_color'),
			'simplealert',
			'section'
		);
	
		add_settings_field(
			'sa_text_color',
			__('Text Color of the Alert', 'simple-alert'),
			array($this, 'sa_render_text_color'),
			'simplealert',
			'section'
		);
	}
	/**
	 * Render settings fields posts.
	 */
	public function sa_render_posts() {

		$options = get_option('sa_settings');
		// Ensure $options is an array
		if (!is_array($options)) {
			$options = [];
		}
	
		$chklist = get_post_types(['public' => true], 'objects');
		foreach ($chklist as $chk) {
			$checked = '';
			$total_posts = [];
	
			if (array_key_exists('sa_posts', $options) && is_array($options['sa_posts'])) {
				if (in_array($chk->name, $options['sa_posts'], true)) {
					$checked = "checked='checked'";
				}
			}
	
			echo '<div>';
			echo "<label><input class='sa_check' $checked name='sa_settings[sa_posts][]' type='checkbox' value='" . esc_html($chk->name) . "' /> " . esc_html($chk->label) . '</label><br/>';
	
			$total_posts = get_posts([
				'post_type' => esc_html($chk->name),
				'posts_per_page' => 100,
				'suppress_filters' => false,
			]);
	
			if ($total_posts) {
				$hidden = "class='sa_select'";
				if (!$checked) {
					$hidden = 'class="sa_select sa_hidden"';
				}
				echo '<select ' . $hidden . '   name="sa_settings[' . esc_html($chk->name) . '][]" multiple>';
				foreach ($total_posts as $post) {
					$selected = '';
					if (isset($options[$chk->name]) && in_array($post->ID, $options[$chk->name], false)) {
						$selected = "selected='selected'";
					}
					echo '<option ' . $selected . ' value="' . esc_html($post->ID) . '">' . esc_html($post->post_title) . '</option>';
				}
				echo '</select>';
			}
	
			echo "<br class='clear'/>";
			echo '</div>';
		}
	}

	public function sa_render_position() {
		$options = get_option('sa_settings');
		$position = isset($options['sa_position']) ? $options['sa_position'] : 'top-right';
		?>
		<select name="sa_settings[sa_position]">
			<option value="top-left" <?php selected($position, 'top-left'); ?>>Top Left</option>
			<option value="top-right" <?php selected($position, 'top-right'); ?>>Top Right</option>
			<option value="bottom-left" <?php selected($position, 'bottom-left'); ?>>Bottom Left</option>
			<option value="bottom-right" <?php selected($position, 'bottom-right'); ?>>Bottom Right</option>
			<option value="center-center" <?php selected($position, 'center-center'); ?>>Center Center</option>
		</select>
		<?php
	}
	
	public function sa_render_padding() {
		$options = get_option('sa_settings');
		$padding = isset($options['sa_padding']) ? $options['sa_padding'] : '15px';
		?>
		<input type="text" name="sa_settings[sa_padding]" value="<?php echo esc_attr($padding); ?>" />
		<p class="description"><?php _e('Set the padding for the alert message (e.g., 15px).', 'simple-alert'); ?></p>
		<?php
	}
	
	public function sa_render_background_color() {
		$options = get_option('sa_settings');
		$background_color = isset($options['sa_background_color']) ? $options['sa_background_color'] : '#f44336';
		?>
		<input type="color" name="sa_settings[sa_background_color]" value="<?php echo esc_attr($background_color); ?>" />
		<?php
	}
	
	public function sa_render_text_color() {
		$options = get_option('sa_settings');
		$text_color = isset($options['sa_text_color']) ? $options['sa_text_color'] : '#fff';
		?>
		<input type="color" name="sa_settings[sa_text_color]" value="<?php echo esc_attr($text_color); ?>" />
		<?php
	}
	/**
	 * Render settings fields message.
	 */
	public function sa_render_message() {
		$options = get_option('sa_settings');
		
		// Ensure $options is an array
		if (!is_array($options)) {
			$options = [];
		}
	
		// Safely access 'sa_message' with a fallback value
		$message = isset($options['sa_message']) ? $options['sa_message'] : '';
	
		// Use wp_editor for rich text editing
		wp_editor(
			$message,
			'sa_message', // Unique ID for the editor
			[
				'textarea_name' => 'sa_settings[sa_message]', // Name for the form field
				'media_buttons' => false,                     // Hide media upload button
				'textarea_rows' => 10,                        // Number of rows in the editor
				'teeny'         => true,                      // Use simplified editor
			]
		);
	}
	
	/**
	 * Admin menu
	 */
	public function options_page() {
		// Add top level menu page.
		add_options_page( 'Simple Alert', 'Simple Alert', 'manage_options', 'simple_alert', array( $this, 'options_page_html' ) );

	}
	/**
	 * Render settings page.
	 */
	public function options_page_html() {
		// Check user capabilities.
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( isset( $_GET['settings-updated'] ) ) {
			add_settings_error( 'simplealert_messages', 'simplealert_message', __( 'Settings Saved', 'simplealert' ), 'updated' );
		}
		// Settings_errors( 'simplealert_messages' );.
		?>
			<div class="wrap">
				<h1>
					<?php echo esc_html( get_admin_page_title() ); ?>
				</h1>
				<form action="options.php" method="post">
					<?php
					settings_fields( 'simplealert' );
					do_settings_sections( 'simplealert' );
					submit_button( 'Save Changes' );
		?>
				</form>
			</div>
			<?php
	}

}
