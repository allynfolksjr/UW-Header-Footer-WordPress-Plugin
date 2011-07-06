<?php
/**
 *   @package uw_header_footer
 *    @version 1.0
 */
/*
  Plugin Name: UW Theme Element Generator
  Plugin URI: http://staff.washington.edu/nikky/wordpress-plugins-and-themes/ 
  Description: Embeds headers and footers from the UW theme generator into Wordpress.
  Author: Nikky Southerland 
  Version: 1.0
  Author URI: http://staff.washington.edu/nikky
 */

include 'uwhf_options.php';
include 'uwhf_lib.php';

/* Figure out what kind of theme we'll be applying */


if (get_option('themeDefaultOn') != "no")
{
  $themeNetid = "blog";
}
else
{
$themeNetid = get_option('themeNetid');
}
/* There is no action to add content immediately after <body>, so we need to use a hack to do that. */

function uwTemplateInclude($template) {
  ob_start();
  return $template;
}

function uwHeader($themeNetid)
{
  global $themeNetid;
  $header = new webContent();
  $headerCode = $header->getData("http://depts.washington.edu/uweb/inc/header.cgi?i=$themeNetid");
  // Finally, we use this hacky hack to find the body tag, add the header, and spit it all back out!

  $restOfPage = ob_get_clean();
  $restOfPage = preg_replace('#<body([^>]*)>#i',"<body$1>{$headerCode}",$restOfPage);
  print $restOfPage;
}


function uwFooter()
{
  global $themeNetid;
  $footer = new webContent();
  $footerCode = $footer->getData("http://depts.washington.edu/uweb/inc/footer.cgi?i=$themeNetid");
  print $footerCode;
}

function uwStyle()
{
  global $themeNetid;
  $style = new webContent();
  $styleCode = $style->getData("http://depts.washington.edu/uweb/inc/head.cgi?i=$themeNetid");
  print $styleCode;
}

// The hooks

add_action('wp_print_styles','uwStyle');

/* Then, the header, using a hacky hack hack */
add_filter('template_include','uwTemplateInclude',1);
add_filter('shutdown',uwHeader,0);

/* Last, footer */
add_action('wp_footer','uwFooter');

