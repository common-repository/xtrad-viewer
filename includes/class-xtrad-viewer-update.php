<?php
/**
 * Created by PhpStorm.
 * User: len
 * Date: 14/10/18
 * Time: 11:52
 */

global $xtrad_viewer_db_version;
$xtrad_viewer_db_version = '1.04';
global $xtrad_viewer_lib_version;
$xtrad_viewer_lib_version = '1.17';

class xtrad_admin_viewer_update
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

    public function __construct($xtrad_viewer, $version)
    {

        $this->xtrad_viewer = $xtrad_viewer;
        $this->version = $version;

    }

    public function xtrad_viewer_check_update()
    {

        global $xtrad_viewer_db_version;
        global $xtrad_viewer_lib_version;

        if (get_site_option('xtrad_viewer_db_version') != $xtrad_viewer_db_version) {
            $this->xtrad_viewer_update();
        }

        if (get_site_option('xtrad_viewer_lib_version') != $xtrad_viewer_lib_version) {
            $this->copyLibrary();
        }

    }

    public function xtrad_viewer_update()
    {
        global $xtrad_viewer_db_version;

        require_once(ABSPATH . '/wp-admin/includes/upgrade.php');

        $this->createUpdateScenes();

        update_option('xtrad_viewer_db_version', $xtrad_viewer_db_version);
    }

    private function createUpdateScenes()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'xdscenes';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			name tinytext NOT NULL,
			type tinytext NOT NULL,
			scenedata LONGBLOB NULL,
			image LONGBLOB NULL,
			heightratio INT DEFAULT 50 NOT NULL,
			createddate datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			modifieddate datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";

        $result = dbDelta($sql);
    }

    public function copyLibrary()
    {
        global $xtrad_viewer_lib_version;

        $upload_dir = wp_upload_dir();
        $upload_dir = $upload_dir['basedir'];

        $baseurlto = $upload_dir . '/xtrad-library';
        $baseurlfrom = plugin_dir_path( dirname(__FILE__) ) . '/xtrad-library';

        $this->recurse_copy($baseurlfrom, $baseurlto);

        $templateDir = $upload_dir . '/xtrad-library/templates';
        @mkdir($templateDir);

        update_option('xtrad_viewer_lib_version', $xtrad_viewer_lib_version);

    }

    public function recurse_copy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

}