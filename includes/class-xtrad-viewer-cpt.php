<?php
class xtrad_viewer_cpt
{
    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $xtrad_viewer The string used to uniquely identify this plugin.
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

    public function __construct( $xtrad_viewer, $version ) {

        $this->xtrad_viewer = $xtrad_viewer;
        $this->version = $version;

    }

}