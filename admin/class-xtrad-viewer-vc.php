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
 * @subpackage Xtrad_Viewer/vc
 * @author     Len Ford <len.ford@audlemsoftware.net>
 */
class Xtrad_Viewer_Vc
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
     */
    public function __construct($xtrad_viewer, $version)
    {

        $this->xtrad_viewer = $xtrad_viewer;
        $this->version = $version;

    }

    public function xtrad_vc_init()
    {

        global $wpdb;

        $table_name = $wpdb->prefix . 'xdscenes';

        $query = "SELECT id, name FROM $table_name";
        $scenes = $wpdb->get_results($query);

        if ($wpdb->num_rows > 0) {

            foreach ($scenes as $scene) {

                $views[$scene->name] = $scene->id;
                $checkValues[$scene->name] = $scene->id;

            }
        }

        vc_map(
            array(
                'name' => __('Xtrad Scene'),
                'base' => 'xtradscene',
                'category' => __('Xtrad'),
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Xtrad Scene', 'xtrad-viewer'),
                        'param_name' => 'id',
                        'admin_label' => true,
                        'value' => $views,
                        'std' => 1,
                        'description' => __('Select Xtrad Scene to be displayed', 'xtrad-viewer')
                    ),

                    array(
                        'type' => 'attach_image',
                        'heading' => __('Inital Image', 'js_composer'),
                        'param_name' => 'img',
                        'value' => '',
                        'description' => __('Select Initial Image from media library', 'xtrad-viewer')
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => __('Include Orbit Control', 'xtrad-viewer'),
                        'param_name' => 'orbit',
                        'value' => ''
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __('Minimum Polar Angle (vertical in degrees 0 -> 180)', 'xtrad-viewer'),
                        'param_name' => 'minpolarangle',
                        'value' => '0'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __('Maximum Polar Angle (vertical in degrees 0 -> 180)', 'xtrad-viewer'),
                        'param_name' => 'maxpolarangle',
                        'value' => '90'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __('Minimum Azimuth Angle (horizontal in degrees) - leave blank for default(No Constraint)', 'xtrad-viewer'),
                        'param_name' => 'minazimuthangle',
                        'value' => ''
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __('Maximum Azimuth Angle (horizontal in degrees) - leave blank for default(No Constraint)', 'xtrad-viewer'),
                        'param_name' => 'maxazimuthangle',
                        'value' => ''
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __('Minimum Distance for zoom', 'xtrad-viewer'),
                        'param_name' => 'mindistance',
                        'value' => '10'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __('Maximum Distance for zoom', 'xtrad-viewer'),
                        'param_name' => 'maxdistance',
                        'value' => '1000'
                    )
                )
            )
        );
    }
}
