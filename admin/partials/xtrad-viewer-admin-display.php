<?php

/*
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Xtrad_Viewer
 * @subpackage AXtrad_viewer/admin/partials
 */
global $post;

class xtrad_admin_page
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

    private $libraryUrl = 'https://xtra-dimension.com/';

    /**
     * Initialize the class and set its properties.
     *
     * @param string $xtrad_viewer The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($xtrad_viewer, $version)
    {
        $this->xtrad_viewer = $xtrad_viewer;
        $this->version = $version;

        $baseurl = site_url();

        if ($baseurl === 'http://xtra-v.com') {

           // $this->libraryUrl = 'http://xtra-a.com/';

        }

    }

    public function xtrad_render_plugin_page()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'xdscenes';

        //must check that the user has the required capability
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        $this->add_render_plugin_page_handle_post();

        ?>

        <div class='wrap'>
            <div id='views-grid' class="container" style="display: block;">
                <?php
                $paged = isset($_GET['paged']) ? $_GET['paged'] : 1;
                $paged = (int)sanitize_text_field( $paged );
                $queryids = "SELECT id FROM $table_name";
                $rows_per_page = 8;
                $sceneids = $wpdb->get_results($queryids);     // gets the ids of all scenes
                $rowcount = $wpdb->num_rows;
                $total_pages = ceil($rowcount / $rows_per_page);

                ?>
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>3D Scenes</h2>
                            </div>
                            <div class="col-sm-6">
                                <input type='button' id='new-scene' name='new-scene' class='btn btn-primary'
                                       value='Add New Scene'/>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Scene Name</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // form ids string
                        if ($rowcount > 0) {
                            $idstr = '';
                            for ($i = 0; $i < $rows_per_page; $i++) {
                                $index = (($paged - 1) * $rows_per_page) + $i;
                                if ($index < $rowcount) {
                                    $sceneid = $sceneids[$index]->id;
                                    $idstr .= $sceneid . ',';
                                }
                            }
                            if (strlen($idstr) > 0) $idstr = substr($idstr, 0, strlen($idstr) - 1);
                            $querypage = "SELECT id, name, image, heightratio FROM $table_name WHERE id in (" . $idstr . ")";
                            $scenes = $wpdb->get_results($querypage);     // gets the ids of all scenes

                            foreach ($scenes as $scene) {

                                $scene_id = $scene->id;
                                $scene_name = $scene->name;
                                $scene_image = $scene->image;
                                $scene_hr = $scene->heightratio;

                                /*                            if($json[0] != '{') {
                                                                        $huffman = new Huffman();
                                                                        $json = base64_decode($json);
                                                                        $json = $huffman->decompress($json);
                                                                    }
                                 */
                                ?>
                                <tr>
                                    <td style="width: 10%;"><?php echo($scene_id) ?></td>
                                    <td style="width: 40%;"><?php echo($scene_name) ?></td>

                                    <?php
                                    if (isset($scene_image)) {
                                        $width = "350px";
                                        $height = (350 * $scene_hr) / 100;
                                        if ($height === 0) {
                                            $height = 350 / 2;
                                        }
                                        ?>
                                        <td>
                                            <img style=" width: <?php echo($width) ?>; height: <?php echo($height) ?>px;"
                                                 src=" <?php echo(base64_decode($scene_image)) ?>"/>
                                        </td>
                                        <?php

                                    } else {
                                        ?>
                                        <td>
                                            &nbsp;
                                        </td>
                                        <?php
                                    }
                                    ?>

                                    <td style="width: 20%;">
                                        <input type='button'
                                               name='<?php echo('edit-view-' . $scene_id) ?>'
                                               class='edit-view btn btn-primary' value='Edit'/>
                                        <input type="hidden"
                                               id="<?php echo('edit-scene-id-' . $scene_id) ?>"
                                               name="viewer-scene-id"
                                               value="<?php echo($scene_name) ?>"/>
                                        <?php
                                        ?>
                                        <input type="hidden"
                                               id="<?php echo('edit-thumb-' . $scene_id) ?>"
                                               name="viewer-thumb" value=""/>
                                        <input type="hidden" id="viewer-mode" name="viewer-mode"
                                               value="delete"/>
                                        <a href='#deleteView' class='delete'
                                           data-id='<?php echo($scene_id) ?>'>
                                            <div>
                                                <span style="padding: 8px; height: 44px; width: 50px; background-color: red; color:white; border-color: black; border-radius: 4px;">Delete</span>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <p>No Scenes Found</p>
                            <?php
                        } ?>
                        </tbody>
                    </table>
                </div>
                <div>
                    <?php
                    // Pagination
                    //display the pagination here
                    admin_query_pagination($rowcount, 8, 'admin.php?page=xtrad-viewer-menu');
                    ?>
                </div>
            </div>
            <div id="canvasspace"></div>
            <div id='viewer' class="container-fluid" style="background-color: black; display: block">
                <div id="xtrad_viewerrowid" class="row">
                    <div id="xtrad_viewer" class="xtrad_viewer col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"
                         style="width: 100%; height: 800px;"></div>
                </div>
            </div>
            <div id='single-view' style='display: none'>
                <form method="post">
                    <?php wp_nonce_field(basename(__FILE__), 'xtrad_viewer_admin_nonce'); ?>
                    <div class="wrap xtrad-viewer-form">
                        <div class="form-group">
                            <label for="scene-name"><?php esc_html_e('Scene Name', 'xtrad-domain'); ?></label>
                            <input type="text" class="full form-control" name="scene-name" id="scene-name"
                                   placeholder="<?php esc_attr_e('scene name', 'xtrad-domain'); ?>"
                                   value="">
                            <small id="viewidHelp"
                                   class="form-text text-muted"><?php esc_html_e('Please input a unique name for the scene.', 'xtrad-domain'); ?></small>
                        </div>
                        <div>
                            <input type="submit" id="submit-button" name="submit-button" class="button-primary"
                                   value="<?php esc_attr_e('Save Changes', 'xtrad-domain') ?>"/>
                            <input type="button" id="cancel-button" name="cancel-button" class="btn-secondary"
                                   value="<?php esc_attr_e('Cancel', 'xtrad-domain') ?>"/>
                            <input type="hidden" id="viewer-json" name="viewer-json" value=""/>
                            <input type="hidden" id="scene-image" name="scene-image" value=""/>
                            <input type="hidden" id="scene-hr" name="scene-hr" value=""/>
                            <input type="hidden" id="scene-id" name="scene-id" value=""/>
                            <input type="hidden" id="viewer-mode" name="viewer-mode" value="update"/>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Delete Modal HTML -->
            <?php wp_nonce_field(basename(__FILE__), 'xtrad_viewer_admin_nonce'); ?>
            <div id="deleteView" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- give your form an action and method -->
                        <form action="" method="post">
                            <?php wp_nonce_field(basename(__FILE__), 'xtrad_viewer_admin_nonce'); ?>
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Scene</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this Scene?</p>
                                <p class="text-warning">
                                    <small>This action cannot be undone.</small>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <!-- add a hidden input field to store ID for next step -->
                                <input type="hidden" name="scene-id" value=""/>
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <!-- change your delete link to a submit button -->
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Show Uploading Modal HTML -->
            <?php wp_nonce_field(basename(__FILE__), 'xtrad_viewer_admin_nonce'); ?>
            <div id="uploadingView" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Saving Scene to Server</h4>
                        </div>
                        <div class="modal-body">
                            <p>Uploading...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }


    private function add_render_plugin_page_handle_post()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'xdscenes';

        $is_valid_nonce = (isset($_POST['xtrad_viewer_admin_nonce']) && wp_verify_nonce($_POST['xtrad_viewer_admin_nonce'], basename(__FILE__))) ? 'true' : 'false';

        if ($is_valid_nonce == "false") {
            return;
        }

        // If the above are valid, sanitize and save the option.
        if (isset($_POST['scene-name'])) {
            if (null !== wp_unslash($_POST['scene-name'])) {
                $scene_name = sanitize_text_field($_POST['scene-name']);
                $scene_id = sanitize_text_field($_POST['scene-id']);
                if (isset($_POST['viewer-json']) ) {
                    // the JSON code cannot be sanitized
                    // It could contain almost anything
                    $viewer_json = $_POST['viewer-json'];

                    if (strlen($scene_name) > 0) {

                        $scene_image = ISSET($_POST['scene-image']) ? $_POST['scene-image'] : '';
                        // $scene_image should be a dataUrl
                        $length = strlen('data:image/png;');
                        if(!substr($scene_image, 0, $length) === 'data:image/png;') {
                            $scene_image = '';
                        }

                        $scene_hr = ISSET($_POST['scene-hr']) ? $_POST['scene-hr'] : '';
                        $scene_hr = sanitize_text_field($scene_hr);
                        $viewer_json = str_replace('\\"', '"', $viewer_json);
                        $viewer_json = str_replace('\\\'', '\'', $viewer_json);
                        $viewer_json = str_replace('\\\\n', '\\n', $viewer_json);
                        $viewer_json = str_replace('\\\\t', '\\t', $viewer_json);

                        //$json = json_decode($viewer_json);

                        $ftype = 'json';

                        if (function_exists("gzencode")) {
                            $comp = gzencode($viewer_json, 9);
                            $ftype = 'gzip';
                        }

                        $id = $wpdb->get_var("SELECT id FROM $table_name WHERE name='" . $scene_name . "'");
                        if ($id == null) {
                            // need to create a new scene
                            $wpdb->insert($table_name,
                                array(
                                    'name' => $scene_name,
                                    'scenedata' => $ftype === 'gzip' ? $comp : $viewer_json,
                                    'type' => $ftype,
                                    'image' => $scene_image,
                                    'heightratio' => $scene_hr,
                                    'createddate' => date('Y/m/d H:i:s'),
                                    'modifieddate' => date('Y/m/d H:i:s')
                                ));

                        } else {
                            $wpdb->update($table_name,
                                array(
                                    'name' => $scene_name,
                                    'scenedata' => $ftype === 'gzip' ? $comp : $viewer_json,
                                    'type' => $ftype,
                                    'image' => $scene_image,
                                    'heightratio' => $scene_hr,
                                    'modifieddate' => date('Y/m/d H:i:s')
                                ),
                                array
                                ('id' => $id)
                            );
                        }
                    }
                }
            }

        } else if (isset($_POST['scene-id'])) {
            if (null !== wp_unslash($_POST['scene-id'])) {
                // delete view
                $scene_id = sanitize_text_field($_POST['scene-id']);
                $wpdb->delete($table_name, array('id' => $scene_id));
            }
        }
    }

    public function list_files()
    {
        $upload_dir = wp_get_upload_dir();
        $upload_dir = $upload_dir['basedir'];
        $library_root = $upload_dir . '/xtrad-library';

        $json = [
            'templates' => [],
            'skyboxes' => [],
            'shaders' => [],
            'materials' => [],
            'files360' => [],
            'animations' => [],
            'videos' => [],
            'sprites' => [],
            'ttffonts' => [],
            'svg' => []
        ];

        // templates

        $dir = $library_root . '/templates/';
        $files = array_diff(scandir($dir), array('..', '.'));

        foreach ($files as $file) {
            array_push($json['templates'], $file);
        }

        // skyboxes

        $dir = $library_root . '/skyboxes/';

        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if (filetype($dir . $file) == 'dir') {
                        if (!($file == '.' || $file == '..')) {
                            array_push($json['skyboxes'], $file);
                        }
                    }
                }
                closedir($dh);
            }
        }

        // materials

        $dir = $library_root . '/materials/';

        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if (filetype($dir . $file) == 'dir') {
                        if (!($file == '.' || $file == '..')) {
                            $mat = [];
                            $mat['name'] = $file;
                            $dmat = opendir($dir . $file);
                            while (($matfile = readdir($dmat)) !== false) {
                                if (!($matfile == '.' || $matfile == '..')) {
                                    $m = strtolower($matfile);
                                    if (strpos($m, 'map') !== false) {
                                        $mat['map'] = $matfile;
                                    } elseif (strpos($m, 'displacement') !== false) {
                                        $mat['displacement'] = $matfile;
                                    } elseif (strpos($m, 'bump') !== false) {
                                        $mat['bump'] = $matfile;
                                    } elseif (strpos($m, 'specular') !== false) {
                                        $mat['specular'] = $matfile;
                                    } elseif (strpos($m, 'data') !== false) {
                                        $data = file_get_contents($dir . $file . '/' . $matfile);
                                        $mat['data'] = $data;
                                    }
                                }
                            }

                            closedir($dmat);

                            array_push($json['materials'], json_encode($mat));
                        }
                    }
                }
                closedir($dh);
            }
        }

        // shaders

        $dir = $library_root . '/shaders/';
        $files = array_diff(scandir($dir), array('..', '.'));

        foreach ($files as $file) {
            array_push($json['shaders'], $file);
        }

        // 360

        $dir = $library_root . '/360/';
        $files = array_diff(scandir($dir), array('..', '.'));

        foreach ($files as $file) {
            array_push($json['files360'], $file);
        }

        // animations

        $dir = $library_root . '/animations/';
        $files = array_diff(scandir($dir), array('..', '.'));

        foreach ($files as $file) {
            array_push($json['animations'], $file);
        }

        // videos

        $dir = $library_root . '/videos/';
        $files = array_diff(scandir($dir), array('..', '.'));

        foreach ($files as $file) {
            array_push($json['videos'], $file);
        }

        // sprites

        $dir = $library_root . '/sprites/';
        $files = array_diff(scandir($dir), array('..', '.'));

        foreach ($files as $file) {
            array_push($json['sprites'], $file);
        }

        // ttffonts

        $dir = $library_root . '/ttffonts/';
        $files = array_diff(scandir($dir), array('..', '.'));

        foreach ($files as $file) {
            $length = strlen('.ttf');

            if (strlen($file) > $length && (substr($file, -$length) === '.ttf')) {
                array_push($json['ttffonts'], $file);
            }
        }

        // svg

        $dir = $library_root . '/svg/';
        $files = array_diff(scandir($dir), array('..', '.'));

        foreach ($files as $file) {
            $length = strlen('.svg');

            if (strlen($file) > $length && (substr($file, -$length) === '.svg')) {
                array_push($json['svg'], $file);
            }
        }


        $jsonstr = json_encode($json);
        echo $jsonstr;
        wp_die(); // this is required to terminate immediately and return a proper response
    }

    public function list_scenes()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'xdscenes';
        $json = [
            'scenes' => []
        ];

        $query = "SELECT id, name FROM $table_name";
        $scenes = $wpdb->get_results($query);

        if ($wpdb->num_rows > 0) {

            foreach ($scenes as $scene) {

                $data = array(
                    'text' => $scene->name,
                    'value' => $scene->id
                );
                array_push($json['scenes'], $data);
            }
        }

        $jsonstr = json_encode($json);
        echo $jsonstr;
        wp_die(); // this is required to terminate immediately and return a proper response
    }

    public function list_images()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'xdscenes';

        $json = [
            'scenes' => []
        ];

        $ids = isset($_POST['ids']) ? $_POST['ids'] : '';
        $ids = sanitize_text_field($ids);
        if (strlen($ids) > 0) {

            $query = "SELECT id, name, image FROM $table_name WHERE id in (" . $ids . ")";
            $scenes = $wpdb->get_results($query);

        } else {

            $query = "SELECT id, name, image FROM $table_name";
            $scenes = $wpdb->get_results($query);
        }

        if ($wpdb->num_rows > 0) {

            foreach ($scenes as $scene) {

                $jsondata = json_decode($scene->scenedata);
                $data = array(
                    'text' => $scene->name,
                    'image' => $scene->image,
                    'value' => $scene->id
                );
                array_push($json['scenes'], $data);
            }
        }

        $jsonstr = json_encode($json);
        echo $jsonstr;
        wp_die(); // this is required to terminate immediately and return a proper response
    }

    public function get_scene()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'xdscenes';
        $json = [
            'scene' => []
        ];

        if (isset($_POST['id'])) {

            $scene_id = sanitize_text_field($_POST['id']);

            $query = "SELECT * FROM $table_name WHERE id=" . $scene_id;
            $scene = $wpdb->get_row($query, OBJECT, 0);

            if ($scene != null) {

                if (function_exists("gzdecode")) {

                    if ($scene->type === 'gzip') {

                        $uncomp = gzdecode($scene->scenedata);

                    }

                }

                $data = array(
                    'id' => $scene->id,
                    'name' => $scene->name,
                    'scenedata' => $scene->type === 'gzip' ? $uncomp : $scene->scenedata,
                    'type' => 'json',
                    'image' => $scene->image,
                    'heightratio' => $scene->heightratio
                );
                array_push($json['scene'], $data);

            }
        }
        $jsonstr = json_encode($json);
        echo $jsonstr;
        wp_die(); // this is required to terminate immediately and return a proper response
    }

    public function get_template()
    {
        $json = array('template' => '');

        if (isset($_POST['template'])) {

            $templateName = sanitize_text_field($_POST['template']);

            if ($templateName != null) {

                // check for the existence of the template file

                $upload_dir = wp_upload_dir();
                $upload_dir = $upload_dir['basedir'];

                $file = $upload_dir . '/xtrad-library/templates/' . $templateName;

                if (file_exists($file)) {

                    // read the contents of the template

                    $json['template'] = file_get_contents($file);

                } else {

                    // get the template file from the repository

                    $filetype = 'templates';
                    $fileen = $filetype . '/' . $filetype . '/' . $templateName;

                    $url = $this->libraryUrl . 'wp-admin/admin-ajax.php?action=xtradcopyfile&file=' . $fileen;

                    // Use wp_remote_get to fetch the data
                    $response = wp_remote_get($url);

                    $resp = $response['response'];

                    if ($resp['code'] === 200) {

                        // Save the body part to a variable
                        $contents = $response['body'];

                        // Create the name of the file and the declare the directory and path
                        $filet = $upload_dir . '/xtrad-library/' . $filetype . '/' . basename($templateName);
                        $fp = fopen($filet, "w");

                        fwrite($fp, $contents);
                        fclose($fp);
                        $json['template'] = $contents;

                    } else {

                        $json['template'] = $resp['message'];

                    }

                }

            } else {

                $json['template'] = 'template name blank';

            }

        }

        $jsonstr = json_encode($json);
        echo $jsonstr;
        wp_die(); // this is required to terminate immediately and return a proper response
    }

}

function admin_query_pagination($rowcount, $items_per_page, $page_path = '')
{

    $total_pages = ceil($rowcount / $items_per_page);
    $paged = isset($_GET['paged']) ? $_GET['paged'] : 1;
    $paged = (int)sanitize_text_field( $paged );
    $nextpage = $paged + 1;
    $prevpage = max(($paged - 1), 0); //max() to discard any negative value

    //assumed, we're using the default posts_per_page value in our query too
    $lastpage = ceil($rowcount / $items_per_page);
    if (empty($page_path))
        return _e('Admin path is not set');
    //adding 'paged' parameter to page_path
    $next_page_path = add_query_arg('paged', $nextpage, $page_path);
    $prev_page_path = add_query_arg('paged', $prevpage, $page_path);
    $lastpage_path = add_query_arg('paged', $lastpage, $page_path);
    echo '<div class="tablenav bottom">';
    echo '<div class="alignleft">';
    //Display the 'Previous' buttons
    if ($prevpage !== 0) {
        echo '<a class="btn btn-secondary" title="First page" href="' . $page_path . '">&laquo; <span class="screen-reader-text">First page</span></a> ';
        echo '<a class="btn btn-primary" title="Previous page" href="' . $prev_page_path . '">&lsaquo; <span class="screen-reader-text">Previous page</span></a> ';
    }
    //Display current page number
    if ($paged !== 1 && $paged !== $total_pages) {
        echo '<span class="screen-reader-text">Current Page</span>';
        echo '<span id="this-page">' . $paged . '</span>';
    }
    //Display the 'Next' buttons
    if ($total_pages > $paged) {
        echo ' <a class="btn btn-primary" title="Next page" href="' . $next_page_path . '"><span class="screen-reader-text">Next page</span> &rsaquo;</a>';
        echo ' <a class="btn btn-secondary" title="Last page" href="' . $lastpage_path . '"><span class="screen-reader-text">Last page</span> &raquo;</a>';
    }
    echo '</div>';
    echo '</div>';

    return;
}





