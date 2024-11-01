<?php
/**
 * Created by PhpStorm.
 * User: len
 * Date: 07/08/18
 * Time: 15:06
 */
global $post;

class xtrad_viewer_tinymce
{
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

    public function xtrad_tinymce_buttons() {
        global $wp_version;
        if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
            return;
        }

        if ( get_user_option( 'rich_editing' ) !== 'true' ) {
            return;
        }

        $versionsplit = explode(".", $wp_version);
        $majorversion = intval($versionsplit[0]);

        if ( $this->is_classic_editor_plugin_active() || $majorversion < 5) {
            add_filter('mce_external_plugins', array($this, 'xtrad_add_buttons'));
            add_filter('mce_buttons', array($this, 'xtrad_register_buttons'));
        }
    }

    private function is_classic_editor_plugin_active() {
        if ( ! function_exists( 'is_plugin_active' ) ) {
            include_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        if ( is_plugin_active( 'classic-editor/classic-editor.php' ) ) {
            return true;
        }

        return false;
    }
    public function xtrad_add_buttons( $plugin_array ) {
        $plugin_array['xtradbutton'] = plugins_url('/js/xtrad-tinymce-buttons.min.js', dirname( __FILE__ ) );
        return $plugin_array;
    }


    public function xtrad_register_buttons( $buttons ) {
        array_push( $buttons, 'xtradbutton' );
        return $buttons;
    }

    public function xtrad_tinymce_extra_vars() { ?>
        <script type="text/javascript">
            var tinyMCE_object = <?php echo json_encode(
                    array(
                        'button_name' => esc_html__('XTRA', 'xtrad-viewer'),
                        'button_title' => esc_html__('XTRAD Viewer', 'xtrad-viewer'),
                        'image_title' => esc_html__('Inital Image', 'xtrad-viewer'),
                        'image_button_title' => esc_html__('Upload image', 'xtrad-viewer'),
                    )
                );
                ?>;
        </script><?php
    }
}