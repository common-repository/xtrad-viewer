<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    xtrad_Viewer
 * @subpackage xtrad_Viewer/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Xtrad_Viewer
 * @subpackage Xtrad_Viewer/admin
 * @author     Len Ford <len.ford@audlemsoftware.net>
 */
class Xtrad_Viewer_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $xtrad_viewer The ID of this plugin.
     */
    private $xtrad_viewer;

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
     * @param      string $xtrad_viewer The name of this plugin.
     * @param      string $version The version of this plugin.
     *
     **/

    private $itemReference = 'Xtrad Viewer';

    public function __construct($xtrad_viewer, $version)
    {

        $this->xtrad_viewer = $xtrad_viewer;
        $this->version = $version;
        if( Site_Url( ) === 'http://xtra-v.com') {
            $this->baseUrl = 'xtra-a.co.uk';
        }

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Xtra_Viewer_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Xtra_Viewer_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in xtrad_Viewer_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The xtrad_Viewer_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        $current_page = get_current_screen()->base;

        //wp_enqueue_script('xtrad-tinymce', plugin_dir_url(_dirname( __FILE__ )_) . 'js/xtrad-tinymce_buttons.js', array('jquery', 'jquery-ui-core', 'jquery-ui-button', 'jquery-ui-dialog'), $this->version, false);

        if ($current_page == '3d-viewer_page_xtrad-viewer-menu') {
            wp_enqueue_style('xtrad-script-aud-admin', plugins_url('/admin/css/xtrad-admin.css', dirname( __FILE__ ) ) );

            wp_enqueue_style('xtrad-script-aud-bootstrap', plugins_url('/css/bootstrap.min.css', dirname( __FILE__ ) ) );
            wp_enqueue_style('xtrad-script-aud-bootstrap-theme', plugins_url('/css/bootstrap-theme.min.css', dirname( __FILE__ ) ) );

            wp_enqueue_style('xtrad-script-viewer-main', plugins_url('/css/viewer-main.css', dirname( __FILE__ ) ) );
            wp_enqueue_style('xtrad-script-viewer-dark', plugins_url('/css/viewer-dark.css', dirname( __FILE__ ) ) );

            wp_enqueue_script('xtrad-script-aud-bootstrap', plugins_url('/js/bootstrap.min.js', dirname( __FILE__ ) ) );
            if(site_url() === 'http://xtra-v.com') {
                wp_enqueue_script('xtrad-viewer-admin-helpers', plugins_url('/admin/js/xtrad-viewer-admin.js', dirname( __FILE__ ) ), array('jquery', 'jquery-ui-core', 'jquery-ui-button', 'jquery-ui-dialog'), $this->version, false);
            } else {
                wp_enqueue_script('xtrad-viewer-admin-helpers', plugins_url('/admin/js/xtrad-viewer-admin.min.js', dirname( __FILE__ ) ), array('jquery', 'jquery-ui-core', 'jquery-ui-button', 'jquery-ui-dialog'), $this->version, false);
            }
            $current_user = wp_get_current_user();
            $user_id = $current_user->ID;
            $uData = get_userdata($user_id);
            $upload_dir = wp_upload_dir();

            wp_localize_script('xtrad-viewer-admin-helpers', 'xtradViewerData', array(
                'nonce' => wp_create_nonce('wp_rest'),
                'pluginurl' => plugins_url('', dirname( __FILE__ ) ),
                'uploadurl' => $upload_dir['baseurl'],
                'baseurl' => site_url(),
                'author' => $uData->display_name
            ));


            if(site_url() === 'http://xtra-v.com') {
                wp_enqueue_script('xtrad-viewer-admin-helpers', plugins_url('/admin/js/xtrad-viewer-admin.js', dirname( __FILE__ ) ), array('jquery', 'jquery-ui-core', 'jquery-ui-button', 'jquery-ui-dialog'), $this->version, false);

                wp_enqueue_script('xtrad-script-three', plugins_url('/js/three.js', dirname( __FILE__ ) ) );
                wp_localize_script('xtrad-script-three', 'xtradDirData', array(
                    'nonce' => wp_create_nonce('wp_rest'),
                    'pluginurl' => plugins_url( '', dirname( __FILE__ )),
                    'uploadurl' => $upload_dir['baseurl'],
                    'baseurl' => site_url(),
                    'author' => $uData->display_name
                ));

                wp_enqueue_script('xtrad-script-bothlibs', plugins_url('/js/bothlibs.js', dirname( __FILE__ ) ) );
                wp_localize_script('xtrad-script-bothlibs', 'xtradDirData', array(
                    'nonce' => wp_create_nonce('wp_rest'),
                    'pluginurl' => plugins_url( '', dirname( __FILE__ ) ) ,
                    'uploadurl' => $upload_dir['baseurl'],
                    'baseurl' => site_url(),
                    'author' => $uData->display_name
                ));
                wp_enqueue_script('xtrad-script-alllibs', plugins_url('/js/alllibs.js', dirname( __FILE__ ) ) );

                wp_enqueue_script('xtrad-script-peg', plugins_url('/js/peg-0.10.0.min.js', dirname( __FILE__ ) ) );
                wp_enqueue_script('xtrad-filesaver', plugins_url('/js/filesaver.min.js', dirname( __FILE__ ) ) );

                wp_enqueue_script('xtrad-script-threed-allviewer', plugins_url('/js/allviewer.js', dirname( __FILE__ ) ) );
                wp_localize_script('xtrad-script-threed-allviewer', 'xtradDirData', array(
                    'nonce' => wp_create_nonce('wp_rest'),
                    'pluginurl' => plugins_url( '', dirname( __FILE__ ) ) ,
                    'uploadurl' => $upload_dir['baseurl'],
                    'baseurl' => site_url(),
                    'author' => $uData->display_name
                ));

                wp_enqueue_script('xtrad-script-aud-threed', plugins_url('/js/xtradv-threed.js', dirname( __FILE__ ) ) );
                wp_localize_script('xtrad-script-aud-threed', 'xtradDirData', array(
                    'nonce' => wp_create_nonce('wp_rest'),
                    'pluginurl' => plugins_url( '', dirname( __FILE__ ) ) ,
                    'uploadurl' => $upload_dir['baseurl'],
                    'baseurl' => site_url(),
                    'author' => $uData->display_name
                ));

            } else {
                wp_enqueue_script('xtrad-viewer-admin-helpers', plugins_url('/admin/js/xtrad-viewer-admin.min.js', dirname( __FILE__ ) ), array('jquery', 'jquery-ui-core', 'jquery-ui-button', 'jquery-ui-dialog'), $this->version, false);
                wp_enqueue_script('xtrad-script-three', plugins_url('/js/xdthree.min.js', dirname( __FILE__ ) ) );
                wp_localize_script('xtrad-script-three', 'xtradDirData', array(
                    'nonce' => wp_create_nonce('wp_rest'),
                    'pluginurl' => plugins_url( '', dirname( __FILE__ ) ),
                    'uploadurl' => $upload_dir['baseurl'],
                    'baseurl' => site_url(),
                    'author' => $uData->display_name
                ));
                wp_enqueue_script('xtrad-script-bothlibs', plugins_url('/js/bothlibs.min.js', dirname( __FILE__ ) ) );
                wp_localize_script('xtrad-script-bothlibs', 'xtradDirData', array(
                    'nonce' => wp_create_nonce('wp_rest'),
                    'pluginurl' => plugins_url( '', dirname( __FILE__ ) ),
                    'uploadurl' => $upload_dir['baseurl'],
                    'baseurl' => site_url(),
                    'author' => $uData->display_name
                ));
                wp_enqueue_script('xtrad-script-alllibs', plugins_url('/js/alllibs.min.js', dirname( __FILE__ ) ) );

                wp_enqueue_script('xtrad-script-peg', plugins_url('/js/peg-0.10.0.min.js', dirname( __FILE__ ) ) );

                wp_enqueue_script('xtrad-script-threed-allviewer', plugins_url('/js/allviewer.min.js', dirname( __FILE__ ) ) );
                wp_localize_script('xtrad-script-threed-allviewer', 'xtradDirData', array(
                    'nonce' => wp_create_nonce('wp_rest'),
                    'pluginurl' => plugins_url( '', dirname( __FILE__ ) ),
                    'uploadurl' => $upload_dir['baseurl'],
                    'baseurl' => site_url(),
                    'author' => $uData->display_name
                ));

                wp_enqueue_script('xtrad-script-aud-threed', plugins_url('/js/xtradv-threed.min.js', dirname( __FILE__ ) ) );
                wp_localize_script('xtrad-script-aud-threed', 'xtradDirData', array(
                    'nonce' => wp_create_nonce('wp_rest'),
                    'pluginurl' => plugins_url( '', dirname( __FILE__ ) ),
                    'uploadurl' => $upload_dir['baseurl'],
                    'baseurl' => site_url(),
                    'author' => $uData->display_name
                ));

            }

        } elseif ($current_page == 'toplevel_page_xtrad-top-menu') {
            wp_enqueue_style('xtrad-script-aud-bootstrap', plugins_url('/css/bootstrap.min.css', dirname( __FILE__ ) ) );
            wp_enqueue_style('xtrad-script-aud-bootstrap-theme', plugins_url('/css/bootstrap-theme.min.css', dirname( __FILE__ ) ) );
            wp_enqueue_script('bootstrap-min', plugins_url('/js/bootstrap.min.js', dirname( __FILE__ ) ), null, $this->version, false);
        } else {
            wp_dequeue_style('xtrad-script-aud-admin');

            wp_dequeue_style('xtrad-script-aud-bootstrap');
            wp_dequeue_style('xtrad-script-aud-bootstrap-theme');

            wp_dequeue_style('xtrad-script-viewer-main');
            wp_dequeue_style('xtrad-script-viewer-dark');

            wp_dequeue_script($this->xtrad_viewer);
            wp_dequeue_script('xtrad-script-aud-bootstrap');
            wp_dequeue_script('xtrad-viewer-admin-helpers');
            wp_dequeue_script('xtrad-script-three');

            wp_dequeue_script('xtrad-script-bothlibs');
            wp_dequeue_script('xtrad-script-alllibs');

            wp_dequeue_script('xtrad-script-peg');
            wp_enqueue_script('xtrad-filesaver');

            wp_dequeue_script('xtrad-script-threed-app');

            wp_dequeue_script('xtrad-script-threed-allviewer');

            wp_dequeue_script('xtrad-script-aud-threed');


        }
    }

    public function xtrad_plugin_top_menu()
    {
        $xtrad_admin_page = new xtrad_admin_page($this->xtrad_viewer, $this->version);
        $xtrad_general_admin_page = new xtrad_general_admin_page($this->xtrad_viewer, $this->version);

        add_menu_page('My Plugin', '3D Viewer', 'manage_options', 'xtrad-top-menu', array($xtrad_general_admin_page, 'xtrad_render_general_plugin_page'), 'dashicons-video-alt2');

        add_submenu_page('xtrad-top-menu', '3D Viewer', 'Viewer', 'manage_options', 'xtrad-viewer-menu', array($xtrad_admin_page, 'xtrad_render_plugin_page'));

    }

    public function xtrad_plugin_cpt()
    {
        $xtrad_admin_page = new xtrad_admin_page($this->xtrad_viewer, $this->version);
        add_action('init', array($xtrad_admin_page, 'xtrad_render_plugin_page'));
    }

    public function xtrad_theme_setup()
    {
        $xtrad_viewer_tinymce = new xtrad_viewer_tinymce($this->xtrad_viewer, $this->version);
        add_action('init', array($xtrad_viewer_tinymce, 'xtrad_tinymce_buttons'));
        add_action('after_wp_tiny_mce', array($xtrad_viewer_tinymce, 'xtrad_tinymce_extra_vars'));
    }

 }
