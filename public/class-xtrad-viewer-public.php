<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Xtrad_Viewer
 * @subpackage Xtrad_Viewer/public
 * @author     Len Ford <len.ford@audlemsoftware.net>
 */
class Xtrad_Viewer_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $aud3d_viewer    The ID of this plugin.
	 */
	private $xtrad_viewer;

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
	 * @param      string    $xtrad_viewer       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $xtrad_viewer, $version ) {

		$this->xtrad_viewer = $xtrad_viewer;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		//wp_enqueue_style( $this->xtrad_viewer, plugin_dir_url( _dirname( __FILE__ )_ ) . 'css/xtrad-viewer-public.css', array(), $this->version, 'all' );

 	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

        $upload_dir = wp_upload_dir();

        if(site_url() === 'http://xtra-v.com') {
            wp_enqueue_script('xtrad-script-three', plugins_url('js/three.js', dirname( __FILE__ ) ) );
            wp_localize_script('xtrad-script-three', 'xtradDirData', array(
                'nonce' => wp_create_nonce('wp_rest'),
                'pluginurl' => plugins_url( '', dirname( __FILE__ ) ) ,
                'uploadurl' => $upload_dir['baseurl'],
                'baseurl' => site_url(),
                'author' => ''
            ));
            wp_enqueue_script('xtrad-script-bothlib',plugins_url('/js/bothlibs.js', dirname( __FILE__ ) ) );
            wp_localize_script('xtrad-script-bothlibs', 'xtradDirData', array(
                'nonce' => wp_create_nonce('wp_rest'),
                'pluginurl' => plugins_url( '', dirname( __FILE__ ) ),
                'uploadurl' => $upload_dir['baseurl'],
                'baseurl' => site_url(),
                'author' => ''
            ));
        } else {
            wp_enqueue_script('xtrad-script-three',plugins_url('/js/xdthree.min.js', dirname( __FILE__ ) ) );
            wp_localize_script('xtrad-script-three', 'xtradDirData', array(
                'nonce' => wp_create_nonce('wp_rest'),
                'pluginurl' => plugins_url( '', dirname( __FILE__ ) ),
                'uploadurl' => $upload_dir['baseurl'],
                'baseurl' => site_url(),
                'author' => ''
            ));
            wp_enqueue_script('xtrad-script-bothlib',plugins_url('/js/bothlibs.min.js', dirname( __FILE__ ) ) );
            wp_localize_script('xtrad-script-bothlibs', 'xtradDirData', array(
                'nonce' => wp_create_nonce('wp_rest'),
                'pluginurl' => plugins_url( '', dirname( __FILE__ ) ),
                'uploadurl' => $upload_dir['baseurl'],
                'baseurl' => site_url(),
                'author' => ''
            ));
        }

    }
}
