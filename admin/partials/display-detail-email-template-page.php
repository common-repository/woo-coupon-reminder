<?php
/* The file has a Detail Email template
 *
 * @package    Woo_Coupon_Reminder
 * @subpackage Woo_Coupon_Reminder/admin/partials
 *
 */

defined( 'ABSPATH' ) || exit;

wp_nonce_field( 'viwcr_save_email_template', '_viwcr_save_email_template' );
$viwcr_email_enable  = get_post_meta( $post->ID, 'viwcr_email_enable', true );
$viwcr_email_setting = get_post_meta( $post->ID, 'viwcr_email_setting', true );

if ( isset( $viwcr_email_setting )
     && is_array( $viwcr_email_setting ) ) {
    $viwcr_number_expiry         = isset( $viwcr_email_setting['viwcr_number_expiry'] ) ? $viwcr_email_setting['viwcr_number_expiry'] : 1;
    $viwcr_unit_expiry           = isset( $viwcr_email_setting['viwcr_unit_expiry'] ) ? $viwcr_email_setting['viwcr_unit_expiry'] : 'days';
    $viwcr_email_subject         = isset( $viwcr_email_setting['viwcr_email_subject'] ) ? $viwcr_email_setting['viwcr_email_subject'] : 'Coupon reminder from {viwcr_site_title}';
    $viwcr_email_header          = isset( $viwcr_email_setting['viwcr_email_header'] ) ? $viwcr_email_setting['viwcr_email_header'] : 'WooCommerce Coupon Reminder!';
    $viwcr_email_content         = ! empty( $viwcr_email_setting['viwcr_email_content'] ) ? $viwcr_email_setting['viwcr_email_content'] : "Dear ,\n Your coupon is about to expire. Please apply the coupon when shopping with us before it expires.\nThank you!\nCoupon code: {coupon_code}\nExpiration Date: {coupon_expiry}\nLove and cherish";
    $viwcr_email_content_replace = isset( $viwcr_email_setting['viwcr_email_content_replace'] ) ? $viwcr_email_setting['viwcr_email_content_replace'] : 'template_none';
    
    $viwcr_button_title      = ! empty( $viwcr_email_setting['viwcr_button_title'] ) ? $viwcr_email_setting['viwcr_button_title'] : 'Shop now';
    $viwcr_button_url        = ! empty( $viwcr_email_setting['viwcr_button_url'] ) ? $viwcr_email_setting['viwcr_button_url'] : home_url();
    $viwcr_button_font_size  = ! empty( $viwcr_email_setting['viwcr_button_font_size'] ) ? $viwcr_email_setting['viwcr_button_font_size'] : '16';
    $viwcr_button_color      = ! empty( $viwcr_email_setting['viwcr_button_color'] ) ? $viwcr_email_setting['viwcr_button_color'] : '#ffffff';
    $viwcr_button_background = ! empty( $viwcr_email_setting['viwcr_button_background'] ) ? $viwcr_email_setting['viwcr_button_background'] : '#000000';
} else {
    $viwcr_number_expiry = 1;
    $viwcr_unit_expiry   = 'days';
    $viwcr_email_subject = '';
    $viwcr_email_header  = '';
    $viwcr_email_content = "Dear ,\n Your coupon is about to expire. Please apply the coupon when shopping with us before it expires.\nThank you!\nCoupon code: {coupon_code}\nExpiration Date: {coupon_expiry}\nLove and cherish";;
    $viwcr_email_content_replace = 'template_none';
    
    $viwcr_button_title      = 'Shop now';
    $viwcr_button_url        = home_url();
    $viwcr_button_font_size  = '16';
    $viwcr_button_color      = '#ffffff';
    $viwcr_button_background = '#000000';
}
if ( ! empty( $viwcr_email_enable ) ) {
    $enable_template = $viwcr_email_enable;
} else {
    $enable_template = 'on';
}

?>

<div class="vi-ui grid vertical segment detail_wrap_setting">
    
    <div class="vi-ui row two no-wrap item_row">
        <div class="column three wide column_label">
            <label class="label-setting"
                   for="viwcr-enable_template"><?php esc_html_e( 'Enable template', 'woo-coupon-reminder' ); ?></label>
        </div>
        <div class="column thirteen wide column_field">
            <div class="vi-ui toggle checkbox">
                <input type="checkbox" name="viwcr-enable_template"
                       id="viwcr-enable_template" <?php if ( $enable_template == 'on' ) {
                    esc_attr_e( 'checked', 'woo-coupon-reminder' );
                } ?> >
                <label></label>
            </div>
            <span class="explanatory-text"><?php esc_html_e( 'Enable email template', 'woo-coupon-reminder' ); ?></span>
        </div>
    </div>
    <div class="vi-ui row two no-wrap item_row ">
        <div class="column three wide column_label">
            <label for="viwcr_number_expiry"
                   class="label-setting"><?php esc_html_e( 'Choose email send before coupon expiry date:', 'woo-coupon-reminder' ); ?></label>
        </div>
        <div class="column thirteen wide column_field vi-ui form">
            <div class="field">
                <div class="vi-ui fluid action input">
                    <input name="viwcr-number_expiry" id="viwcr_number_expiry" type="number" min="0" step="1"
                           value="<?php echo esc_attr( $viwcr_number_expiry ); ?>">
                    <div class="vi-ui basic floating dropdown button">
                        <input type="hidden" name="viwcr-unit_expiry"
                               value="<?php echo esc_attr( $viwcr_unit_expiry ); ?>">
                        <div class="text"><?php echo esc_html( ucfirst( $viwcr_unit_expiry ) ); ?></div>
                        <i class="dropdown icon"></i>
                        <div class="menu">
                            <div class="item" data-value="<?php esc_attr_e( 'days', 'woo-coupon-reminder' ); ?>"
                                 data-text="<?php esc_attr_e( 'Days', 'woo-coupon-reminder' ); ?>"><?php esc_html_e( 'Days', 'woo-coupon-reminder' ); ?></div>
                            <div class="item" data-value="<?php esc_attr_e( 'hours', 'woo-coupon-reminder' ); ?>"
                                 data-text="<?php esc_attr_e( 'Hours', 'woo-coupon-reminder' ); ?>"><?php esc_html_e( 'Hours', 'woo-coupon-reminder' ); ?></div>
                            <div class="item" data-value="<?php esc_attr_e( 'minutes', 'woo-coupon-reminder' ); ?>"
                                 data-text="<?php esc_attr_e( 'Minutes', 'woo-coupon-reminder' ); ?>"><?php esc_html_e( 'Minutes', 'woo-coupon-reminder' ); ?></div>
                        </div>
                    </div>
                </div>
                <span class="explanatory-text"><?php esc_html_e( 'Choose email send before coupon expiry date', 'woo-coupon-reminder' ); ?></span>
            </div>
        </div>
    </div>
    <div class="vi-ui row two no-wrap item_row ">
        <div class="column three wide column_label">
            <label class="label-setting"><?php esc_html_e( 'Email template:', 'woo-coupon-reminder' ); ?></label>
        </div>
        <div class="column thirteen wide column_field vi-ui form">
            <div class="two fields">
                <div class="field">
                    <label class="label-setting"
                           for="viwcr_email_subject"><?php esc_html_e( 'Email subject', 'woo-coupon-reminder' ); ?></label>
                    <input class="viwcr_field"
                           type="text"
                           name="viwcr-email_subject"
                           id="viwcr_email_subject"
                           value="<?php echo esc_attr( $viwcr_email_subject ); ?>"
                           autocomplete="off"
                    >
                    <span class="explanatory-text"><?php esc_html_e( '{viwcr_site_title} - Your site title', 'woo-coupon-reminder' ); ?></span>
                </div>
                <div class="field">
                    <label class="label-setting"
                           for="viwcr_email_header"><?php esc_html_e( 'Email header', 'woo-coupon-reminder' ); ?></label>
                    <input class="viwcr_field"
                           type="text"
                           name="viwcr-email_header"
                           id="viwcr_email_header"
                           value="<?php echo esc_attr( $viwcr_email_header ); ?>"
                           autocomplete="off"
                    >
                </div>
            </div>
            <div class="field">
                <label class="label-setting"
                       for="viwcr_email_content"><?php esc_html_e( 'Email content', 'woo-coupon-reminder' ); ?></label>
                <?php
                $option = array( 'editor_height' => 300, 'media_buttons' => true );
                
                wp_editor( stripslashes( wp_kses_post( $viwcr_email_content ) ), 'viwcr-email_content', $option );
                ?>
                
                <span class="explanatory-text"><?php esc_html_e( 'You can use the following shortcodes to add information to the body of an email:', 'woo-coupon-reminder' ); ?></span>
                <span class="explanatory-text"><?php esc_html_e( '{viwcr_site_title} - Your site title', 'woo-coupon-reminder' ); ?></span>
                <span class="explanatory-text"><?php esc_html_e( '{coupon_code} - Shop coupon code', 'woo-coupon-reminder' ); ?></span>
                <span class="explanatory-text"><?php esc_html_e( '{coupon_des} - Shop coupon description', 'woo-coupon-reminder' ); ?></span>
                <span class="explanatory-text"><?php esc_html_e( '{coupon_amount} - Shop coupon amount', 'woo-coupon-reminder' ); ?></span>
                <span class="explanatory-text"><?php esc_html_e( '{coupon_expiry} - Shop coupon expiry', 'woo-coupon-reminder' ); ?></span>
                <span class="explanatory-text"><?php esc_html_e( '{use_coupon_button} - Use Coupon Button', 'woo-coupon-reminder' ); ?></span>
                <?php echo '<a class="viwcr-button-shop-now" href="' . esc_attr( $viwcr_button_url ) . '" target="_blank" style="text-decoration:none;display:inline-block;padding:10px 30px;margin:10px 0;font-size: ' . esc_attr( $viwcr_button_font_size ) . 'px;color:' . esc_attr( $viwcr_button_color ) . ';background:' . esc_attr( $viwcr_button_background ) . ';">' . esc_html( $viwcr_button_title ) . '</a>' ?>
            </div>
        </div>
    </div>
    <?php
    $replace_emails = $this->viwcr_get_replace_email_templates();
    if ( count( $replace_emails ) > 0 ) {
        ?>
        <div class="vi-ui row two no-wrap item_row ">
            <div class="column three wide column_label">
                <label class="label-setting"
                       for="viwcr_button_title"><?php esc_html_e( 'Replace content email with:', 'woo-coupon-reminder' ); ?></label>
            </div>
            <div class="column thirteen wide column_field vi-ui form">
                <div class="field">
                    
                    <div class="vi-ui dropdown fluid">
                        <select name="viwcr-email_content_replace" id="viwcr_email_content_replace" class="fluid">
                            <option value="template_none" <?php echo selected( $viwcr_email_content_replace, 'template_none' ); ?>> <?php esc_html_e( 'None', 'woo-coupon-reminder' ); ?></option>
                            <?php
                            
                            // Match Emoticons
                            $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
                            
                            // Match Miscellaneous Symbols and Pictographs
                            $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
                            
                            // Match Transport And Map Symbols
                            $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
                            
                            // Match Miscellaneous Symbols
                            $regexMisc = '/[\x{2600}-\x{26FF}]/u';
                            
                            // Match Dingbats
                            $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
                            foreach ( $replace_emails as $replace_email_item ) {
                                $clean_text = preg_replace( $regexEmoticons, '', $replace_email_item->post_title );
                                $clean_text = preg_replace( $regexSymbols, '', $clean_text );
                                $clean_text = preg_replace( $regexTransport, '', $clean_text );
                                $clean_text = preg_replace( $regexMisc, '', $clean_text );
                                $clean_text = preg_replace( $regexDingbats, '', $clean_text );
                                ?>
                                <option value="<?php echo esc_attr( $replace_email_item->ID ); ?>"
                                    <?php echo selected( $viwcr_email_content_replace, $replace_email_item->ID ); ?>
                                >
                                    <?php echo esc_html( $clean_text ); ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <span class="explanatory-text"><?php esc_html_e( 'Select the template you created in the plugin "Email Template Customizer for WooCommerce" that you want to replace', 'woo-coupon-reminder' ); ?></span>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="vi-ui row two no-wrap item_row ">
        <div class="column three wide column_label">
            <label class="label-setting"
                   for="viwcr_button_title"><?php esc_html_e( 'Button "Shop now" title:', 'woo-coupon-reminder' ); ?></label>
        </div>
        <div class="column thirteen wide column_field vi-ui form">
            <div class="field">
                <div class="vi-ui fluid input">
                    <input name="viwcr-button_title" id="viwcr_button_title" type="text"
                           value="<?php echo esc_attr( $viwcr_button_title ); ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="vi-ui row two no-wrap item_row ">
        <div class="column three wide column_label">
            <label class="label-setting"
                   for="viwcr_button_url"><?php echo esc_html( 'Button "Shop now" URL' ); ?></label>
        </div>
        <div class="column thirteen wide column_field vi-ui form">
            <div class="field">
                <div class="vi-ui fluid input">
                    <input name="viwcr-button_url" id="viwcr_button_url" type="text"
                           value="<?php echo esc_attr( $viwcr_button_url ); ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="vi-ui row two no-wrap item_row ">
        <div class="column three wide column_label">
            <label class="label-setting"><?php esc_html_e( 'Button "Shop now" style:', 'woo-coupon-reminder' ); ?></label>
        </div>
        <div class="column thirteen wide vi-ui form">
            <div class="three fields">
                <div class="field">
                    <label class="label-setting"
                           for="viwcr_button_font_size"><?php esc_html_e( 'Font size:', 'woo-coupon-reminder' ); ?></label>
                    <div class="vi-ui right labeled input">
                        <input type="number" name="viwcr-button_font_size" id="viwcr_button_font_size" min="1"
                               value="<?php echo esc_attr( $viwcr_button_font_size ); ?>">
                        <label class="vi-ui label">PX</label>
                    </div>
                </div>
                <div class="field">
                    <label class="label-setting"
                           for="viwcr_button_text_color"><?php esc_html_e( 'Text Color:', 'woo-coupon-reminder' ); ?></label>
                    <input type="text" name="viwcr-button_text_color" id="viwcr_button_text_color" class="color-picker"
                           value="<?php echo esc_attr( $viwcr_button_color ); ?>">
                </div>
                <div class="field">
                    <label class="label-setting"
                           for="viwcr_button_background"><?php esc_html_e( 'background color:', 'woo-coupon-reminder' ); ?></label>
                    <input type="text" name="viwcr-button_background" id="viwcr_button_background" class="color-picker"
                           value="<?php echo esc_attr( $viwcr_button_background ); ?>">
                </div>
            </div>
        </div>
    </div>
</div>
