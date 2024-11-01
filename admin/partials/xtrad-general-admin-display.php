<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Aud3d_Viewer
 * @subpackage Aud3d_Viewer/admin/partials
 */
global $post;

class xtrad_general_admin_page
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $aud3d_viewer The ID of this plugin.
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

    public function xtrad_render_general_plugin_page()
    {
        //must check that the user has the required capability
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        $plug = plugins_url('', dirname( __FILE__ ) );
        $index = strrpos( $plug , '/' );
        $plug = substr($plug, 0, $index);

        ?>

        <div class='wrap'">
            <img src="<?php echo( $plug . '/images/Banner_772-130.png' ) ?>"/>
            <h2>Welcome to the Xtrad Viewer</h2>

            <h4 class="nav-tab-wrapper">

                <ul class="nav nav-tabs nav-justified">
                            <li class="active"><a href="#1" data-toggle="tab">General</a></li>
                            <li><a href="#2" data-toggle="tab">Quick Start Guide</a></li>
                            <li><a href="#3" data-toggle="tab">Information</a></li>
                            <li><a href="#4" data-toggle="tab">About</a></li>
                </ul>

            </h4>

            <div class="tab-content ">
                <div style="background-color: silver;" class="tab-pane active" id="1">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-10" style="background-color: white; border: 1px solid; padding: 30px; box-shadow: 5px 10px 8px #888888;">
                            <div>
                            <h4>Welcome to the Xtrad Viewer</h4>
                            <p>If you have not used the plugin it is recommended that you follow the 'Quick Start Guide'</p>
                            <p>There are also Training Videos at <a target="_blank"
                                                                    href="http://viewer.xtra-d.co.uk/documentation/training-videos/">Training
                                    Videos</a></p>
                            <p>Further help is available at <a href="http://viewer.xtra-d.co.uk/documentation/"
                                                           target="_blank">Documents</a></p>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-10 offset-lg-2" style="background-color: white; border: 1px solid; padding: 30px; box-shadow: 5px 10px 8px #888888; margin-left: 50px;">
                            <h4>Xtrad Editor</h4>
                            If you need more functionality than provided by the free plugin you might want to consider
                            the full <strong>Xtrad Editor</strong> which has the additional functionality:
                            <ul style="list-style-type: disc;">
                                <li>The ability to create templates</li>
                                <li>Multiple text strings may be objects in a template</li>
                                <li>Many more object types are available for inclusion in a template, including 360
                                    degree images, spheres, cones, 2D Text etc.
                                </li>
                                <li>A timeline allows you to create complex animations</li>
                                <li>It supports writing code in javascript to control objects</li>
                                <li>Many more 3D Model types are support, including Collada, FBX, GLTF, etc.</li>
                            </ul>
                            Also included with the Xtrad Editor is a library of templates, fonts, SVG images etc.

                            For more information about the premium plugin <strong>Xtrad Editor</strong> and to purchase
                            a licence for it please visit:

                            <a href="https://xtra-dimension.com"  target='_blank'>xtra-dimension.com</a>

                            <p>You can try out the Xtrad Editor by visiting <a href="http://editor.xtra-d.co.uk/standalone-editor/" target="_blank">Test Editor</a></p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="2">
                    <h3>Quick Start Guide</h3>
                    <p>The following sections show you how to quickly implement a simple scene. When you have completed
                        the instructions you will have your first animated 3D text scene which you can display on any of
                        your web pages.</p>
                    <div class="container-fluid" style="width:100%;">
                        <div class="row">
                            <h4>Invoking the Viewer</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>Select <strong>Viewer</strong> from the Wordpress Admin Menu.</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 180px; height: auto;"
                                     src="<?php echo( $plug . '/images/Quick_Start_Guide/Invoke_Viewer.png') ?>">
                            </div>
                        </div>
                        <div class="row">
                            <h4>Start Creating a New Scene</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>A list of all your current scenes will be displayed.</p>
                                <p>Select <strong>Add New Scene</strong> from the list all scenes page toolbar'.</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 100%; height: auto;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Add_New_Scene.png' )?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <h4>An Empty Scene Viewer</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>An empty <i>Scene Viewer</i> will be displayed.</p>
                                <p>The image to the right shows the main areas of the viewer.</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 100%; height: auto;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Empty_Scene.png')?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <h4>Loading a Template</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>You need to load a template to modify.</p>
                                <p>Select <strong>Templates</strong> from the menu <strong>Templates</strong>'.</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 300px; height: auto;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Menu_Templates.png')?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <h4>Select the simplest template</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>Select <strong>3D Text from Back to Front.json</strong> which is the simplest
                                    template</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 100%; height: auto;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Template_Selected.png')?>"/>
                            </div>

                        </div>
                        <div class="row">
                            <h4>A Scene Viewer With the default 3D Text is displayed</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>A <i>Scene Viewer</i> with the template loaded is displayed. This template displays a
                                    3D Text String and has an animation which moves the text from the back to the front
                                    of the scene over 10 seconds.</p>
                                <p>The image to the right shows the background colour has been set to black and shows
                                    'Hello World!'. There is also a <i>Directional Light in the scene</i></p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 100%; height: auto;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Scene_with_Text.png')?>"/>
                            </div>

                        </div>

                        <div class="row">
                            <h4>The Scenegraph</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>The <i>Scenegraph</i> shows that the 3D Text has 2 objects, a <i>Group</i> named
                                    <b>Pivot</b> which allows you to move and rotate the text about its midpoint and the
                                    actual 3D Text named <b>HelloWorld!</b></p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 300px; height: auto; max-width: 600px;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Scenegraph_Text.png' )?>"/>
                            </div>
                        </div>

                        <div class="row">
                            <h4>Modifying the 3D Text</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>Select the 3D Text itself in the <i>Scenegraph</i> named <b>Hello World!</b>.</p>
                                <p>Select <strong>GEOMETRY</strong> from the properties TABs.</p>
                                <p>You can change the text by typing your new text into the <b>Text</b> textarea</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 300px; height: auto;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Changing_Text.png' )?>"/>
                            </div>
                        </div>

                        <div class="row">
                            <h4>Changing the 3D Text Font</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>Select the new font from the dropdown.</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 300px; height: auto;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Changing_Font.png' )?>"/>
                            </div>
                        </div>

                        <div class="row">
                            <h4>Changing the Material</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>Make sure that the actual text is selected in the <i>Scenegraph</i> then select the <b>MATERIAL</b> TAB.</p>
                            <p>You can change the material from a solid colour to an image or to a texture.</p>
                                <p>There are two materials applied to 3D Text:
                                    </p>
                                <ul>
                                    <li>The material for the front and rear faces (Slot 1)</li>
                                    <li>The material for the extrusion (Slot 2)</li>
                                </ul>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 300px; height: auto;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Material_1.png' )?>"/>
                            </div>
                        </div>

                        <div class="row">
                            <h4>Text material Colour Changed</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>The colour of the faces has been changed to yellow.</p>
                             </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 100%; height: auto;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Material_2.png' )?>"/>
                            </div>
                        </div>


                        <div class="row">
                            <h4>Changing the Background</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>Select the <b>PROJECT</b> TAB from the side bar.</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 300px; height: auto;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Project_Select.png' )?>"/>
                            </div>
                        </div>

                        <div class="row">
                            <h4>Changing the Background</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>and scroll down until you get to the <b>Background</b> Section.</p>
                                <p>You can change the background to one of the following:</p>
                                <ul>
                                    <li>A solid colour</li>
                                    <li>An image</li>
                                    <li>A shader</li>
                                    <li>A checkered background</li>
                                    <li>A gradient</li>
                                    <li>A skybox</li>
                                </ul>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 300px; height: auto;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Background_1.png' )?>"/>
                            </div>
                        </div>

                        <div class="row">
                            <h4>A Gradient Background</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>The image to the right shows the background changed to a gradient.</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 100%; height: auto;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Background_2.png' )?>"/>
                            </div>
                        </div>

                        <div class="row">
                            <h4>Changing the Animation</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>The default animation for this template is to move the text from the back to the
                                    front of
                                    the scene over 10 seconds.</p>
                                <p>You can remove or change the animation by removing the current one and adding a new
                                    one
                                    from the dropdown.</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 300px; height: auto;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Changing_Animation_1.png' )?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <h4>Animations</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>The animation macros perform as follows:</p>
                                <ul>
                                    <li><b>back to front pp.ani</b> - moves the object from the back to the front and to
                                        the
                                        back
                                    </li>
                                    <li><b>back to front sway.ani</b> - moves the object from the back to the front with
                                        a
                                        swaying action
                                    </li>
                                    <li><b>back to front.ani</b> - moves the object from the back to the front</li>
                                    <li><b>rotatex.ani</b> - rotates the object on the X axis</li>
                                    <li><b>rotatey.ani</b> - rotates the object on the Y axis</li>
                                    <li><b>rotatez.ani</b> - rotates the object on the Z axis</li>
                                    <li><b>world rotate.ani</b> - rotates the object in a circle about the Y axis</li>
                                    <li><b>world rotate 2.ani</b> - rotates the object in a circle about the Y axis</li>
                                </ul>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 300px; height: auto;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Animation_List.png' )?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <h4>Playing the Animation</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>You can see what the animation macro will do by selecting <i>Play</i> from the <i>Menu
                                        Bar</i></p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 300px; height: auto;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Play.png' )?>"/>
                            </div>
                        </div>

                        <div class="row">
                            <h4>Saving the Scene</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>You can now save your scene by typing a name into the <strong>Scene ID</strong>
                                    field below the viewer and then clicking <strong>Save Changes</strong>.</p>
                                <p>The position of the camera used for the display of the scene on the web page is the
                                    current <strong>Camera</strong> position when you click <strong>Save
                                        Changes</strong>.</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 100%; height: auto; max-width: 300px;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Save_Hello_World.png' )?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <h4>List of Current Scenes</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>The saved scene is displayed in the list of your current scenes.</p>
                                <p>You should note the scene's <strong>ID</strong> if you intend to add a shortcode
                                    manually to your web page.
                                    In this case the shortcode would be:</p>
                                <p>[xtradscene id="6046"]</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 100%; height: auto;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Hello_World_Saved.png' )?>"/>
                            </div>
                        </div>

                        <div class="row">
                            <h4>Adding a Scene to a Page using the Standard Editor</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>You can add a scene to a page by using the standard editor.</p>
                                <p>Select <strong>XTRA</strong> from the editor's toolbar.</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 900px; height: auto;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/MCE_Editor_-_XTRAD.png' ) ?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <h4>Selecting the Scene from the Standard Editor Popup</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>A popup dialog is displayed.</p>
                                <p>Select the name of your scene from the popup's dropdown
                                    list of Scenes.</p>
                                <p>You can ignore the setting for initial image. When a page first loads containing a
                                    <strong>Scene</strong> an initial image is displayed while loading the actual 3D
                                    Scene.
                                    By default, the still image captured when the scene is saved in the viewer, is used.
                                    The initial image field allows you to choose an alternative image.</p>
                                <p>You can leave all the other parameters set with their default values.</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 100%; height: auto; max-width: 800px;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/XTRAD_-_Popup.png' )?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <h4>Scene Added to Page</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>A shortcode has been added to the page.</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 100%; height: auto; max-width: 900px;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/MCE_-_shortcode_added.png' ) ?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <h4>Adding a Scene to a Page using the WPBakery Page Editor</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>You can add a scene to a page by using the WPBakery Page Editor if you use it.</p>
                                <p>Select <strong>Xtrad Scene</strong> from the editor's toolbar.</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 100%; height: auto; max-width: 500px;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Visual_Composer_-_add_Scene.png' )?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <h4>Selecting the Scene from the WPBakery Popup</h4>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <p>A popup dialog is displayed.</p>
                                <p>Select <i>Hello World</i> (or the name of your scene) from the popup's dropdown
                                    list and click on <strong>Save Changes</strong>.</p>
                                <p>You can ignore the setting for initial image. When a page first loads containing a
                                    <strong>Scene</strong> an initial image is displayed while loading the actual 3D
                                    Scene.
                                    By default, the still image captured when the scene is saved in the viewer, is used.
                                    The initial image field allows you to choose an alternative image.</p>
                                <p>You can leave all the other parameters set with their default values.</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img style="width: 100%; height: auto; max-width: 600px;"
                                     src="<?php echo($plug . '/images/Quick_Start_Guide/Visual_Composer_-_Scene_Dialog.png' )?>"/>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="tab-pane" id="3">
                    <h3>Information</h3>
                    The Xtrad Editor provides a single shortcode to display a 3D scene:
                    <ul type="circle">
                        <li>[xtradscene id="<i>sceneid</i>" orbit="true|false" img="<i>mediaid</i>" minpolarangle="<i>0 - 180</i> " maxpolarangle="<i>0 - 180</i>" minazimuthangle="<i>-infinity -> infinity</i>" maxazimuthangle="<i>-infinity -> infinity</i>" mindistance="<i>0 -> infinity</i>" maxdistance="<i>0 -> infinity</i>"]</li>
                        <p><strong>orbit</strong>, <strong>img</strong>, <strong>minpolarangle</strong>, <strong>maxpolarangle</strong>, <strong>minazimuthangle</strong>, <strong>maxazimuthangle</strong>, <strong>mindistance</strong> and <strong>maxdistance</strong> are optional parameters, <strong>img</strong> being used to override the static initial image included with the 3D Scene</p>
                    </ul>
                    <p>The empty string "" is used to represent both negative and positive infinity or you can omit the field altogether.</p>
                    <p>The following examples show usage of the shortcode:</p>
                    <ul type="circle">
                        <li><strong>[xtradscene id="1" orbit="true"]</strong> - the default parameters are 0 -> 90 for polar angle, -infinity -> infinity for azimuth angle and 10 -> 1000 for distance.</li>
                        <li><strong>[xtradscene id="1" orbit="true" minpolarangle="0" maxpolarangle="90" minazimuthangle="" maxazimuthangle="" mindistance="10" maxdistance="1000"]</strong> - this is equivalent to the previous shortcode.</li>
                        <li><strong>[xtradscene id="1" orbit="true" minpolarangle="0" maxpolarangle="180" minazimuthangle="-45" maxazimuthangle="45" ]</strong> - this extends the movement in the vertical and restricts it to 90 degrees in the horizontal.</li>
                    </ul>
                    <p>It is recommended that you insert this shortcode into your pages using either the default editor or the WPBakery pagebuilder if it is installed.</p>
                    <h4>Further Reading</h4>
                    If you need more help on the concepts behind 3D then the following websites may be useful:
                    <ul type="circle">
                        <li><a href="https://threejs.org/docs/" target="_blank"> Three.js Documentation</a></li>
                        <li><a href="https://en.wikipedia.org/wiki/Phong_shading" target="_blank">Phong Shading</a></li>
                    </ul>
                </div>
                <div class="tab-pane" id="4">
                    <h3>About</h3>
                    <h4>Three.js</h4>
                    <p>The Xtrad Viewer Plugin would not exist without the fantastic javacript library, <a
                                href="https://threejs.org" target="_blank">three.js</a>.
                        supported by <a href="http://mrdoob.com" target="_blank">Mr.doob</a> and many others.
                    </p>
                    <h4>Use of other libraries</h4>
                    <ul type="circle">
                        <li>The three.js viewer</li>
                        <li>Code from the <a href="https://threejs.org/examples" target="_blank">three.js examples</a>
                        </li>
                        <li>Code from the <a href="http://www.threejsgames.com/extensions/" target="_blank">threex
                                extensions</a></li>
                        <li>And many other libraries</li>
                    </ul>
                    <h4>Support and Development</h4>
                    <p>The code for the Xtrad Viewer Plugin is developed and maintained by ConversationalCRM Ltd.</p>
                </div>
            </div>
        </div>
        <?php
    }

}




