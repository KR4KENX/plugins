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
                    <img width="75" height="75" src="'. plugin_dir_url(__FILE__) . '/dark' .'/facebook.png' .'"></img>
                </a>
                <a href="https://'.get_option('smb_instagram', 'instagram.com').'" target="_blank"> 
                    <img width="75" height="75" src="'. plugin_dir_url(__FILE__) . '/dark' .'/instagram.png' .'"></img>
                </a>
                <a href="https://'.get_option('smb_linkedin', 'linkedin.com').'" target="_blank"> 
                    <img width="75" height="75" src="'. plugin_dir_url(__FILE__) . '/dark' .'/linkedin.png' .'"></img>
                </a>
            </div>
            <p style="text-align:center;">Made by social-media-buttons plugin</p>
        </div>';
    if(get_option( 'smb_icon_theme', '0') == '0'){
        $html = '
        <div>
            <h5 style="text-align:center;">Check our social media!</h5>
            <div style="display:flex; justify-content: space-evenly;">
                <a href="https://'.get_option('smb_facebook', 'facebook.com').'" target="_blank"> 
                    <img width="75" height="75" src="'. plugin_dir_url(__FILE__) . '/color' .'/facebook.webp' .'"></img>
                </a>
                <a href="https://'.get_option('smb_instagram', 'instagram.com').'" target="_blank"> 
                    <img width="75" height="75" src="'. plugin_dir_url(__FILE__) . '/color' .'/instagram.png' .'"></img>
                </a>
                <a href="https://'.get_option('smb_linkedin', 'linkedin.com').'" target="_blank"> 
                    <img width="75" height="75" src="'. plugin_dir_url(__FILE__) . '/color' .'/linkedin.png' .'"></img>
                </a>
            </div>
            <p style="text-align:center;">Made by social-media-buttons plugin</p>
        </div>';
    }

    return $content.$html;
}

function socialMediaAdmin() {
    add_options_page('Social media buttons', 'Social Buttons', 'manage_options', 'social-buttons-settings', 'socialMediaHtml');
}

function settings() {
    add_settings_section('smb_first_section', null, null, 'social-buttons-settings');

    add_settings_field('smb_icon_theme', 'Icon theme', 'iconRadioHtml', 'social-buttons-settings', 'smb_first_section');
    register_setting('socialmediaplugin', 'smb_icon_theme', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => '0',
    ));

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

function iconRadioHtml() {
    ?>
    <label for="color">Colorful</label>
    <input type="radio" name="smb_icon_theme" id="color" value="0" <?php echo (get_option( 'smb_icon_theme', '0') == '0') ? 'checked' : ' ' ?>>
    <label for="dark">Dark</label>
    <input type="radio" name="smb_icon_theme" id="dark" value="1" <?php echo (get_option( 'smb_icon_theme', '0') == '1') ? 'checked' : ' ' ?>>
    <?php
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