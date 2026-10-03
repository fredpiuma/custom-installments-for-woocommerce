<?php

namespace FredericoDeCastro\Custom_Installments\API;

use FredericoDeCastro\Custom_Installments\Admin\Admin_Options;

use WP_REST_Response;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Update channel of the plugin, backed by the GitHub releases of the repository
 *
 * The latest release is fetched from the GitHub API, cached on a transient and
 * injected into the core update transient, so WordPress handles the download and
 * install. The release must carry a `custom-installments-for-woocommerce.zip` asset,
 * built by the release workflow of the repository.
 *
 * @since 3.0.0
 * @version 6.0.0
 * @package FredericoDeCastro\Custom_Installments\API
 * @author Frederico de Castro
 */
class Updater {

    /**
     * GitHub repository, as owner/name
     *
     * @since 6.0.0
     * @var string
     */
    const REPOSITORY = 'fredpiuma/custom-installments-for-woocommerce';

    /**
     * Transient that caches the latest release
     *
     * @since 6.0.0
     * @var string
     */
    const CACHE_KEY = 'woo_custom_installments_github_release';

    /**
     * REST namespace of the manual update check
     *
     * @since 5.5.9
     * @var string
     */
    const REST_NAMESPACE = 'custom-installments-for-woocommerce/v1';

    /**
     * REST route of the manual update check
     *
     * @since 5.5.9
     * @var string
     */
    const REST_ROUTE = '/check-updates';

    /**
     * Plugin slug
     *
     * @since 3.0.0
     * @var string
     */
    public $plugin_slug = WOO_CUSTOM_INSTALLMENTS_SLUG;

    /**
     * Installed plugin version
     *
     * @since 3.0.0
     * @var string
     */
    public $version = WOO_CUSTOM_INSTALLMENTS_VERSION;

    /**
     * Plugin basename
     *
     * @since 5.5.9
     * @var string
     */
    public $basename = WOO_CUSTOM_INSTALLMENTS_BASENAME;


    /**
     * Construct function
     *
     * @since 3.0.0
     * @version 6.0.0
     * @return void
     */
    public function __construct() {
        $this->maybe_migrate_legacy_state();

        add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'inject_update' ) );
        add_filter( 'plugins_api', array( $this, 'plugin_info' ), 20, 3 );
        add_filter( 'upgrader_source_selection', array( $this, 'fix_source_dir' ), 10, 4 );

        // manual update check, answered over the REST API
        add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );

        add_filter( 'plugin_row_meta', array( $this, 'add_check_updates_link' ), 10, 2 );

        // enable auto updates
        if ( Admin_Options::get_setting('enable_auto_updates') === 'yes' ) {
            add_filter( 'auto_update_plugin', array( $this, 'enable_auto_update' ), 10, 2 );
        }

        // display new update on plugins list
        if ( Admin_Options::get_setting('enable_update_notices') === 'yes' ) {
            add_action( 'admin_notices', array( $this, 'admin_update_notice' ) );
        }
    }


    /**
     * Get the latest release published on GitHub
     *
     * @since 6.0.0
     * @param bool $force | Skip the cache
     * @return array|null Normalized release data, or null on failure
     */
    public static function get_latest_release( $force = false ) {
        if ( ! $force ) {
            $cached = get_site_transient( self::CACHE_KEY );

            if ( is_array( $cached ) ) {
                return empty( $cached['version'] ) ? null : $cached;
            }
        }

        $response = wp_remote_get( 'https://api.github.com/repos/' . self::REPOSITORY . '/releases/latest', array(
            'timeout' => 10,
            'headers' => array(
                'Accept' => 'application/vnd.github+json',
                'User-Agent' => 'WordPress/' . get_bloginfo('version') . '; ' . home_url(),
            ),
        ));

        if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 ) {
            // cache the failure briefly to avoid hammering the API
            set_site_transient( self::CACHE_KEY, array(), HOUR_IN_SECONDS );

            return null;
        }

        $data = json_decode( wp_remote_retrieve_body( $response ), true );

        if ( ! is_array( $data ) || empty( $data['tag_name'] ) ) {
            set_site_transient( self::CACHE_KEY, array(), HOUR_IN_SECONDS );

            return null;
        }

        $package = '';

        if ( ! empty( $data['assets'] ) && is_array( $data['assets'] ) ) {
            foreach ( $data['assets'] as $asset ) {
                if ( isset( $asset['name'], $asset['browser_download_url'] ) && substr( $asset['name'], -4 ) === '.zip' ) {
                    $package = $asset['browser_download_url'];
                    break;
                }
            }
        }

        if ( empty( $package ) && ! empty( $data['zipball_url'] ) ) {
            $package = $data['zipball_url'];
        }

        $release = array(
            'version' => ltrim( $data['tag_name'], 'vV' ),
            'package' => $package,
            'url' => isset( $data['html_url'] ) ? $data['html_url'] : 'https://github.com/' . self::REPOSITORY,
            'changelog' => isset( $data['body'] ) ? $data['body'] : '',
            'published_at' => isset( $data['published_at'] ) ? $data['published_at'] : '',
        );

        set_site_transient( self::CACHE_KEY, $release, 12 * HOUR_IN_SECONDS );

        return $release;
    }


    /**
     * Inject the GitHub release into the core update transient
     *
     * @since 6.0.0
     * @param object $transient | Update plugins transient
     * @return object
     */
    public function inject_update( $transient ) {
        if ( ! is_object( $transient ) || empty( $transient->checked ) ) {
            return $transient;
        }

        $release = self::get_latest_release();

        if ( ! $release || empty( $release['package'] ) ) {
            return $transient;
        }

        $item = (object) array(
            'id' => 'github.com/' . self::REPOSITORY,
            'slug' => $this->plugin_slug,
            'plugin' => $this->basename,
            'new_version' => $release['version'],
            'url' => 'https://github.com/' . self::REPOSITORY,
            'package' => $release['package'],
        );

        if ( version_compare( $this->version, $release['version'], '<' ) ) {
            $transient->response[ $this->basename ] = $item;
        } else {
            $transient->no_update[ $this->basename ] = $item;
        }

        return $transient;
    }


    /**
     * Provide the plugin details modal on the plugins list
     *
     * @since 6.0.0
     * @param false|object|array $result | The result object or array
     * @param string $action | The type of information being requested
     * @param object $args | Plugin API arguments
     * @return false|object|array
     */
    public function plugin_info( $result, $action, $args ) {
        if ( $action !== 'plugin_information' || empty( $args->slug ) || $args->slug !== $this->plugin_slug ) {
            return $result;
        }

        $release = self::get_latest_release();

        return (object) array(
            'name' => 'Custom Installments for WooCommerce',
            'slug' => $this->plugin_slug,
            'version' => $release ? $release['version'] : $this->version,
            'author' => '<a href="https://www.fredericodecastro.com.br/links">Frederico de Castro</a>',
            'homepage' => 'https://github.com/' . self::REPOSITORY,
            'download_link' => $release ? $release['package'] : '',
            'last_updated' => $release ? $release['published_at'] : '',
            'requires' => '6.0',
            'requires_php' => '7.4',
            'sections' => array(
                'description' => esc_html__( 'Extensão que permite exibir o parcelamento, desconto e juros por forma de pagamento para lojas WooCommerce.', 'custom-installments-for-woocommerce' ),
                'changelog' => $release ? nl2br( esc_html( $release['changelog'] ) ) : '',
            ),
        );
    }


    /**
     * Rename the extracted folder to the plugin slug
     *
     * GitHub zipballs extract to `owner-repo-hash`, which would install the update
     * on a different folder and deactivate the plugin.
     *
     * @since 6.0.0
     * @param string $source | File source location
     * @param string $remote_source | Remote file source location
     * @param object $upgrader | WP_Upgrader instance
     * @param array $hook_extra | Extra arguments passed to hooked filters
     * @return string|\WP_Error
     */
    public function fix_source_dir( $source, $remote_source, $upgrader, $hook_extra = array() ) {
        global $wp_filesystem;

        if ( empty( $hook_extra['plugin'] ) || $hook_extra['plugin'] !== $this->basename ) {
            return $source;
        }

        $expected = trailingslashit( $remote_source ) . dirname( $this->basename ) . '/';

        if ( untrailingslashit( $source ) === untrailingslashit( $expected ) ) {
            return $source;
        }

        if ( $wp_filesystem && $wp_filesystem->move( $source, $expected, true ) ) {
            return $expected;
        }

        return $source;
    }


    /**
     * Purge the cached release and force WordPress to check again
     *
     * @since 5.5.9
     * @version 6.0.0
     * @return void
     */
    public static function clear_cache() {
        delete_site_transient( self::CACHE_KEY );
        delete_site_transient('update_plugins');
    }


    /**
     * Get the update offered for this plugin, if any
     *
     * @since 5.5.9
     * @return object|null
     */
    public static function get_available_update() {
        $transient = get_site_transient('update_plugins');

        if ( ! is_object( $transient ) || empty( $transient->response[ WOO_CUSTOM_INSTALLMENTS_BASENAME ] ) ) {
            return null;
        }

        $update = $transient->response[ WOO_CUSTOM_INSTALLMENTS_BASENAME ];

        if ( empty( $update->new_version ) || version_compare( WOO_CUSTOM_INSTALLMENTS_VERSION, $update->new_version, '>=' ) ) {
            return null;
        }

        return $update;
    }


    /**
     * Register the REST route of the manual update check
     *
     * @since 5.5.9
     * @return void
     */
    public function register_rest_routes() {
        register_rest_route( self::REST_NAMESPACE, self::REST_ROUTE, array(
            'methods' => 'POST',
            'callback' => array( $this, 'check_updates_response' ),
            'permission_callback' => array( $this, 'check_updates_permission' ),
        ));
    }


    /**
     * Check if the current user may run a manual update check
     *
     * @since 5.5.9
     * @return bool
     */
    public function check_updates_permission() {
        return current_user_can('update_plugins');
    }


    /**
     * Run a manual update check and describe the outcome
     *
     * @since 5.5.9
     * @version 6.0.0
     * @return WP_REST_Response
     */
    public function check_updates_response() {
        self::clear_cache();

        if ( ! self::get_latest_release( true ) ) {
            return new WP_REST_Response( array(
                'success' => false,
                'has_update' => false,
                'message' => esc_html__( 'Não foi possível verificar atualizações para o plugin Custom Installments for WooCommerce.', 'custom-installments-for-woocommerce' ),
            ), 200 );
        }

        wp_update_plugins();

        $update = self::get_available_update();

        if ( ! $update ) {
            return new WP_REST_Response( array(
                'success' => true,
                'has_update' => false,
                'current_version' => $this->version,
                'message' => esc_html__( 'A versão do plugin é a mais recente.', 'custom-installments-for-woocommerce' ),
            ), 200 );
        }

        return new WP_REST_Response( array(
            'success' => true,
            'has_update' => true,
            'current_version' => $this->version,
            'new_version' => $update->new_version,
            'update_url' => $this->get_update_url(),
            'message' => sprintf(
                /* translators: %s: new plugin version */
                esc_html__( 'A versão %s está disponível.', 'custom-installments-for-woocommerce' ),
                $update->new_version
            ),
        ), 200 );
    }


    /**
     * Add check updates link in the plugin_row_meta
     *
     * @since 3.0.0
     * @version 5.5.9
     * @param array $plugin_meta | An array of the plugin’s metadata
     * @param string $plugin_file | Path to the plugin file relative to the plugins directory
     * @return array
     */
    public function add_check_updates_link( $plugin_meta, $plugin_file ) {
        if ( $plugin_file === $this->basename ) {
            $plugin_meta['woo_custom_installments_check_updates'] = sprintf(
                '<a href="#" class="wci-check-updates">%s</a>',
                esc_html__( 'Verificar atualizações', 'custom-installments-for-woocommerce' )
            );
        }

        return $plugin_meta;
    }


    /**
     * Enable auto-update only for this plugin
     *
     * @since 5.4.0
     * @version 5.5.9
     * @param bool $update | Whether to enable automatic update
     * @param object $item | The plugin object being checked
     * @return bool
     */
    public function enable_auto_update( $update, $item ) {
        if ( isset( $item->plugin ) && $item->plugin === $this->basename ) {
            return true; // enable only this plugin
        }

        return $update;
    }


    /**
     * Display update notice in the admin panel
     *
     * @since 5.4.0
     * @version 6.0.0
     * @return void
     */
    public function admin_update_notice() {
        if ( ! current_user_can('update_plugins') ) {
            return;
        }

        $update = self::get_available_update();

        if ( ! $update ) {
            return;
        }

        $message = sprintf(
            __( 'Uma nova versão do plugin <strong>Custom Installments for WooCommerce</strong> (%s) está disponível. <a href="%s">Atualize agora</a>.', 'custom-installments-for-woocommerce' ),
            esc_html( $update->new_version ),
            esc_url( $this->get_update_url() )
        );

        printf( '<div class="%1$s"><p>%2$s</p></div>', 'notice notice-success is-dismissible', wp_kses_post( $message ) );
    }


    /**
     * Get the URL that starts the update of this plugin
     *
     * @since 5.5.9
     * @return string
     */
    private function get_update_url() {
        return add_query_arg(
            array(
                'action' => 'upgrade-plugin',
                'plugin' => $this->basename,
                '_wpnonce' => wp_create_nonce( 'upgrade-plugin_' . $this->basename ),
            ),
            admin_url('update.php')
        );
    }


    /**
     * Remove the state left behind by the proprietary license and update channels
     *
     * @since 5.5.9
     * @version 6.0.0
     * @return void
     */
    private function maybe_migrate_legacy_state() {
        if ( get_option('woo_custom_installments_fork_migration') === 'yes' ) {
            return;
        }

        wp_clear_scheduled_hook('Woo_Custom_Installments/Updates/Auto_Updates');
        wp_clear_scheduled_hook('Woo_Custom_Installments/Updates/Check_Daily_Updates');
        wp_clear_scheduled_hook('Woo_Custom_Installments/License/Check_Expires_Time');

        delete_option('woo_custom_installments_update_available');
        delete_transient('woo_custom_installments_check_updates');
        delete_transient('woo_custom_installments_remote_data');

        update_option( 'woo_custom_installments_fork_migration', 'yes' );
    }
}
