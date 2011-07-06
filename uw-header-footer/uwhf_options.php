<?php
add_action('admin_menu', 'uwhf_menu');

function uwhf_menu() {
  add_menu_page('UW Theming', 'UW Theming', 'administrator', 
    __FILE__,'uwhf_settings_page',plugins_url('/images/icon.png', __FILE__));

  add_action( 'admin_init', 'register_uwhf_settings' );
}

function register_uwhf_settings() {
  register_setting( 'uwhf_settings', 'themeNetid' );
  register_setting( 'uwhf_settings', 'themeDefaultOn' );
}

function uwhf_settings_page() {
?>
<div class="wrap">
<h2>UW Theming Options</h2>
<h3>Use Information</h3>
<p>More information is located in the README, but I've copied the use 
information section below.</p>
<p>There are two modes you can run in:</p>
  <strong>Default mode</strong>: This will use the default header and footer. If 
you want to
 use the default mode, just activate the plugin: you're done!
<br/><br/>

  <strong>Custom Mode</strong>: This allows you to customize the header & footer 
as you see
 fit.
<br/><br/>
 For custom mode, follow these steps:
<ol>
<li>
 Go to the header and footer wizard:
<br/><br/>
 <a href="https://depts.washington.edu/uweb/tmplgen/" target="_blank">Header & 
Footer Wizard</a>
</li>
<li>
 Enter in your contact email and site URL. Continue through the steps choosing
 what options you'd prefer.
</li>

<li>Once you're complete and at the "Code Preference" step, choose "Include" and
 click on "generate my code."
</li>
 <li>Activate the plugin and go to the "UW Theming" screen. Uncheck "default" 
and
 enter in the NetID of where you ran the theming wizard. This is probably your
 personal NetID, but if you're not sure, go to <a 
href="http://weblogin.washington.edu" 
target="_blank">http://weblogin.washington.edu</a> to see
 what you're logged in as.
</li>
<li> Click on "save" and check out your site. It should be updated with your new
 options!
</li>
<li>You can go back and change your options at any time. There's no need to 
generate the code again: simply clicking on "next" will update whatever you just 
modified.</li>
</ol>

<h3>Settings</h3>
<form method="post" action="options.php">
<?php settings_fields( 'uwhf_settings' ); ?>
<?php do_settings_sections( 'uwhf_settings' ); ?>
<p>Check the box below if you want to use the default header & footer.</p>
Default Header & Footer? 
<input type="radio" name="themeDefaultOn" value="yes" <? if ( get_option('themeDefaultOn') == "yes" || get_option('themeDefaultOn') == "") { echo 'checked=checked';} ?> /> Yes, please use the default header & footer.</input>
<input type="radio" name="themeDefaultOn" value="no" <? if ( get_option('themeDefaultOn') == "no" ) { echo 'checked=checked';} ?>/> No, please the following NetID's header and footer.</input>

<p>If you selected "no" above, and want to use a custom header & footer, 
enter the NetID where you ran the header & footer with. For your reference, you are currently logged in as "<?=$_SERVER['REMOTE_USER']?>".</p>
Custom Theme NetID: <input type="text" maxlength="8" name="themeNetid" value="<?php print 
get_option('themeNetid'); ?>">
<br/>
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" 
/>
</form>
</div>
<?php } ?>
