<?php
/*
    Plugin Name: Social media buttons
    Description: lorem ipsum
    Version: 1.0
    Author: Adrian
    Author URI: localhost
*/

add_action('admin_menu', array($this, 'socialMediaAdmin'));

function socialMediaAdmin() {
    add_options_page('Social media buttons', 'Social Buttons', 'manage_options', 'social-buttons-settings', array($this, 'socialMediaHtml'));
}