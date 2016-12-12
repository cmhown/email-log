<?php namespace EmailLog\Core;

/**
 * The main plugin class.
 *
 * @since Genesis
 */
class EmailLog {

	/**
	 * Plugin Version number.
	 *
	 * @since Genesis
	 * @var string
	 */
	const VERSION = '1.9.1';

	/**
	 * Flag to track if the plugin is loaded.
	 *
	 * @since 2.0
	 * @access private
	 * @var bool
	 */
	private $loaded;

	/**
	 * Plugin file path.
	 *
	 * @since 2.0
	 * @access private
	 * @var string
	 */
	private $plugin_file;

	/**
	 * Filesystem directory path where translations are stored.
	 *
	 * @since 2.0
	 * @var string
	 */
	public $translations_path;

	/**
	 * Database Table Manager.
	 *
	 * @since 2.0
	 * @var \EmailLog\Core\DB\TableManager
	 */
	public $table_manager;

	/**
	 * Email Logger.
	 *
	 * @since 2.0
	 * @var \EmailLog\Core\EmailLogger
	 */
	public $logger;

	/**
	 * UI Manager.
	 *
	 * @since 2.0
	 * @var \EmailLog\Core\UI\UIManager
	 */
	public $ui_manager;

	/**
	 * Dependency Enforce.
	 *
	 * @var \EmailLog\Addon\DependencyEnforcer
	 */
	public $dependency_enforcer;

	// coloumn hooks.
	const HOOK_LOG_COLUMNS         = 'email_log_manage_log_columns';
	const HOOK_LOG_DISPLAY_COLUMNS = 'email_log_display_log_columns';

	/**
	 * Initialize the plugin.
	 *
	 * @param string $file Plugin file.
	 */
	public function __construct( $file ) {
		$this->plugin_file = $file;
		$this->translations_path = dirname( plugin_basename( $this->plugin_file ) ) . '/languages/' ;
	}

	/**
	 * Load the plugin.
	 */
	public function load() {
		if ( $this->loaded ) {
			return;
		}

		load_plugin_textdomain( 'email-log', false, $this->translations_path );

		$this->table_manager->load();
		$this->logger->load();
		$this->ui_manager->load();
		$this->dependency_enforcer->load();

		$this->loaded = true;
	}
}