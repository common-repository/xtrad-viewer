<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Aud3d_Viewer
 * @subpackage Aud3d_Viewer/admin
 */

/**
 * The common functionality of the plugin.
 *
 * @package    Xtrad_Viewer_Both
 * @subpackage Xtrad_Viewer_Both
 * @author     Len Ford <len.ford@audlemsoftware.net>
 */
class Xtrad_Viewer_Both {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $xtrad_viewer    The ID of this plugin.
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
	 * @param      string    $xtrad_viewer       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $xtrad_viewer, $version ) {

		$this->xtrad_viewer = $xtrad_viewer;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for both area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

	}

	/**
	 * Register the JavaScript for both areas.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

        if(site_url() === 'http://xtra-v.com') {
            wp_enqueue_script('xtrad-script-three', plugins_url('/js/three.js', dirname( __FILE__ ) ) );
            wp_enqueue_script('xtrad-script-bothlibs', plugins_url( '/js/bothlibs.js', dirname( __FILE__ ) ) );

            wp_enqueue_script('xtrad-script-aud-threed', plugins_url( '/js/xtradv-threed.js', dirname( __FILE__ ) ) );
            wp_enqueue_script('xtrad-script-orbit-control', plugins_url('js/both/OrbitControls.js', dirname( __FILE__ ) ) );

        } else {

            wp_enqueue_script('xtrad-script-three', plugins_url('/js/xdthree.min.js', dirname( __FILE__ ) ) );
            wp_enqueue_script('xtrad-script-bothlibs', plugins_url('/js/bothlibs.min.js', dirname( __FILE__ ) ) );

            wp_enqueue_script('xtrad-script-aud-threed', plugins_url( '/js/xtradv-threed.min.js', dirname( __FILE__ ) ) );
            wp_enqueue_script('xtrad-script-orbit-control', plugins_url( '/js/both/OrbitControls.js', dirname( __FILE__ ) ) );
        }
    }


    public function register_shortcodes() {
        $xtrad_public_page = new xtrad_viewer_public_page($this->xtrad_viewer, $this->version);
        add_shortcode('xtradscene', array( $xtrad_public_page, 'xtrad_shortcode_3dview'));
    }

    public function register_posttype_3dview () {
        $xtrad_viewer_cpt = new xtrad_viewer_cpt($this->xtrad_viewer, $this->version);
        add_action('init', array( $xtrad_viewer_cpt, 'xtrad_register_3dview'));
    }
}
