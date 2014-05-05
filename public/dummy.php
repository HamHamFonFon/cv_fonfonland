<?php

/*
THIS SCRIPT NEEDS TO BE PLACED TEMPORARILY WITH YOUR TEMPLATE WEB PAGE FILE, TO EMULATE USER ENTERED DATA ON YOUR PAGE.
ENSURE THAT YOUR TEMPLATES' FILE NAME ENDS IN ".php" THEN SIMPLY PUT THIS FILE IN THE SAME FOLDER AS
YOUR WEB PAGE AND TYPE THE FOLLOWING CODE ABOVE THE FIRST <HTML> TAG:

<?php include_once("dummy.php"); ?>

ENTER THE TAGS PROVIDED IN THE COMMENTS (BELOW) INTO YOUR WEB PAGE WHERE APPROPRIATE AND THIS SCRIPT WILL POPULATE THE SPACES.
TAGS CAN ALSO BE FOUND AT http://get-simple.info/wiki/themes:template_tags

* DON'T FORGET TO DELETE THE LINE OF CODE YOU WROTE ABOVE BEFORE UPLOADING TO THE SERVER.
* THIS FILE SHOULD NOT BE UPLOADED TO YOUR WEBSITE.
* THIS FILE REQUIRES A TESTING SERVER TO RUN PROPERLY. EITHER RUN IT BY UPLOADING TO YOUR HOST (IN A TEST FOLDER WITH YOUR WEB PAGE) OR
  RUN A TESTING SERVER ON YOUR COMPUTER LOCALLY. A GOOD OPTION FOR THIS IS: http://www.apachefriends.org/en/xampp.html

* HAVE FUN!!

Dummy.php -> Jason Dixon 2012. jason.dixon.email@gmail.com
GetSimpleCMS -> Chris Cagle and the Open Source Team. admin@cagintranet.com
*/



/* Echos the page's content.

ADD:
<?php get_page_content(); ?>

*/
function get_page_content(){
	echo "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br />Phasellus euismod fermentum mauris. Sed volutpat nulla non justo pellentesque eu posuere tortor scelerisque. Donec tincidunt, justo non porttitor ultrices, tellus orci sodales nibh, sed dictum tellus augue nec urna. Cras egestas massa eu purus scelerisque non aliquet magna fermentum.</p>
    <p>Nam eu felis eros. Nulla tellus nisi, sagittis id tincidunt eu, pulvinar eget turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum mattis leo vitae eros iaculis ultricies. Ut aliquet euismod ullamcorper.<br /> Fusce hendrerit porta lectus vitae euismod. Morbi varius fringilla mi at sollicitudin. Mauris volutpat ipsum non nunc egestas ut vulputate orci consectetur. Maecenas elit leo, consectetur nec pellentesque vel, porta a velit. Nunc semper eleifend tellus. Phasellus id aliquet purus. Quisque luctus congue sapien eget aliquet. Sed eget nisi nec ante vulputate placerat. Sed vel erat et lorem lobortis hendrerit eu eu nunc. Donec id aliquam diam. Nam sagittis purus sit amet lectus consectetur gravida.</p>";
}


/* Echos or returns slug's content (slug's URI/name as option). Use this function if you want to display certain slug's content on all pages. This function comes in handy for those, who want to have custom content boxes in template, and display them on f.e. homepage.

ADD:
<?php getPageContent('slug'); ?>

*/
function getPageContent($slug){
	echo "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br />Phasellus euismod fermentum mauris. Sed volutpat nulla non justo pellentesque eu posuere tortor scelerisque. Donec tincidunt, justo non porttitor ultrices, tellus orci sodales nibh, sed dictum tellus augue nec urna. Cras egestas massa eu purus scelerisque non aliquet magna fermentum.</p>
    <p>Nam eu felis eros. Nulla tellus nisi, sagittis id tincidunt eu, pulvinar eget turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum mattis leo vitae eros iaculis ultricies. Ut aliquet euismod ullamcorper.<br /> Fusce hendrerit porta lectus vitae euismod. Morbi varius fringilla mi at sollicitudin. Mauris volutpat ipsum non nunc egestas ut vulputate orci consectetur. Maecenas elit leo, consectetur nec pellentesque vel, porta a velit. Nunc semper eleifend tellus. Phasellus id aliquet purus. Quisque luctus congue sapien eget aliquet. Sed eget nisi nec ante vulputate placerat. Sed vel erat et lorem lobortis hendrerit eu eu nunc. Donec id aliquam diam. Nam sagittis purus sit amet lectus consectetur gravida.</p>";
}


/*

ADD:
<?php returnPageContent('slug'); ?>

*/
function returnPageContent($slug){
	return "Lorem ipsum dolor sit amet, consectetur adipiscing elit. <br />Phasellus euismod fermentum mauris. Sed volutpat nulla non justo pellentesque eu posuere tortor scelerisque. Donec tincidunt, justo non porttitor ultrices, tellus orci sodales nibh, sed dictum tellus augue nec urna. Cras egestas massa eu purus scelerisque non aliquet magna fermentum.
    Nam eu felis eros. Nulla tellus nisi, sagittis id tincidunt eu, pulvinar eget turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum mattis leo vitae eros iaculis ultricies. Ut aliquet euismod ullamcorper.<br /> Fusce hendrerit porta lectus vitae euismod. Morbi varius fringilla mi at sollicitudin. Mauris volutpat ipsum non nunc egestas ut vulputate orci consectetur. Maecenas elit leo, consectetur nec pellentesque vel, porta a velit. Nunc semper eleifend tellus. Phasellus id aliquet purus. Quisque luctus congue sapien eget aliquet. Sed eget nisi nec ante vulputate placerat. Sed vel erat et lorem lobortis hendrerit eu eu nunc. Donec id aliquam diam. Nam sagittis purus sit amet lectus consectetur gravida.";
}


/* Echos an excerpt of the page's content. You can also set the length of the excerpt in characters and if HTML should be included in the excerpt. $length default is 200, $html default is FALSE.

ADD:
<?php get_page_excerpt($length, $html); ?>

*/
function get_page_excerpt($length = 200, $html = FALSE){
	$text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. <br />Phasellus euismod fermentum mauris. Sed volutpat nulla non justo pellentesque eu posuere tortor scelerisque. Donec tincidunt, justo non porttitor ultrices, tellus orci sodales nibh, sed dictum tellus augue nec urna. Cras egestas massa eu purus scelerisque non aliquet magna fermentum.<br />
    Nam eu felis eros. Nulla tellus nisi, sagittis id tincidunt eu, pulvinar eget turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum mattis leo vitae eros iaculis ultricies. Ut aliquet euismod ullamcorper.<br /> Fusce hendrerit porta lectus vitae euismod. Morbi varius fringilla mi at sollicitudin. Mauris volutpat ipsum non nunc egestas ut vulputate orci consectetur. Maecenas elit leo, consectetur nec pellentesque vel, porta a velit. Nunc semper eleifend tellus. Phasellus id aliquet purus. Quisque luctus congue sapien eget aliquet. Sed eget nisi nec ante vulputate placerat. Sed vel erat et lorem lobortis hendrerit eu eu nunc. Donec id aliquam diam. Nam sagittis purus sit amet lectus consectetur gravida. ";
	$rotation = 0;
	if ($length > 1122){
		$rotation = floor($length / 1122);
		$length = $length - (1122 * $rotation);
	}
	echo "<p>";
	for($i=0; $i<=$length; $i++){
			echo $text[$i];
		}
	$length = 1122;
	if($rotation != 0){
		for($r=$rotation; $r>=0; $r--){
			for($i=0; $i<=$length; $i++){
				echo $text[$i];
			}
		}
	}
	echo "...</p>";
}


/* Echos the page's keywords and/or tags.

ADD:
<?php get_page_meta_keywords(); ?>

*/
function get_page_meta_keywords(){
	echo "simple, cms, fun, functional, new zealand, nyan cat, ban SOPA and ACTA, programming, php, local, share, dummy, test";
}


/* Echos the page's title.

ADD:
<?php get_page_title(); ?>

*/
function get_page_title(){
	echo "My AMAZING web page!";
}


/* Returns the page's title.

ADD:
<?php return_page_title(); ?>

*/
function return_page_title(){
	return "My AMAZING web page!";
}


/* Echos the page's title, stripped of all HTML. Use in title and other context sensitive areas.

ADD:
<?php get_page_clean_title(); ?>

*/
function get_page_clean_title(){
	echo "amazing web page";
}


/* Echos the current page's slug. Example would be the word 'download' in the URL get-simple.info/download.

ADD:
<?php get_page_slug(); ?>

*/
function get_page_slug(){
	echo substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1 );
}

/* Same as get_page_slug, but it returns the slug. Can be used to make page-specific IDs for CSS styling.

ADD:
<?php return_page_slug(); ?>

*/
function return_page_slug(){
	return substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1 );
}


/* Echos the page's full URL. Options: TRUE for "return", FALSE or blank for "echo". Example would be get-simple.info/

ADD:
<?php get_page_url(); ?>

*/
function get_page_url($option = FALSE){
	$pageURL = "http";
	if ($_SERVER["HTTPS"] == "on"){
		$pageURL .= "s";
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80"){
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}
	if ($option == TRUE){
		return $pageURL;
	} else {
	echo $pageURL;
	}
}


/* This will echo the slug value of a particular page's parent.

ADD:
<?php get_parent(); ?>

*/
function get_parent(){
	$parent = $_SERVER["REQUEST_URI"];
	$parent = explode("/",$parent);
	echo $parent[count($parent)-2];
}


/* Echos the page's last saved date. Option is not needed, but can be used for formatting: use any string combination from PHP's date function. Default format is "l, F jS, Y - g:i A"

ADD:
<?php get_page_date(); ?>

*/
function get_page_date($format = "l, F jS, V - g:i A"){
	echo date($format);
}


/* Echos the page's header. No options. This automatically creates the 4 meta tags ('descripion', 'keywords', 'canonical' and 'generated'). Place this code within your theme's <head> </head> tags.

ADD:
<?php get_header(); ?>

*/
function get_header(){
	$ref = "http";
	if ($_SERVER["HTTPS"] == "on"){
		$ref .= "s";
	}
	$ref .= "://";
	if ($_SERVER["SERVER_PORT"] != "80"){
		$ref .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	} else {
		$ref .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}
	$ref = explode("/",$ref);
	$length = count($ref) - 2;
	$site = "";
	for($i=0; $i <= $length; $i++){
		$site .= $ref[$i] . '/';
	}
	echo '<meta name="description" content="" />
<meta name="generator" content="GetSimple"/>
<link rel="canonical" href="' . $site . '" />';
}


/* Echos the page's footer. This mainly is used to introduce a plugin hook that can be called at the bottom of any template footer.

ADD:
<?php get_footer(); ?>

*/
function get_footer(){
	echo "There is text here, however it will likely not exist unless you use certain plugins.";
}


/* Echos the website's domain. For example, this echos get-simple.info from any page on the GetSimple website.

ADD:
<?php get_site_url(); ?>

*/
function get_site_url(){
	$url = "http";
	if ($_SERVER["HTTPS"] == "on"){
		$url .= "s";
	}
	$url .= "://";
	if ($_SERVER["SERVER_PORT"] != "80"){
		$url .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
	} else {
		$url .= $_SERVER["SERVER_NAME"];
	}
	echo $url;
}


/* Echos the website's theme directory URL.

ADD:
<?php get_theme_url(); ?>

*/

function get_theme_url(){
	$theme = "http";
	if ($_SERVER["HTTPS"] == "on"){
		$theme .= "s";
	}
	$theme .= "://";
	if ($_SERVER["SERVER_PORT"] != "80"){
		$theme .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	} else {
		$theme .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}
	$theme = explode("/",$theme);
	$length = count($theme) - 3;
	$site = "";
	for($i=0; $i <= $length; $i++){
		$site .= $theme[$i] . '/';
	}
	$site .= $theme[$length+1];
	echo $site;
}


/* Echos the website's title. Options: TRUE for "return", leave blank for "echo". Site name is taken from the settings page.

ADD:
<?php get_site_name(); ?>

*/
function get_site_name($option = FALSE){
	if ($option == TRUE){
		return "My awesome webpage.";
	} else {
		echo "My awesome webpage";
	}
}


/* Echos the string "Powered by GetSimple Version".

ADD:
<?php get_site_credits(); ?>

*/
function get_site_credits(){
	echo "Powered by GetSimple Version 3.1.2";
}


/* Returns the version of GetSimple you are running.

ADD:
<?php return_site_ver(); ?>

*/
function return_site_ver(){
	echo "3.1.2";
}


/* Echos the component's contents. Required option is the component slug, which can be taken from the components page within the theme page.

ADD:
<?php get_component('component_slug'); ?>

NOTE: You can replace the text in here with your components text to further emulate the final result.
*/
function get_component($component_slug){
	echo "PUT YOUR COMPONENT TEXT / CODE IN HERE IF YOU WISH TO PREVIEW IT ON THE PAGE.";
}


/* Returns a list of pages that are added to the main menu from each of their edit screens. Required option is what is shown above. This creates a class of 'current' on the <li> element that currently the active page. You need to supply the <ul> or <ol>

ADD:
<?php get_navigation(return_page_slug()); ?>

*/
function get_navigation($page_slug = NULL){
	if($slug == NULL){
		$current = NULL;
		$page_slug = "Gallery";
	} else {
		$current = "current";
	}
	echo '<li class="results"><a href="#top" title="Results">Results</a></li>
<li class="' . $current . $page_slug . '"><a href="#top" title="' . $page_slug . '">' . $page_slug . '</a></li>
<li class="index"><a href="#top" title="Welcome!">Welcome</a></li>';
}


/* This function outputs an array of menu specific data for developers to create their own menus instead of using the GS default get_navigation() function. If you pass it a slug of a specific page, you will only get that page's menu data.

ADD:
<?php menu_data(); ?>

*/
function menu_data($page_slug = NULL){
	if($page_slug != NULL){
	$url = get_page_url(TRUE);
	$url = explode("/" , $url);
	$build = "";
	for($i=0; $i <= (count($url) - 2); $i++){
		$build .= $url[$i] . "/";
	}
	$build .= $page_slug;
	$name = explode("." , $page_slug);

	$output = array("slug" => $page_slug , "url" => $build, "parent_slug" => $url[(count($url) - 2)] , "title" => return_page_title() , "menu_priority" => 1 , "menu_text" => $name[0] , "menu_status" => Y, "private" => "" , "pub_date" => date("l, F jS, V - g:i A"));
	return $output;
	} else {
		$input = array("gallery" , "about" , "welcome");
		$output = array("text");
		for ($i=0; $i <= 2; $i++){
			$output[$i] = array("slug" => $input[$i] , "url" => "#top", "parent_slug" => "home" , "title" => $input[$i] , "menu_priority" => 1 , "menu_text" => $name[0] , "menu_status" => Y, "private" => "" , "pub_date" => date("l, F jS, V - g:i A"));
		}
		return $output;
	}
}


/* SO YOU'VE READ THIS FAR HAVE YOU? GOOD STUFF... BUT WHAT ARE YOU READING THIS FOR WHEN YOU COULD BE DEVELOPING A WEBSITE!?
GET TO IT. CHOP CHOP!
*/
?>
<a name="top"></a>