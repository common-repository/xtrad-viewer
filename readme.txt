=== Xtrad Viewer ===
Contributors: lenford18
Donate link: https://xtra-dimension.com/
Tags: 3D Slider, 3D Scene, three.js, .obj, .mtl, 3D Viewer, WebGL, Slider, 3D Model Viewer
Requires at least: 4.9
Tested up to: 5.3
Stable tag: 1.3.1
Requires PHP: 5.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The Xtrad Viewer WordPress plugin allows you to edit and display true 3D Scenes on WordPress pages.

== Description ==

The <span style="color: #f61537;"><strong>Xtra Viewer</strong></span> WordPress plugin allows you to edit and display <strong>3D Scenes</strong> on WordPress pages.

A 3D Scene can be anything from a simple 3D Text headline, a true 3D Slider, or a full 3D Scene.

All scenes are fully responsive as they are generated dynamically.

The viewer uses <strong>WebGL</strong>, via the <strong>three.js</strong> library to display the scenes. This is supported by most modern browsers and devices such as tablets and smart phones. The scene will default to a static image if no support is detected.

The viewer comes with nine predefined templates which can be modified bj the viewer.

<h4>Compatibility</h4>
The plugin has been tested with Wordpress 4.9.8 and 5.3 and is fully compatible with both. However, if you are using the new block editor you will currently need to manually insert shortcodes.

== Installation ==

Either use the builtin 'Add New Plugin' within Wordpress.

Or

Upload `xtrad-viewer.zip ` to the `/wp-content/plugins/` directory and extract the zip contents.

then activate the plugin.
It is recommended that you view the 'Quick Start Guide' before you start using the viewer.

== Frequently Asked Questions ==

= Does Xtrad Viewer work on Internet Explorer =

Internet Explorer can display 3D scenes but has major issues when modifying a template. It is recommended that you use any alternative browser for modifying templates.

= Xtrad Viewer and the Wordfence Security Plugin =

Wordfence aggressively checks all insertions in the SQL database. The Xtrad Viewer uses the database to store blobs of data which increase in size as the 3D Scenes get more complex. The time that Wordfence takes to check these scenes is sufficient to exceed their timeout when the scenes are larger than a certain size.

== Screenshots ==

1. This shows the Xtrad Viewer in modifying mode.
2. This shows the nine predefined templates provided by the Xtrad Viewer.

== Changelog ==

= 1.3.1 =
Parameters added to Orbit Control and compatibilty with WordPress 5.3.

= 1.2.0 =
Three.js library updated to r104 and compatibilty with WordPress 5.2.

= 1.1.0 =
Initial Version

== Upgrade Notice ==

You should upgrade as there are many fixes in the Three.js r104 library.



