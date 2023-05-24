<?php
/*
    Plugin Name: Social media buttons
    Description: Lorem ipsum
    Version: 1.0
    Author: Adrian
    Author URI: localhost
*/

add_action('admin_menu', 'socialMediaAdmin');
add_action('admin_init', 'settings');

function socialMediaAdmin() {
    add_options_page('Social media buttons', 'Social Buttons', 'manage_options', 'social-buttons-settings', 'socialMediaHtml');
}

function settings() {
    add_settings_section('smb_first_section', null, null, 'social-buttons-settings');

    add_settings_field('smb_facebook', 'Facebook', 'textfieldHtml', 'social-buttons-settings', 'smb_first_section', array('mediaName' => 'facebook'));
    register_setting('socialmediaplugin', 'smb_facebook', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'facebook.com',
        'show_in_rest' => true
    ));
}

function textfieldHtml($args) {
    ?>
    <input type="text" name="<?php echo 'smb_'.$args['mediaName']; ?>" placeholder="<?php echo get_option('smb_facebook', 'facebook.com'); ?>"></input>
    <?php
}

function socialMediaHtml() {
    ?>
    <div class="wrap">
        <h1>Social media buttons</h1>
        <form action="options.php" method="POST">
            <?php
                settings_fields('socialmediaplugin');
                do_settings_sections('social-buttons-settings');
                submit_button();
            ?>
        </form>
    </div>
    <?php
}