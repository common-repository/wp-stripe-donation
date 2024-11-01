<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//print_r( $wpsdGeneralSettings );
foreach ( $wpsdGeneralSettings as $option_name => $option_value ) {
    if ( isset( $wpsdGeneralSettings[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<div id="wpsd-wrap-all" class="wrap wpsd-general-settings">

    <div class="settings-banner">
        <h2><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;<?php 
_e( 'General Settings', WPSD_TXT_DOMAIN );
?></h2>
    </div>

    <?php 
if ( $wpsdGeneralShowMessage ) {
    $this->wpsd_display_notification( 'success', 'Your information updated successfully.' );
}
?>

    <div class="wpsd-wrap">

        <div class="wpsd_personal_wrap wpsd_personal_help" style="width: 75%; float: left; margin-top: 5px;">

            <form name="wpsd-general-settings-form" role="form" class="form-horizontal" method="post" action="" id="wpsd-settings-form-id">
                <?php 
wp_nonce_field( 'wpsd_general_action', 'wpsd_general_nonce_field' );
?>
                <table class="form-table wpsd-general-settings">
                    <tr>
                        <th scope="row">
                            <label><?php 
_e( 'Donation Admin Email', WPSD_TXT_DOMAIN );
?></label>
                        </th>
                        <td colspan="3">
                            <input type="text" name="wpsd_donation_email" id="wpsd_donation_email" class="regular-text"
                                value="<?php 
esc_attr_e( $wpsd_donation_email );
?>" />
                            <br>
                            <code><?php 
_e( 'A notification email will send when a donation is made', WPSD_TXT_DOMAIN );
?></code>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpsd_disable_donation_email"><?php 
_e( 'Disable Admin Email Notification', WPSD_TXT_DOMAIN );
?></label>
                        </th>
                        <td colspan="3">
                            <?php 
?>
                                <span><?php 
echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', WPSD_TXT_DOMAIN ) . '</a>';
?></span>
                                <?php 
?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php 
_e( 'Form Header Title', WPSD_TXT_DOMAIN );
?></label>
                            <span class="dashicons dashicons-info-outline wpsd-admin-icon"></span>
                            <img src="<?php 
echo esc_attr( WPSD_ASSETS . 'img/wpsd-form-header-title.webp' );
?>" class="wpsd-admin-help-img">
                        </th>
                        <td colspan="3">
                            <input type="text" name="wpsd_payment_title" id="wpsd_payment_title" class="regular-text"
                                value="<?php 
esc_attr_e( $wpsd_payment_title );
?>" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php 
_e( 'Form Description', WPSD_TXT_DOMAIN );
?></label>
                            <span class="dashicons dashicons-info-outline wpsd-admin-icon"></span>
                            <img src="<?php 
echo esc_attr( WPSD_ASSETS . 'img/wpsd-form-desc.webp' );
?>" class="wpsd-admin-help-img">
                        </th>
                        <td colspan="3">
                            <?php 
wp_editor( wp_kses_post( $wpsd_form_description ), 'wpsd_form_description', array(
    'media_buttons' => true,
    'textarea_rows' => '10',
) );
?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php 
_e( 'Donation For Options', WPSD_TXT_DOMAIN );
?></label>
                            <span class="dashicons dashicons-info-outline wpsd-admin-icon"></span>
                            <img src="<?php 
echo esc_attr( WPSD_ASSETS . 'img/wpsd-donation-for-options.webp' );
?>" class="wpsd-admin-help-img">
                        </th>
                        <td colspan="3">
                            <textarea cols="40" style="min-height:100px;" name="wpsd_donation_options" class="regular-text"
                                id="wpsd_donation_options"><?php 
esc_html_e( $wpsd_donation_options );
?></textarea>
                            <br>
                            <code><?php 
_e( 'Use comma "," separated values like: Option-1, Option-2', WPSD_TXT_DOMAIN );
?></code>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php 
_e( 'Form Amounts', WPSD_TXT_DOMAIN );
?></label>
                            <span class="dashicons dashicons-info-outline wpsd-admin-icon"></span>
                            <img src="<?php 
echo esc_attr( WPSD_ASSETS . 'img/wpsd-form-amounts.webp' );
?>" class="wpsd-admin-help-img">
                        </th>
                        <td>
                            <textarea cols="40" style="min-height:100px;" name="wpsd_donation_values" class="regular-text"
                                id="wpsd_donation_values"><?php 
esc_html_e( $wpsd_donation_values );
?></textarea>
                            <br>
                            <code><?php 
_e( 'Use comma "," separated values like: 100,150,200', WPSD_TXT_DOMAIN );
?></code>
                        </td>
                        <th scope="row">
                            <label><?php 
_e( 'Minimum Amount', WPSD_TXT_DOMAIN );
?></label>
                        </th>
                        <td>
                            <input type="number" min="1" max="10000" step="1" name="wpsd_minimum_amount" value="<?php 
esc_attr_e( $wpsd_minimum_amount );
?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php 
_e( 'Form Submit Button Text', WPSD_TXT_DOMAIN );
?></label>
                            <span class="dashicons dashicons-info-outline wpsd-admin-icon"></span>
                            <img src="<?php 
echo esc_attr( WPSD_ASSETS . 'img/wpsd-form-button-text.webp' );
?>" class="wpsd-admin-help-img">
                        </th>
                        <td colspan="3">
                            <input type="text" name="wpsd_donate_button_text" id="wpsd_donate_button_text" class="regular-text"
                                value="<?php 
esc_attr_e( $wpsd_donate_button_text );
?>" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php 
_e( 'Currency', WPSD_TXT_DOMAIN );
?></label>
                            <span class="dashicons dashicons-info-outline wpsd-admin-icon"></span>
                            <img src="<?php 
echo esc_attr( WPSD_ASSETS . 'img/wpsd-form-currency.webp' );
?>" class="wpsd-admin-help-img">
                        </th>
                        <td colspan="3">
                            <select name="wpsd_donate_currency" id="wpsd_donate_currency" class="regular-text">
                                <?php 
$wpsdCurrency = $this->hm_get_all_currency();
foreach ( $wpsdCurrency as $wpsdcurr ) {
    ?>
                                    <option value="<?php 
    esc_attr_e( $wpsdcurr->abbreviation );
    ?>" <?php 
    if ( $wpsd_donate_currency === $wpsdcurr->abbreviation ) {
        echo 'selected';
    }
    ?> >
                                        <?php 
    esc_html_e( $wpsdcurr->currency );
    ?>-<?php 
    esc_html_e( $wpsdcurr->abbreviation );
    ?>-<?php 
    esc_html_e( $wpsdcurr->symbol );
    ?>
                                    </option>
                                    <?php 
}
?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php 
_e( 'Redirect Thank You Page', WPSD_TXT_DOMAIN );
?></label>
                        </th>
                        <td colspan="3">
                            <?php 
?>
                                <span><?php 
echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', WPSD_TXT_DOMAIN ) . '</a>';
?></span>
                                <?php 
?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpsd_exclude_stripe_sdk"><?php 
_e( 'Exclude Stripe SDK', WPSD_TXT_DOMAIN );
?></label>
                        </th>
                        <td colspan="3">
                            <input type="checkbox" name="wpsd_exclude_stripe_sdk" class="wpsd_exclude_stripe_sdk" id="wpsd_exclude_stripe_sdk" value="1" 
                                <?php 
echo ( $wpsd_exclude_stripe_sdk ? 'checked' : '' );
?>>
                            <code><?php 
_e( 'Check this if your form keeps loading!', WPSD_TXT_DOMAIN );
?></code>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php 
esc_html_e( 'Shortcode', WPSD_TXT_DOMAIN );
?></label>
                        </th>
                        <td colspan="3">
                            <input type="text" name="wpsd_shortcode" id="wpsd_shortcode" class="regular-text" value="[wp_stripe_donation]" readonly />
                            <br>
                            <code><?php 
_e( 'Copy that shortcode and apply it in any page to display donation form.', WPSD_TXT_DOMAIN );
?></code>
                        </td>
                    </tr>
                </table>
                <hr>
                <p class="submit">
                    <button id="updateGeneralSettings" name="updateGeneralSettings" class="button button-primary wpsd-button">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php 
esc_attr_e( 'Save Settings', WPSD_TXT_DOMAIN );
?>
                    </button>
                </p>
            </form>

        </div>

        <?php 
$this->wpsd_admin_sidebar();
?>

    </div>
</div>