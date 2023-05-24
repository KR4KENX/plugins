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
add_filter('the_content', 'social_media_icons');

function social_media_icons($content){
    $html = '
    <div>
        <h5 style="text-align:center;">Check our social media!</h5>
        <div style="display:flex; justify-content: space-evenly;">
            <a href="https://'.get_option('smb_facebook', 'facebook.com').'" target="_blank"> 
                <img width="75" height="75" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b8/2021_Facebook_icon.svg/2048px-2021_Facebook_icon.svg.png"></img>
            </a>
            <a href="https://'.get_option('smb_instagram', 'instagram.com').'" target="_blank"> 
                <img width="75" height="75" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Instagram_icon.png/2048px-Instagram_icon.png"></img>
            </a>
            <a href="https://'.get_option('smb_linkedin', 'linkedin.com').'" target="_blank"> 
                <img width="75" height="75" src="https://cdn-icons-png.flaticon.com/512/174/174857.png"></img>
            </a>
        </div>
        <p style="text-align:center;">Made by social-media-buttons plugin</p>
    </div>';
    return $content.$html;
}

function socialMediaAdmin() {
    add_options_page('Social media buttons', 'Social Buttons', 'manage_options', 'social-buttons-settings', 'socialMediaHtml');
}

function settings() {
    add_settings_section('smb_first_section', null, null, 'social-buttons-settings');

    add_settings_field('smb_facebook', 'Facebook', 'textfieldHtml', 'social-buttons-settings', 'smb_first_section', array('mediaName' => 'facebook'));
    register_setting('socialmediaplugin', 'smb_facebook', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'facebook.com',
    ));

    add_settings_field('smb_instagram', 'Instagram', 'textfieldHtml', 'social-buttons-settings', 'smb_first_section', array('mediaName' => 'instagram'));
    register_setting('socialmediaplugin', 'smb_instagram', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'instagram.com',
    ));

    add_settings_field('smb_linkedin', 'Linkedin', 'textfieldHtml', 'social-buttons-settings', 'smb_first_section', array('mediaName' => 'linkedin'));
    register_setting('socialmediaplugin', 'smb_linkedin', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'linkedin.com',
    ));
}

function textfieldHtml($args) {
    ?>
    <input type="text" name="<?php echo 'smb_'.$args['mediaName']; ?>" value="<?php echo get_option('smb_'.$args['mediaName'], $args['mediaName'].'.com'); ?>"></input>
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