<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wpsdNotice = false;

if ( isset( $_POST['saveSettings'] ) ) {

    if ( ! isset( $_POST['wpsd_recaptcha_settings_nonce_field'] ) 
        || ! wp_verify_nonce( $_POST['wpsd_recaptcha_settings_nonce_field'], 'wpsd_recaptcha_settings_action' ) ) {
        print 'Sorry, your nonce did not verify.';
        exit;
    } else {
        $wpsd_recaptcha_Settings = array(
            'wpsd_enable_recaptcha'   => isset( $_POST['wpsd_enable_recaptcha'] ) ? sanitize_text_field( $_POST['wpsd_enable_recaptcha'] ) : 'off',
            'wpsd_recaptcha_site_key'   => isset( $_POST['wpsd_recaptcha_site_key'] ) ? sanitize_text_field( $_POST['wpsd_recaptcha_site_key'] ) : '',
            'wpsd_recaptcha_secret_key' => isset( $_POST['wpsd_recaptcha_secret_key'] ) ? sanitize_text_field( $_POST['wpsd_recaptcha_secret_key'] ) : '',
        );

        $wpsdKeyShowMessage = update_option( 'wpsd_recaptcha_Settings', $wpsd_recaptcha_Settings);
    }
}

$wpsdKeySettings            = get_option('wpsd_recaptcha_Settings');
$wpsd_enable_recaptcha      = isset( $wpsdKeySettings['wpsd_enable_recaptcha'] ) ? esc_html( $wpsdKeySettings['wpsd_enable_recaptcha'] ) : 'off';
$wpsd_recaptcha_site_key    = isset( $wpsdKeySettings['wpsd_recaptcha_site_key'] ) ? esc_html( $wpsdKeySettings['wpsd_recaptcha_site_key'] ) : '';
$wpsd_recaptcha_secret_key  = isset( $wpsdKeySettings['wpsd_recaptcha_secret_key'] ) ? esc_html( $wpsdKeySettings['wpsd_recaptcha_secret_key'] ) : '';
?>
<div id="wpsd-wrap-all" class="wrap wpsd-recaptcha-settings">

    <div class="settings-banner">
        <h2><i class="fa-solid fa-robot"></i>&nbsp;<?php _e('Google reCaptcha Settings', 'wp-stripe-donation'); ?></h2>
    </div>

    <?php 
        if ( $wpsdNotice ) {
            $this->wpsd_display_notification('success', 'Your information updated successfully.'); 
        } 
    ?>

    <div class="wpsd-wrap">

        <div class="wpsd_personal_wrap wpsd_personal_help" style="width: 75%; float: left;">

            <form name="wpsd-recaptcha-settings-form" role="form" class="form-horizontal" method="post" action="" id="wpsd-recaptcha-settings-form-id" autocomplete="off">
                <?php wp_nonce_field( 'wpsd_recaptcha_settings_action', 'wpsd_recaptcha_settings_nonce_field' ); ?>
                <table class="form-table">
                    <tr class="wpsd_enable_recaptcha">
                        <th scope="row">
                            <label for="wpsd_enable_recaptcha"><?php _e('Enable reCaptcha', WPSD_TXT_DOMAIN); ?>:</label>
                        </th>
                        <td>
                            <input type="checkbox" name="wpsd_enable_recaptcha" class="wpsd_enable_recaptcha" id="wpsd_enable_recaptcha" <?php echo ( 'on' === $wpsd_enable_recaptcha ) ? 'checked' : ''; ?>> 
                        </td>
                    </tr>
                    <tr class="wpsd_recaptcha_site_key">
                        <th scope="row">
                            <label for="wpsd_recaptcha_site_key"><?php _e('Site Key', WPSD_TXT_DOMAIN); ?>:</label>
                        </th>
                        <td>
                            <input type="text" name="wpsd_recaptcha_site_key" id="wpsd_recaptcha_site_key" class="regular-text" value="<?php esc_attr_e( $wpsd_recaptcha_site_key ); ?>"/>
                        </td>
                    </tr>
                    <tr class="wpsd_recaptcha_secret_key">
                        <th scope="row">
                            <label for="wpsd_recaptcha_secret_key"><?php _e('Secret Key', WPSD_TXT_DOMAIN); ?>:</label>
                        </th>
                        <td>
                            <input type="text" name="wpsd_recaptcha_secret_key" id="wpsd_recaptcha_secret_key" class="regular-text" value="<?php esc_attr_e( $wpsd_recaptcha_secret_key ); ?>"/>
                        </td>
                    </tr>
                </table>
                <hr>
                <p class="submit">
                    <button id="saveSettings" name="saveSettings" class="button button-primary wpsd-button">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php _e('Save Settings', WPSD_TXT_DOMAIN); ?>
                    </button>
                </p>
            </form>

        </div>

        <?php $this->wpsd_admin_sidebar(); ?>

    </div>

</div>