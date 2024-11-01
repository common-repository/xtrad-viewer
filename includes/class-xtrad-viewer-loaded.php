<?php
/**
 * Created by PhpStorm.
 * User: len
 * Date: 14/10/18
 * Time: 12:01
 */

class xtrad_admin_viewer_plugins_loaded
{
    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $viewer_admin The string used to uniquely identify this plugin.
     */
    protected $viewer_admin;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $version The current version of the plugin.
     */
    protected $version;

    public function __construct( $viewer_admin, $version ) {

        $this->viewer_admin = $viewer_admin;
        $this->version = $version;

    }

    public function xtrad_viewer_on_plugins_loaded()
    {
        $admin_update_check = new xtrad_admin_viewer_update($this->viewer_admin, $this->version);
        $admin_update_check->xtrad_viewer_check_update();

    }
}