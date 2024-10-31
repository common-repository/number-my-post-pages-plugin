=== Plugin Name ===
Contributors: Ali Sipahioglu
Tags: posts, pages, pagination
Requires at least: 2.0.0
Tested up to: 2.9
Stable tag: 1.2.1


This plugin handles the pagination with a much more organized way in your single.php and page.php.

== Description ==

Instead of using so many page numbers on your post page or having next and previous links, this plugin handles the pagination with a much more organized way. 
In the new version, you get an admin panel with the ability to change the number of pages that shows, whether you want to show the dropdown or not and also you can choose to show the navigation panel if there is only one page or not.
Also works with WP MU.

== Installation ==

1. Upload everything to the `/wp-content/plugins/number-my-post-pages-plugin` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place `<?php mysinglepages(wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number','echo' => '0'))); ?>` in your single.php and page.php

You need to have page tags `<!--nextpage-->` in your post otherwise it will show only 1 page link.

== Frequently Asked Questions ==

The links do not work right. What is the problem?
Make sure you are calling the function the way it is supposed to be called.

Why do the pages show up in a list?
Make sure you installed the plugin under the right directory. It should be `/wp-content/plugins/number-my-post-pages-plugin`

I think I found a bug, what should I do?
I would be more than happy to look into it if you would just post it on to the forums here on the wordpress website.

Any suggestions? Please post on the forums.

== Screenshots ==

1. This is the first example with 8 pages in the post
2. This is the second example with more than 40 pages

== Changelog ==

= 1.2.1 =
Fixed some XHTML markup problems.

= 1.2 =
Added the functionality to show the current and total page number.

= 1.1 =
Ability to use the default stylesheet that comes with the plugin. If you choose no then you need to have the style included in your themes stylesheet

= 1.0.2 =
Fixed bug about getting the current page number. Special thanks to `wisemantis`

= 1.0.1 =
Ability to change the Next and Previous Tab Texts

= 1.0 =
Fixed few bugs and added an admin panel under settings with few features

= 0.7 =
Fixed few bugs and also now it is easier to change the number of pages that shows.

= 0.5 =
First Release

