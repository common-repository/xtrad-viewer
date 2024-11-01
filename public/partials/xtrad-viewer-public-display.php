<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    xtrad_viewer
 * @subpackage xtrad_viewer/public/partials
 *
 *
 */

class xtrad_viewer_public_page
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

    public function xtrad_shortcode_3dscene($atts, $content = null)
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'xdscenes';

        extract(shortcode_atts(array('id' => ''), $atts));

        $query = "SELECT * FROM $table_name where id =" . $atts['id'];
        $scene = $wpdb->get_row($query, OBJECT);
        if ($scene != null) {

            $id = $scene->id;

            $plug = plugins_url('', dirname( __FILE__ ) );
            $index = strrpos( $plug , '/' );
            $plug = substr($plug, 0, $index);

            wp_register_script('xtrad-shortcode', $plug . '/public/js/xtrad-viewer-public.min.js', array('jquery'));

            $home_url = site_url();

            $orbit = null;

            if ($atts['orbit'] != null) {
                $orbit = array(
                    'orbit' => $atts['orbit'],
                    'minPolarAngle' => array_key_exists('minpolarangle', $atts) ? $atts['minpolarangle'] : null,
                    'maxPolarAngle' => array_key_exists('maxpolarangle', $atts) != null ? $atts['maxpolarangle'] : null,
                    'minAzimuthAngle' => array_key_exists('minazimuthangle', $atts) != null ? $atts['minazimuthangle'] : null,
                    'maxAzimuthAngle' => array_key_exists('maxazimuthangle', $atts)  != null ? $atts['maxazimuthangle'] : null,
                    'minDistance' => array_key_exists('mindistance', $atts)  != null ? $atts['mindistance'] : null,
                    'maxDistance' => array_key_exists('maxdistance', $atts)  != null ? $atts['maxdistance'] : null
                );
            }

            if (function_exists("gzdecode")) {

                if ($scene->type === 'gzip') {

                    $json = gzdecode($scene->scenedata);

                }

            } else {

                $json = $scene->scenedata;

            }

            $heightRatio = 50;
            if ($scene->heightratio != null) {
                $heightRatio = $scene->heightratio;
            }

            $img = isset($atts['img']) ? $atts['img'] : '';
            $imgsrc = '';
            if (strlen($img) > 0) {
                $imgsrcdata = wp_get_attachment_image_src($img, 'full');
                if ($imgsrcdata != null) {
                    $imgsrc = $imgsrcdata[0];
                }
            }
            // Localize the script with new data
            $post_array = array(
                'home' => $home_url,
                'scene_name' => $scene->name,
                'json' => $json,
                'type' => 'json',
                'orbit' => $orbit,
                'img' => $img,
                'imgsrc' => $imgsrc,
                'heightratio' => $heightRatio);

            wp_localize_script('xtrad-shortcode', 'post' . $id, $post_array);

            // Enqueued script with localized data.
            wp_enqueue_script('xtrad-shortcode');
            $name = 'xtrad-viewer-' . $id;
            $nameimage = 'xtrad-viewer-image-' . $id;

            $output = "<div class='xtrad-viewer' id='$name' name='$name' ></div>";
            $output .= "<div class='xtrad-viewer-image' id='$nameimage' name='$nameimage' ></div>";

            return $output;
        }

    }

}




