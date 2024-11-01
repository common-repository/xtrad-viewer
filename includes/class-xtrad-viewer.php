<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Xtrad_Viewer
 * @subpackage Xtrad_Viewer/includes
 * @author     Len Ford <len.ford@audlemsoftware.net>
 */
class Xtrad_Viewer
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Xtrad_Viewer_Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $aud3d_viewer The string used to uniquely identify this plugin.
     */
    protected $xtrad_viewer;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $version The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        if (defined('XTRAD_VIEWER_VERSION')) {
            $this->version = XTRAD_VIEWER_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->xtrad_viewer = 'xtrad-viewer';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
        $this->define_both_hooks();

    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Xtrad_Viewer_Loader. Orchestrates the hooks of the plugin.
     * - Xtrad_Viewer_i18n. Defines internationalization functionality.
     * - Xtrad_Viewer_Admin. Defines all hooks for the admin area.
     * - Xtrad_Viewer_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies()
    {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-xtrad-viewer-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-xtrad-viewer-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-xtrad-viewer-admin.php';
        require_once(plugin_dir_path(dirname(__FILE__)) . 'admin/class-xtrad-viewer-vc.php');

        /**
         * The class responsible for defining all actions that occur in both
         * sides of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-xtrad-viewer-both.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-xtrad-viewer-loaded.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-xtrad-viewer-update.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-xtrad-viewer-public.php';

        require_once(plugin_dir_path(dirname(__FILE__)) . '/admin/partials/xtrad-viewer-admin-display.php');
        require_once(plugin_dir_path(dirname(__FILE__)) . '/admin/partials/xtrad-general-admin-display.php');
        require_once(plugin_dir_path(dirname(__FILE__)) . '/admin/partials/xtrad-viewer-tinymce-display.php');

        require_once(plugin_dir_path(dirname(__FILE__)) . '/public/partials/xtrad-viewer-public-display.php');
 
        require_once(plugin_dir_path(dirname(__FILE__)) . 'includes/class-xtrad-viewer-cpt.php');

        $this->loader = new Xtrad_Viewer_Loader();

    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Aud3d_Viewer_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale()
    {

        $plugin_i18n = new Xtrad_Viewer_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {

        $plugin_admin = new Xtrad_Viewer_Admin($this->get_xtrad_viewer(), $this->get_version());
        $xtrad_admin_viewer_plugins_loaded = new xtrad_admin_viewer_plugins_loaded($this->get_xtrad_viewer(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        $this->loader->add_action('admin_menu', $plugin_admin, 'xtrad_plugin_top_menu');
        $this->loader->add_action('after_setup_theme', $plugin_admin, 'xtrad_theme_setup');
        $this->loader->add_action('plugins_loaded', $xtrad_admin_viewer_plugins_loaded, 'xtrad_viewer_on_plugins_loaded');

        if (defined('WPB_VC_VERSION')) {
            $plugin_vc = new Xtrad_Viewer_Vc($this->get_xtrad_viewer(), $this->get_version());
            $this->loader->add_action('vc_before_init', $plugin_vc, 'xtrad_vc_init');
        }

    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks()
    {

        $plugin_public = new Xtrad_Viewer_Public($this->get_xtrad_viewer(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_both_hooks()
    {

        $plugin_both = new Xtrad_Viewer_Both($this->get_xtrad_viewer(), $this->get_version());

        $xtrad_public_page = new xtrad_viewer_public_page($this->xtrad_viewer, $this->version);
        add_shortcode('xtradscene', array($xtrad_public_page, 'xtrad_shortcode_3dscene'));

        $xtrad_admin_page = new xtrad_admin_page($this->xtrad_viewer, $this->version);
        add_action('wp_ajax_list_files', array($xtrad_admin_page, 'list_files'));
        add_action('wp_ajax_list_scenes', array($xtrad_admin_page, 'list_scenes'));
        add_action('wp_ajax_list_images', array($xtrad_admin_page, 'list_images'));
        add_action('wp_ajax_get_scene', array($xtrad_admin_page, 'get_scene'));
        add_action('wp_ajax_get_template', array($xtrad_admin_page, 'get_template'));
        add_action('wp_ajax_nopriv_list_files', array($xtrad_admin_page, 'list_files'));
        add_action('wp_ajax_nopriv_list_scenes', array($xtrad_admin_page, 'list_scenes'));
        add_action('wp_ajax_nopriv_list_images', array($xtrad_admin_page, 'list_images'));
        add_action('wp_ajax_nopriv_get_scene', array($xtrad_admin_page, 'get_scene'));

        $this->loader->add_action('wp_enqueue_scripts', $plugin_both, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_both, 'enqueue_scripts');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_xtrad_viewer()
    {
        return $this->xtrad_viewer;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Xtrad_Viewer_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }
}
