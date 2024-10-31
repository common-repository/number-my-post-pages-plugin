<?php
/*
Plugin Name: Number My Post Pages
Plugin URI: http://www.weblimner.com/numbermypagesplugin/
Description: Instead of using so many page numbers on your post page or having next and previous links, this plugin handles the pagination with a much more organized way. In the name version, you get an admin panel with the ability to change the number of pages that shows, whether you want to show the dropdown or not and also you can choose to show the navigation panel if there is only one page or not.
Author: Ali Sipahioglu
Version: 1.2.1
Change Log:
2010-08-05  1.2.1: Fixed some XHTML markup problems.
2009-18-12  1.2: Added the functionality to show the current and total page number.
2009-09-11  1.1: Ability to use the default stylesheet that comes with the plugin. If you choose no then you need to have the style included in your themes stylesheet
2009-09-11  1.0.2: Fixed a small bug about getting the current page number. Special thanks to 'wisemantis'
2009-09-11  1.0.1: Ability to change the Next and Previous Tab Texts
2009-09-11  1.0: Fixed few bugs and added an admin panel under settings with few features
2009-09-11  0.7: Fixed few bugs
2009-09-06  0.5: First release
Author URI: http://www.weblimner.com

	Copyright 2009  Ali Sipahioglu

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



add_action('admin_menu', 'numbermypost_menu');

function numbermypost_menu(){
	add_options_page('Number Post Pages Options', 'Number Post Pages', 'administrator', 'postpages_unique', 'numbermyposts_options');
}

function numbermyposts_options(){
	if($_POST['updateoptions']){
		$postpages_options = array();
		$postpages_options['upperlimit'] = $_POST['upperlimit'];
		$postpages_options['lowerlimit'] = $_POST['lowerlimit'];
		$postpages_options['showdropdown'] = $_POST['dropdown'];
		$postpages_options['alwaysshownav'] = $_POST['shownav'];
		$postpages_options['nexttext'] = $_POST['nexttext'];
		$postpages_options['prevtext'] = $_POST['prevtext'];
		$postpages_options['stylesheet'] = $_POST['stylesheet'];
		$postpages_options['numberofpages_text'] = $_POST['numberofpages_text'];
		$postpages_options['shownumberofpages_text'] = $_POST['shownumberofpages_text'];
		update_option('postpages_options', $postpages_options);
	}
	$postpages_options = get_option('postpages_options');
	echo '<div class="wrap">
		<h2>Number Post Pages Options</h2>
		<form method="post" action="">
		<table class="form-table">
		<tr>
			<th><label for="upperlimit">Text for Number of Pages</label></th>
			<td><input type="text" name="numberofpages_text" id="numberofpages_text" value="'.$postpages_options['numberofpages_text'].'"/> <span class="description">Default: Page [CURRENT_PAGE] of [TOTAL_PAGES]</span></td>
		</tr>
		<tr>
			<th><label for="upperlimit">Show the "Text for Number of Pages"</label></th>
			<td><select name="shownumberofpages_text" id="shownumberofpages_text">';
			if($postpages_options['shownumberofpages_text']){
				$shownumberofpages_textyes = 'selected="selected"';
			}else{$shownumberofpages_textno = 'selected="selected"';}
	echo '			<option value="1" '.$shownumberofpages_textyes.'>Yes&nbsp;</option>
					<option value="0" '.$shownumberofpages_textno.'>No&nbsp;</option>
				</select>	
			</td>
		</tr>
		<tr>
			<th><label for="upperlimit">Number of pages after the current page</label></th>
			<td><input type="text" name="upperlimit" id="upperlimit" value="'.$postpages_options['upperlimit'].'"/> <span class="description">Including the current page.</span></td>
		</tr>
		<tr>
			<th><label for="lowerlimit">Number of pages before the current page</label></th>
			<td><input type="text" name="lowerlimit" id="lowerlimit" value="'.$postpages_options['lowerlimit'].'"/></td>
		</tr>
		<tr>
			<th><label for="nexttext">Text for next page</label></th>
			<td><input type="text" name="nexttext" id="nexttext" value="'.$postpages_options['nexttext'].'"/></td>
		</tr>
		<tr>
			<th><label for="prevtext">Text for previous page</label></th>
			<td><input type="text" name="prevtext" id="prevtext" value="'.$postpages_options['prevtext'].'"/></td>
		</tr>
		<tr>
			<th><label for="prevtext">Use default stylesheet</label></th>
			<td>
			<select name="stylesheet" id="stylesheet">';
			if($postpages_options['stylesheet']){
				$styleyes = 'selected="selected"';
			}else{$styleno = 'selected="selected"';}
	echo '			<option value="1" '.$styleyes.'>Yes&nbsp;</option>
					<option value="0" '.$styleno.'>No&nbsp;</option>
				</select>			
			</td>
		</tr>
		<tr>
			<th><label for="dropdown">Show Dropdown</label></th>
			<td>
				<select name="dropdown" id="dropdown">';
			if($postpages_options['showdropdown']){
				$dropyes = 'selected="selected"';
			}else{$dropno = 'selected="selected"';}
	echo '			<option value="1" '.$dropyes.'>Yes&nbsp;</option>
					<option value="0" '.$dropno.'>No&nbsp;</option>
				</select>
			</td>
		</tr>
		<tr>
			<th><label for="shownav">Always Show Navigation</label></th>
			<td>
				<select name="shownav" id="shownav">';
			if($postpages_options['alwaysshownav']){
				$navyes = 'selected="selected"';
			}else{$navno = 'selected="selected"';}
	echo '			
					<option value="1" '.$navyes.'>Yes&nbsp;</option>
					<option value="0" '.$navno.'>No&nbsp;</option>
				</select> <span class="description">If you want to show the navigation bar even there is only one page.</span>
			</td>
		</tr>		
		</table>
		<p class="submit">
			<input type="hidden" name="updateoptions" value="1"/>
			<input type="submit" class="button-primary" value="Update" name="submit" />
		</p>
<div style="float:left;background-color:white;padding: 10px 10px 10px 10px;margin-right:15px;border: 1px solid #ddd;">

		</form>
		If you like this plugin and find it useful, please <a href="http://wordpress.org/extend/plugins/number-my-post-pages-plugin/">vote</a> for it on wordpress and would be great if you donated too. 
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="9343518">
			<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>
</div>
		</div>';
}

### Function: Page Navigation Options
//register_deactivation_hook( __FILE__, 'postpages_dectivate' );
function postpages_dectivate() {
	// Add Options
	delete_option("postpages_options");
}


register_activation_hook( __FILE__, 'postpages_activate' );
function postpages_activate() {
	// Add Options
	$postpages_options = array();
	$postpages_options['upperlimit'] = 5;
	$postpages_options['lowerlimit'] = 3;
	$postpages_options['showdropdown'] = 1;
	$postpages_options['nexttext'] = "Next &raquo;";
	$postpages_options['prevtext'] = "&laquo; Previous";
	$postpages_options['alwaysshownav'] = 0;
	$postpages_options['stylesheet'] = "1";
	$postpages_options['numberofpages_text'] = "Page [CURRENT_PAGE] of [TOTAL_PAGES]";
	$postpages_options['shownumberofpages_text'] = 1;
	add_option('postpages_options', $postpages_options, 'Number Post Pages Options');
}
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////// Below here are the functions for the pagination and the styling

add_action('wp_head', 'add_styles');

function add_styles(){
	$postpages_options = get_option('postpages_options');	
	if($postpages_options['stylesheet']){
		wp_register_style('numbermyposts', WP_PLUGIN_URL.'/number-my-post-pages-plugin/numbermypostpages.css');
		wp_enqueue_style('numbermyposts');
		wp_print_styles();
	}
}


function mysinglepages($pagelinks){
$postpages_options = get_option('postpages_options');	
$pagesarr = explode("</a>",$pagelinks);
$b=1;
global $page;
$curpagenum=$page;
if(!is_numeric($curpagenum)){$curpagenum="1";}
	for($a=0;$a<count($pagesarr);$a++){
		if($a==($curpagenum-1)){
			$resultsarr[$b]['link'] = $cururl;
			$resultsarr[$b]['number']=$b;
			//$a++;
			$b++;
		}
		if (preg_match('/href="([^"]*)"/i', $pagesarr[$a] , $regs))
		{
			$resultsarr[$b]['link'] = $regs[1];
			$resultsarr[$b]['number']=$b;
			$b++;
		}
	}
	//print_r($resultsarr);
	$total_num_of_pages = count($resultsarr);
	$upperlimit = $postpages_options['upperlimit'];
	$lowerlimit = $postpages_options['lowerlimit'];
	if($postpages_options['alwaysshownav']=="0"&&$total_num_of_pages<=1){return;}
		
echo '<div style="float: none; clear: both;"></div>
					<div id="wp_page_numbers">';
echo "<ul>";	
if($postpages_options['shownumberofpages_text']){
	echo '<li class="page_info">'.nmpp_replace_the_text($postpages_options['numberofpages_text'],$curpagenum,count($resultsarr)).'</li>';
	//echo '<li class="page_info">Page '.$curpagenum.' of '.count($resultsarr).'</li>';
}
if($curpagenum!="1"){echo '<li class="paginate"><a href="'.$resultsarr[$curpagenum-1]['link'].'">'.$postpages_options['prevtext'].'</a></li>';}
else{echo '<li class="page_info">'.$postpages_options['prevtext'].'</li>';}
	if($total_num_of_pages<=($upperlimit+$lowerlimit)){
		$lowerlimit=$curpagenum-1;
		$upperlimit=$total_num_of_pages-$curpagenum+1;
	}else{
		if($curpagenum<=3){
			$lowerlimit=$curpagenum-1;
		}		
		if($total_num_of_pages<$curpagenum+$upperlimit){
			$upperlimit=$upperlimit-(($curpagenum+$upperlimit)-$total_num_of_pages)+1;
		}
	}

		
	for($a=($curpagenum-$lowerlimit);$a<($upperlimit+$curpagenum);$a++){
		echo '<li';
			if($a==$curpagenum){ echo ' class="active_page"';} 
			echo '><a href="'.$resultsarr[$a]['link'].'" class="paginate">'.$resultsarr[$a]['number'].'</a></li>';
	}

if($curpagenum!=count($resultsarr)){echo '<li class="paginate"><a href="'.$resultsarr[$curpagenum+1]['link'].'">'.$postpages_options['nexttext'].'</a></li>';}
else{echo '<li class="page_info">'.$postpages_options['nexttext'].'</li>';}
echo "</ul>";

if($postpages_options['showdropdown']=="1"){
	echo '<ul>
		<li class="dropdown">
		<span class="paginate">Page:</span><select class="paginate" onchange="window.location=\'\'+this[this.selectedIndex].value+\'\';return false">
		';
		for($a=0;$a<=$total_num_of_pages;$a++){
		echo '<option value="'.$resultsarr[$a]['link'].'"';
			if($curpagenum==$a){echo ' selected="selected"';}
		echo '>'.$resultsarr[$a]['number'].'</option>';
		}
		echo '
		</select>
		</li>
		</ul>
		';
}

echo '</div>
	<div style="float: none; clear: both;"></div>';
}

function nmpp_replace_the_text($text,$curpagenum,$totalpagenum){
	$text = str_replace("[CURRENT_PAGE]",$curpagenum,$text);
	$text = str_replace("[TOTAL_PAGES]",$totalpagenum,$text);
	return $text;
}