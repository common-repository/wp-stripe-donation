<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//print_r( $wpsdContentSettings );
foreach ( $wpsdContentSettings as $option_name => $option_value ) {
    if ( isset( $wpsdContentSettings[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="wpsd-fundraising-settings-form" role="form" class="form-horizontal" method="post" action="" id="wpsd-fundraising-settings-form-id">
    <?php 
wp_nonce_field( 'wpsd_fundraising_content_action', 'wpsd_fundraising_content_nonce_field' );
?>
    <table class="wpsd-form-content-settings">
        <tr>
            <th scope="row">
                <label for="wpsd_enable_fundraising"><?php 
_e( 'Enable Fundraising', WPSD_TXT_DOMAIN );
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
_e( 'Target Amount', WPSD_TXT_DOMAIN );
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
				<label><?php 
_e( 'Start Date', WPSD_TXT_DOMAIN );
?></label>
			</th>
			<td>
				<?php 
?>
					<span><?php 
echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now', WPSD_TXT_DOMAIN ) . '</a>';
?></span>
					<?php 
?>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label><?php 
_e( 'End Date', WPSD_TXT_DOMAIN );
?></label>
			</th>
			<td>
				<?php 
?>
					<span><?php 
echo '<a href="' . wsd_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now', WPSD_TXT_DOMAIN ) . '</a>';
?></span>
					<?php 
?>
			</td>
		</tr>
    </table>
    <hr>
    <p class="submit">
        <button id="updateContent" name="updateContent" class="button button-primary wpsd-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Save Settings', WPSD_TXT_DOMAIN );
?>
        </button>
    </p>
</form>