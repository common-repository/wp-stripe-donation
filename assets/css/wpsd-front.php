<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<style type="text/css">
    .wpsd-master-wrapper {
        background-color: <?php esc_html_e( $wpsd_form_bg_color ); ?>;
        width: <?php esc_html_e( $wpsd_form_width ); ?><?php esc_html_e( $wpsd_form_width_type ); ?> !important;
        border: <?php esc_html_e( $wpsd_form_border_width ); ?>px solid <?php esc_html_e( $wpsd_form_border_color ); ?>;
        border-radius: <?php esc_html_e( $wpsd_form_radius ); ?>px;
        padding: <?php esc_html_e( $wpsd_form_padding_top ); ?>px <?php esc_html_e( $wpsd_form_padding_right ); ?>px <?php esc_html_e( $wpsd_form_padding_bottom ); ?>px <?php esc_html_e( $wpsd_form_padding_left ); ?>px;
    }
    .wpsd-master-wrapper h3.wpsd-form-title,
    .wpsd-form-description,
    .wpsd-master-wrapper .wpsd-wrapper-content .wpsd-donation-form-label {
        color: <?php esc_html_e( $wpsd_form_font_color ); ?>;
    }
    /** amount label */
    .wpsd-master-wrapper .wpsd-wrapper-content ul#wpsd_donate_amount li.amount,
    .wpsd-master-wrapper .wpsd-wrapper-content ul#wpsd_donate_amount li.wpsd_donate_amount_other_li,
    .wpsd-address-country .selectize-input {
        border: <?php esc_html_e( $wpsd_form_input_border_width ); ?>px solid <?php esc_html_e( $wpsd_form_input_border_color ); ?>;
        background-color: <?php esc_html_e( $wpsd_form_input_bg_color ); ?>;
        color: <?php esc_html_e( $wpsd_form_input_font_color ); ?>;
    }
    .wpsd-master-wrapper .wpsd-wrapper-content #wpsd-donation-form-id #wpsd_donate_other_amount {
        background-color: <?php esc_html_e( $wpsd_form_input_bg_color ); ?>;
    }
    .wpsd-master-wrapper .wpsd-wrapper-content ul#wpsd_donate_amount li.amount:hover {
        background-color: <?php esc_html_e( $wpsd_form_input_font_color ); ?>;
    }
    .wpsd-master-wrapper .wpsd-wrapper-content ul#wpsd_donate_amount li.amount label {
        color: <?php esc_html_e( $wpsd_form_input_font_color ); ?>;
    }
    .wpsd-master-wrapper .wpsd-wrapper-content ul#wpsd_donate_amount li.amount label:hover {
        color: <?php esc_html_e( $wpsd_form_input_bg_color ); ?>;
    }
    .wpsd-master-wrapper .wpsd-wrapper-content .wpsd-text-field,
    #card-element {
        background-color: <?php esc_html_e( $wpsd_form_input_bg_color ); ?>;
        border: <?php esc_html_e( $wpsd_form_input_border_width ); ?>px solid <?php esc_html_e( $wpsd_form_input_border_color ); ?>;
        border-radius: <?php esc_html_e( $wpsd_form_input_border_radius ); ?>px;
        padding: <?php esc_html_e( $wpsd_form_input_padding_top ); ?>px <?php esc_html_e( $wpsd_form_input_padding_right ); ?>px <?php esc_html_e( $wpsd_form_input_padding_bottom ); ?>px <?php esc_html_e( $wpsd_form_input_padding_left ); ?>px;
        color: <?php esc_html_e( $wpsd_form_input_font_color ); ?>;
        font-size: <?php esc_html_e( $wpsd_form_input_font_size ); ?>px;
    }
    .ElementsApp input {
        font-size: <?php esc_html_e( $wpsd_form_input_font_size ); ?>px!important;
    }
    .wpsd-master-wrapper .wpsd-wrapper-content .wpsd-text-field::placeholder,
    .wpsd-master-wrapper .wpsd-wrapper-content .wpsd_donate_other_amount::placeholder,
    .selectize-dropdown [data-selectable].option,
    .selectize-input > input { /* Chrome, Firefox, Opera, Safari 10.1+ */
        color: <?php esc_html_e( $wpsd_form_input_font_color ); ?>!important;
        opacity: 1; /* Firefox */
    }
    .wpsd-master-wrapper .wpsd-wrapper-content .wpsd-donate-button {
        width: <?php esc_html_e( $wpsd_form_button_width ); ?><?php esc_html_e( $wpsd_form_button_width_type ); ?> !important;
        background-color: <?php esc_html_e( $wpsd_button_bg_color ); ?> !important;
        color: <?php esc_html_e( $wpsd_button_font_color ); ?>!important;
        font-size: <?php esc_html_e( $wpsd_form_btn_font_size ); ?>px;
        line-height: <?php esc_html_e( $wpsd_form_btn_font_size + 10 ); ?>px;
    }
    .wpsd-master-wrapper .wpsd-wrapper-content .wpsd-donate-button:hover {
        background: <?php esc_html_e( $wpsd_button_bg_color_hover ); ?>!important;
        color: <?php esc_html_e( $wpsd_button_font_color_hover ); ?>!important;
    }
    .wpsd-form-item-half-left,
    .wpsd-form-item-half-right {
        width: 50%;
        float: left;
    }
    .wpsd-form-item-half-left {
        padding-right: 5px;
    }
    .wpsd-form-item-half-right {
        padding-left: 5px;
    }
</style>