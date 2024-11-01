<?php

if (!defined('ABSPATH')) exit;

add_filter('plugin_row_meta', 'tsf_multistep_checkout_plugin_links', 10, 2);

function tsf_multistep_checkout_plugin_links($links, $file)
{
    $base = TSF_MULTISTEP_CHECKOUT_PLUGIN_SLUG;
    if ($file == $base) {
        $links[] = '<a href="http://codecanyon.net/user/askerov/portfolio?ref=askerov" target="_blank">More plugins by Askerov</a>';
    }
    return $links;
}

add_filter('plugin_action_links_' . TSF_MULTISTEP_CHECKOUT_PLUGIN_SLUG, 'tsf_multistep_checkout_link_action_on_plugin');

function tsf_multistep_checkout_link_action_on_plugin($links)
{
    return array_merge(array('settings' => '<a href="' . admin_url('admin.php?page='.TSF_MULTISTEP_CHECKOUT_SLUG.'') . '">' . _e('Settings', 'domain') . '</a>'), $links);
}

/* * ************* Add plugin info to the plugin listing page * */
if (isset($_GET['page']) && $_GET['page'] == TSF_MULTISTEP_CHECKOUT_SLUG) {
    add_filter('admin_footer_text', 'tsf_multistep_checkout_admin_footer_text');

    function tsf_multistep_checkout_admin_footer_text()
    {
        echo ('If you like <strong>Multistep Checkout for WooCommerce</strong> please leave us a &#9733;&#9733;&#9733;&#9733;&#9733; rating.');
    }
}
/* * **********Plugin Options Page ** */


/*** Add  own style  ***/
add_action('admin_enqueue_scripts', 'tsf_multistep_checkout_enqueue_color_picker');

function tsf_multistep_checkout_enqueue_color_picker()
{
    wp_register_style('tsf-admin', plugins_url('assets/css/tsf-admin.css', TSF_MULTISTEP_CHECKOUT_FILE));
    wp_register_script('tsf-admin', plugins_url('assets/js/tsf-admin.js', TSF_MULTISTEP_CHECKOUT_FILE));
    wp_enqueue_style('tsf-admin');
    wp_enqueue_script('tsf-admin');
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker-script', plugins_url('assets/js/script.js', TSF_MULTISTEP_CHECKOUT_FILE), array('wp-color-picker'), false, true);
}

add_action('admin_menu', 'tsf_multistep_checkout_menu_page');

function tsf_multistep_checkout_menu_page()
{
    add_submenu_page('woocommerce', 'Multistep Checkout for WooCommerce', 'TSF Checkout Wizard', 'manage_options', TSF_MULTISTEP_CHECKOUT_SLUG, 'tsf_multistep_checkout_options');
}
function tsf_multistep_checkout_options()
{
    //must check that the user has the required capability
    if (!current_user_can('manage_options')) {
        wp_die(('You do not have sufficient permissions to access this page.'));
    }
    ?>
    <div class="wrapper">
        <div id="icon-edit" class="icon32"></div><h2><?php _e('Multistep Checkout for WooCommerce', 'woocommerce-multistep-checkout') ?></h2>
      <a href="https://codecanyon.net/item/multistep-checkout-for-woocommerce/19606521?ref=askerov">
         <img alt="get premium version" class="premium-img" src="<?php echo TSF_MULTISTEP_CHECKOUT_URL.'/assets/images/banner.png'; ?>" />
       </a>
        <br/>
        <form name="wccheckout_options" method="post" action="">
            <input type="hidden" name="send_form" value="Y">

            <ul class="tsf-tabs">
              <li data-target="general-settings" class="active">
                <a href="javascript:void(0)">General settings</a>
              </li>
              <li data-target="steps-customization">
                <a href="javascript:void(0)">Color Customization</a>
              </li>
              <li data-target="buttons-text">
                <a href="javascript:void(0)">Buttons Text</a>
              </li>
              <li data-target="step-titles">
                <a href="javascript:void(0)">Step Titles</a>
              </li>
              <li data-target="error-messages">
                <a href="javascript:void(0)">Error Messages</a>
              </li>

            </ul>


            <div data-target="general-settings" class="tsf-tab-content active">
              <table class="form-table">

                  <tr>
                      <td class="label-column"><?php _e('Wizard Style', 'woocommerce-multistep-checkout') ?></td>
                      <td><select name="tsf_multistep_checkout_style" class="tsf_multistep_checkout_style">
                              <option value="style1" <?php selected(get_option('tsf_multistep_checkout_style'), 'style1', true); ?>><?php _e('Style 1', 'woocommerce-multistep-checkout') ?></option>
                              <option value="style2" disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_style'), 'style2', true); ?>><?php _e('Style 2 - Premium feature', 'woocommerce-multistep-checkout') ?></option>
                              <option value="style3" disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_style'), 'style3', true); ?>><?php _e('Style 3 - Premium feature', 'woocommerce-multistep-checkout') ?></option>
                              <option value="style4" <?php selected(get_option('tsf_multistep_checkout_style'), 'style4', true); ?>><?php _e('Style 4', 'woocommerce-multistep-checkout') ?></option>
                              <option value="style5" disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_style'), 'style5', true); ?>><?php _e('Style 5 - Premium feature', 'woocommerce-multistep-checkout') ?></option>
                              <option value="style5_circle" disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_style'), 'style5_circle', true); ?>><?php _e('Style 5 with circle - Premium feature', 'woocommerce-multistep-checkout') ?></option>
                              <option value="style6" disabled="disabled"  <?php selected(get_option('tsf_multistep_checkout_style'), 'style6', true); ?>><?php _e('Style 6 (coming soon) - Premium feature', 'woocommerce-multistep-checkout')  ?></option>
                              <option value="style7_borderTop" <?php selected(get_option('tsf_multistep_checkout_style'), 'style7_borderTop', true); ?>><?php _e('Style 7 (border top)', 'woocommerce-multistep-checkout') ?></option>
                              <option value="style7_borderBottom" disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_style'), 'style7_borderBottom', true); ?>><?php _e('Style 7 (border bottom) - Premium feature', 'woocommerce-multistep-checkout') ?></option>
                              <option value="style7_borderLeft" disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_style'), 'style7_borderLeft', true); ?>><?php _e('Style 7 (border left) - Premium feature', 'woocommerce-multistep-checkout') ?></option>
                              <option value="style7_borderRight" disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_style'), 'style7_borderRight', true); ?>><?php _e('Style 7 (border right) - Premium feature', 'woocommerce-multistep-checkout') ?></option>
                              <option value="style7_borderTop_circle" disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_style'), 'style7_borderTop_circle', true); ?>><?php _e('Style 7 (border top) with circle - Premium feature', 'woocommerce-multistep-checkout') ?> </option>
                              <option value="style7_borderBottom_circle" disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_style'), 'style7_borderBottom_circle', true); ?>><?php _e('Style 7 (border bottom) with circle - Premium feature', 'woocommerce-multistep-checkout') ?> </option>
                              <option value="style7_borderLeft_circle" disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_style'), 'style7_borderLeft_circle', true); ?>><?php _e('Style 7 (border left) with circle - Premium feature', 'woocommerce-multistep-checkout') ?> </option>
                              <option value="style7_borderRight_circle" disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_style'), 'style7_borderRight_circle', true); ?>><?php _e('Style 7 (border right) with circle - Premium feature', 'woocommerce-multistep-checkout') ?> </option>
                              <option value="style8" disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_style'), 'style8', true); ?>><?php _e('Style 8 (coming soon) - Premium feature', 'woocommerce-multistep-checkout') ?></option>
                              <option value="style8_circle" disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_style'), 'style8_circle', true); ?>><?php _e('Style 8 with circle (coming soon) - Premium feature', 'woocommerce-multistep-checkout') ?> </option>
                              <option value="style9"  disabled="disabled"<?php selected(get_option('tsf_multistep_checkout_style'), 'style9', true); ?>><?php _e('Style 9 (coming soon)- Premium feature', 'woocommerce-multistep-checkout') ?></option>
                              <option value="style10" disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_style'), 'style10', true); ?>><?php _e('Style 10 (coming soon)- Premium feature', 'woocommerce-multistep-checkout') ?></option>
                              <option value="style11" disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_style'), 'style11', true); ?>><?php _e('Style 11 (coming soon)- Premium feature', 'woocommerce-multistep-checkout') ?></option>
                              <option value="style12"  disabled="disabled"<?php selected(get_option('tsf_multistep_checkout_style'), 'style12', true); ?>><?php _e('Style 12 (coming soon)- Premium feature', 'woocommerce-multistep-checkout') ?></option>
                          </select>
                        <span class="description"><?php _e('Select the style of Wizard', 'woocommerce-multistep-checkout') ?></span>


                      </td>

                  </tr>
                  <tr>
                    <td class="label-column">
                      <?php _e('Style Preview', 'woocommerce-multistep-checkout') ?>
                    </td>
                    <td>  <img class="style-preview" data-base-url="<?php echo TSF_MULTISTEP_CHECKOUT_URL; ?>" >

                    </td>
                  </tr>

                  <tr>
                      <td class="label-column"><?php _e('Animation', 'woocommerce-multistep-checkout') ?></td>
                      <td>
                      <select name="tsf_multistep_checkout_animation">
                         <option value="basic" <?php selected(get_option('tsf_multistep_checkout_animation'), 'basic', true); ?>><?php _e('Basic', 'woocommerce-multistep-checkout') ?></option>
                         <option value="bounce" <?php selected(get_option('tsf_multistep_checkout_animation'), 'bounce', true); ?>><?php _e('Bounce', 'woocommerce-multistep-checkout') ?></option>
                         <option value="slideRightLeft" <?php selected(get_option('tsf_multistep_checkout_animation'), 'slideRightLeft', true); ?>><?php _e('Slide from right to left', 'woocommerce-multistep-checkout') ?></option>
                         <option value="slideLeftRight" disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_animation'), 'slideLeftRight', true); ?>><?php _e('Slide from left to right - Premium feature', 'woocommerce-multistep-checkout') ?></option>
                         <option value="flip" <?php selected(get_option('tsf_multistep_checkout_animation'), 'flip', true); ?>><?php _e('Flip', 'woocommerce-multistep-checkout') ?></option>
                         <option value="transformation"   disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_animation'), 'transformation', true); ?>><?php _e('Transformation - Premium feature', 'woocommerce-multistep-checkout') ?></option>
                         <option value="slideDownUp"  disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_animation'), 'slideDownUp', true); ?>><?php _e('Slide from down to up - Premium feature', 'woocommerce-multistep-checkout') ?></option>
                         <option value="slideUpDown" <?php selected(get_option('tsf_multistep_checkout_animation'), 'slideUpDown', true); ?>><?php _e('Slide from up to down', 'woocommerce-multistep-checkout') ?></option>
                        </select>
                          <span class="description"><?php _e('Select the animation of style', 'woocommerce-multistep-checkout') ?></span></td>
                  </tr>
                  <tr>
                      <td class="label-column"><?php _e('Navigation position of Wizard', 'woocommerce-multistep-checkout') ?></td>
                      <td><select name="tsf_multistep_checkout_nav_position">
                              <option value="top" <?php selected(get_option('tsf_multistep_checkout_nav_position'), 'top', true); ?>><?php _e('Top', 'woocommerce-multistep-checkout') ?></option>
                              <option value="right" <?php selected(get_option('tsf_multistep_checkout_nav_position'), 'right', true); ?>><?php _e('Right ', 'woocommerce-multistep-checkout') ?></option>
                              <option value="left"  disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_nav_position'), 'left', true); ?>><?php _e('Left - Premium feature', 'woocommerce-multistep-checkout') ?></option>
                              <option value="bottom"  disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_nav_position'), 'bottom', true); ?>><?php _e('Bottom - Premium feature', 'woocommerce-multistep-checkout') ?></option>
                          </select>
                        <span class="description"><?php _e('Navigation position of wizard	', 'woocommerce-multistep-checkout') ?></span></td>
                  </tr>
                  <tr>
                      <td class="label-column"><?php _e('Step transition', 'woocommerce-multistep-checkout') ?></td>
                      <td><select name="tsf_multistep_checkout_step_transition">
                              <option value="true"  disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_step_transition'), 'true', true); ?>><?php _e('Yes - Premium feature', 'woocommerce-multistep-checkout') ?></option>
                              <option value="false" <?php selected(get_option('tsf_multistep_checkout_step_transition'), 'false', true); ?>><?php _e('No', 'woocommerce-multistep-checkout') ?></option>
                          </select>
                          <span class="description"><?php _e('Change steps smoothly	', 'woocommerce-multistep-checkout') ?></span></td>
                  </tr>
                  <tr>
                      <td class="label-column"><?php _e('Height of Wizard', 'woocommerce-multistep-checkout') ?>
                      <span class="premium">Premium feature</span></td>
                      <td>
                        <input name="tsf_multistep_checkout_height" id="tsf_multistep_checkout_height" type="number"
                          class="regular-text" disabled="disabled" />
                         <br />
                          <span class="description">
                            <?php _e('Set height of Wizard, if height is empty, height will be auto  ', 'woocommerce-multistep-checkout') ?>
                          </span>
                        </td>
                  </tr>
                  <tr>
                      <td class="label-column"><?php _e('Add Login to Wizard', 'woocommerce-multistep-checkout') ?></td>
                      <td><select name="tsf_multistep_checkout_add_login_form">
                              <option value="true" <?php selected(get_option('tsf_multistep_checkout_add_login_form'), 'true', true); ?>><?php _e('Yes', 'woocommerce-multistep-checkout') ?></option>
                              <option value="false" <?php selected(get_option('tsf_multistep_checkout_add_login_form'), 'false', true); ?>><?php _e('No', 'woocommerce-multistep-checkout') ?></option>
                          </select>
                          <span class="description"><?php _e('Add Login form to wizard', 'woocommerce-multistep-checkout') ?></span></td>
                  </tr>

                  <tr>
                      <td class="label-column"><?php _e('Add Coupon to Wizard', 'woocommerce-multistep-checkout') ?></td>
                      <td><select name="tsf_multistep_checkout_add_coupon_form">
                              <option value="true" <?php selected(get_option('tsf_multistep_checkout_add_coupon_form'), 'true', true); ?>><?php _e('Yes', 'woocommerce-multistep-checkout') ?></option>
                              <option value="false" <?php selected(get_option('tsf_multistep_checkout_add_coupon_form'), 'false', true); ?>><?php _e('No', 'woocommerce-multistep-checkout') ?></option>
                          </select>
                          <span class="description"><?php _e('Add Coupon form to wizard', 'woocommerce-multistep-checkout') ?></span></td>
                  </tr>

                  <tr>
                      <td class="label-column"><?php _e('Combine Billing & shipping', 'woocommerce-multistep-checkout') ?></td>
                      <td><select name="tsf_multistep_checkout_merge_billing_shipping_tabs">
                              <option value="true" disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_merge_billing_shipping_tabs'), 'true', true); ?>><?php _e('Yes - Premium feature', 'woocommerce-multistep-checkout') ?></option>
                              <option value="false" <?php selected(get_option('tsf_multistep_checkout_merge_billing_shipping_tabs'), 'false', true); ?>><?php _e('No', 'woocommerce-multistep-checkout') ?></option>
                          </select>
                          <span class="description"><?php _e('If you want to combine Billing and Shipping steps then set this to "Yes"', 'woocommerce-multistep-checkout') ?></span></td>
                  </tr>

                  <tr>
                      <td class="label-column"><?php _e('Combine order Infomation and Payment Steps', 'woocommerce-multistep-checkout') ?></td>
                      <td><select name="tsf_multistep_checkout_merge_order_payment_tabs">
                              <option value="true"  disabled="disabled" <?php selected(get_option('tsf_multistep_checkout_merge_order_payment_tabs'), 'true', true); ?>><?php _e('Yes - Premium feature', 'woocommerce-multistep-checkout') ?></option>
                              <option value="false" <?php selected(get_option('tsf_multistep_checkout_merge_order_payment_tabs'), 'false', true); ?>><?php _e('No', 'woocommerce-multistep-checkout') ?></option>
                          </select>
                          <span class="description"><?php _e('If you want to combine Order information and Payment steps then set this to "Yes"', 'woocommerce-multistep-checkout') ?></span></td>
                  </tr>







                  <tr>
                      <td class="label-column"><?php _e('Show Number of Wizard Step', 'woocommerce-multistep-checkout') ?></td>
                      <td><select name="tsf_multistep_checkout_show_step_num">
                              <option value="false" <?php selected(get_option('tsf_multistep_checkout_show_step_num'), 'false', true); ?>><?php _e('No', 'woocommerce-multistep-checkout') ?></option>
                              <option value="true" <?php selected(get_option('tsf_multistep_checkout_show_step_num'), 'true', true); ?>><?php _e('Yes', 'woocommerce-multistep-checkout') ?></option>
                          </select>
                          <span class="description"><?php _e('Show or hide step numbers', 'woocommerce-multistep-checkout') ?></span></td>
                  </tr>

                  <tr>
                      <td class="label-column"><?php _e('Zip/Postcode Validation', 'woocommerce-multistep-checkout') ?></td>
                      <td><select name="tsf_multistep_checkout_zipcode_validation">
                              <option value="false" <?php selected(get_option('tsf_multistep_checkout_zipcode_validation'), 'false', true); ?>><?php _e('No', 'woocommerce-multistep-checkout') ?></option>
                              <option value="true" <?php selected(get_option('tsf_multistep_checkout_zipcode_validation'), 'true', true); ?>><?php _e('Yes', 'woocommerce-multistep-checkout') ?></option>
                          </select>
                          <span class="description"><?php _e('Zip/Postcode validation done by this plugin', 'woocommerce-multistep-checkout') ?></span></td>
                  </tr>
                  <tr>
                      <td class="label-column"><?php _e('Restore Plugin Defaults', 'woocommerce-multistep-checkout') ?>
                      <span class="premium">Premium feature</span></td>
                      <td><input type="checkbox" name="tsf_restore_default" value="yes"  disabled="disabled"/></td>
                  </tr>
                </table>
            </div>
            <div data-target="steps-customization" class="tsf-tab-content">
              <table class="form-table">
                <tr>
                  <td colspan="2">
                    <h3 >Active Step</h4>
                  </td>
                </tr>
                <tr>
                    <td class="label-column"><?php _e('Active step font color', 'woocommerce-multistep-checkout') ?></td>
                    <td><input name="tsf_multistep_checkout_active_step_color" id="tsf_multistep_checkout_active_step_color" type="text" value="<?php echo get_option('tsf_multistep_checkout_active_step_color') ?>" class="regular-text" /><br />
                      <span class="description">
                        <?php _e('Select color for active steps', 'woocommerce-multistep-checkout') ?>
                      </span>
                  </td>
                </tr>
                <tr>
                    <td class="label-column"><?php _e('Active step background color', 'woocommerce-multistep-checkout') ?></td>
                    <td><input name="tsf_multistep_checkout_active_step_bg_color" id="tsf_multistep_checkout_active_step_bg_color" type="text" value="<?php echo get_option('tsf_multistep_checkout_active_step_bg_color') ?>" class="regular-text" /><br />
                      <span class="description">
                        <?php _e('Select background color for active steps', 'woocommerce-multistep-checkout') ?>
                      </span>
                  </td>
                </tr>

                <tr>
                    <td class="label-column"><?php _e('Active step hover font color', 'woocommerce-multistep-checkout') ?></td>
                    <td><input name="tsf_multistep_checkout_active_hover_step_color" id="tsf_multistep_checkout_active_hover_step_color" type="text" value="<?php echo get_option('tsf_multistep_checkout_active_hover_step_color') ?>" class="regular-text" /><br />
                      <span class="description">
                        <?php _e('Select font color for active steps when mouse over', 'woocommerce-multistep-checkout') ?>
                      </span>
                  </td>
                </tr>

                <tr>
                    <td class="label-column"><?php _e('Active step hover background color', 'woocommerce-multistep-checkout') ?></td>
                    <td><input name="tsf_multistep_checkout_active_step_hover_bg_color" id="tsf_multistep_checkout_active_step_hover_bg_color" type="text" value="<?php echo get_option('tsf_multistep_checkout_active_step_hover_bg_color') ?>" class="regular-text" /><br />
                      <span class="description">
                        <?php _e('Select background color for active steps', 'woocommerce-multistep-checkout') ?>
                      </span>
                  </td>
                </tr>

                <tr>
                  <td colspan="2">
                    <h3 >Inactive Steps</h4>
                  </td>
                </tr>
                <tr>
                    <td class="label-column"><?php _e('Inactive step font color', 'woocommerce-multistep-checkout') ?>
                    <span class=" premium">Premium feature</span></td>
                        <td class="premium-row"><input name="tsf_multistep_checkout_inactive_step_color" id="tsf_multistep_checkout_inactive_step_color" type="text" value="<?php echo get_option('tsf_multistep_checkout_inactive_step_color') ?>" class="regular-text" /><br />
                      <span class="description">
                        <?php _e('Select font color for inactive steps', 'woocommerce-multistep-checkout') ?>
                      </span>
                  </td>
                </tr>
                <tr>
                    <td class="label-column"><?php _e('Inactive step background  color', 'woocommerce-multistep-checkout') ?>
                    <span class=" premium">Premium feature</span></td>
                        <td class="premium-row"><input name="tsf_multistep_checkout_inactive_step_bg_color" id="tsf_multistep_checkout_inactive_step_bg_color" type="text" value="<?php echo get_option('tsf_multistep_checkout_inactive_step_bg_color') ?>" class="regular-text" /><br />
                      <span class="description">
                        <?php _e('Select background  color for inactive steps', 'woocommerce-multistep-checkout') ?>
                      </span>
                  </td>
                </tr>

                <tr>
                  <td colspan="2">
                    <h3 >Completed Steps</h4>
                  </td>
                </tr>
                <tr>
                    <td class="label-column"><?php _e('Completed step font color', 'woocommerce-multistep-checkout') ?>
                    <span class=" premium">Premium feature</span></td>
                        <td class="premium-row"><input name="tsf_multistep_checkout_completed_step_color" id="tsf_multistep_checkout_completed_step_color" type="text" value="<?php echo get_option('tsf_multistep_checkout_completed_step_color') ?>" class="regular-text" /><br />
                      <span class="description">
                        <?php _e('Select color for completed steps', 'woocommerce-multistep-checkout') ?>
                      </span>
                  </td>
                </tr>
                <tr>
                    <td class="label-column"><?php _e('Completed step background color', 'woocommerce-multistep-checkout') ?>
                    <span class=" premium">Premium feature</span></td>
                        <td class="premium-row"><input name="tsf_multistep_checkout_completed_step_bg_color" id="tsf_multistep_checkout_completed_step_bg_color" type="text" value="<?php echo get_option('tsf_multistep_checkout_completed_step_bg_color') ?>" class="regular-text" /><br />
                      <span class="description">
                        <?php _e('Select background color for completed steps', 'woocommerce-multistep-checkout') ?>
                      </span>
                  </td>
                </tr>

                <tr>
                    <td class="label-column"><?php _e('Completed step hover font color', 'woocommerce-multistep-checkout') ?>
                    <span class=" premium">Premium feature</span></td>
                    <td class="premium-row">
                      <input disabled="disabled" readonly="readonly" name="tsf_multistep_checkout_completed_hover_step_color" id="tsf_multistep_checkout_completed_hover_step_color" type="text" value="<?php echo get_option('tsf_multistep_checkout_completed_hover_step_color') ?>" class="regular-text" /><br />
                      <span class="description">
                        <?php _e('Select font color for completed steps when mouse over', 'woocommerce-multistep-checkout') ?>
                      </span>
                  </td>
                </tr>

                <tr>
                    <td class="label-column"><?php _e('Completed step hover background color', 'woocommerce-multistep-checkout') ?>
                    <span class=" premium">Premium feature</span></td>
                        <td class="premium-row"><input name="tsf_multistep_checkout_completed_step_hover_bg_color" id="tsf_multistep_checkout_completed_step_hover_bg_color" type="text" value="<?php echo get_option('tsf_multistep_checkout_completed_step_hover_bg_color') ?>" class="regular-text" /><br />
                      <span class="description">
                        <?php _e('Select background color for completed steps', 'woocommerce-multistep-checkout') ?>
                      </span>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <h3 >Buttons styles</h4>
                  </td>
                </tr>
                  <tr>
                      <td class="label-column"><?php _e('Buttons background color', 'woocommerce-multistep-checkout') ?></td>
                      <td><input name="tsf_multistep_checkout_buttons_bg_color" id="tsf_multistep_checkout_buttons_bg_color" type="text" value="<?php echo get_option('tsf_multistep_checkout_buttons_bg_color') ?>" class="regular-text" /><br />
                          <span class="description"><?php _e('Next/Previous/Login buttons background color', 'woocommerce-multistep-checkout') ?></span></td>
                  </tr>

                  <tr>
                      <td class="label-column"><?php _e('Buttons Font color', 'woocommerce-multistep-checkout') ?></td>
                      <td><input name="tsf_multistep_checkout_buttons_font_color" id="tsf_multistep_checkout_buttons_font_color" type="text" value="<?php echo get_option('tsf_multistep_checkout_buttons_font_color') ?>" class="regular-text" /><br />
                          <span class="description"><?php _e('Next/Previous/Login/Coupon button font color', 'woocommerce-multistep-checkout') ?></span></td>
                  </tr>

                  <tr>
                      <td class="label-column"><?php _e('Buttons Hover background color', 'woocommerce-multistep-checkout') ?></td>
                      <td><input name="tsf_multistep_checkout_buttons_hover_bg_color" id="tsf_multistep_checkout_buttons_hover_bg_color" type="text" value="<?php echo get_option('tsf_multistep_checkout_buttons_hover_bg_color') ?>" class="regular-text" /><br />
                          <span class="description"><?php _e('Next/Previous/Login buttons when mouse over background color', 'woocommerce-multistep-checkout') ?></span></td>
                  </tr>

                  <tr>
                      <td class="label-column"><?php _e('Buttons Hover Font color', 'woocommerce-multistep-checkout') ?></td>
                      <td><input name="tsf_multistep_checkout_buttons_hover_font_color" id="tsf_multistep_checkout_buttons_hover_font_color" type="text" value="<?php echo get_option('tsf_multistep_checkout_buttons_hover_font_color') ?>" class="regular-text" /><br />
                          <span class="description"><?php _e('Next/Previous/Login/Coupon buttons when mouse over font color', 'woocommerce-multistep-checkout') ?></span></td>
                  </tr>



              </table>
            </div>

            <div data-target="buttons-text" class="tsf-tab-content">
              <table class="form-table">

                <tr>
                    <td class="label-column"><?php _e('Next Button', 'woocommerce-multistep-checkout') ?></td>
                    <td >
                        <input type="text" name="tsf_multistep_checkout_btn_next" value="<?php echo get_option('tsf_multistep_checkout_btn_next') ? get_option('tsf_multistep_checkout_btn_next') : "Next" ?>" />
                        <span class="description"><?php _e('Enter text for Next button', 'woocommerce-multistep-checkout') ?></span></td>
                </tr>
                <tr>
                    <td class="label-column">
                      <?php _e('Next Button icon', 'woocommerce-multistep-checkout') ?>
                      <span class=" premium">Premium feature</span>
                    </td>
                    <td >
                        <input disabled="disabled" type="text" name="tsf_multistep_checkout_btn_next_icon"  value="fa-chevron-right" />

                        <span class="description"><?php _e('Please go to <a  href="http://fontawesome.io/icons/" target="_blank">Font Awesome Icons</a> , then select icons and paste icon name  ', 'woocommerce-multistep-checkout') ?></span></td>
                </tr>
                <tr>
                    <td class="label-column"><?php _e('Previous Button', 'woocommerce-multistep-checkout') ?></td>
                    <td>
                        <input type="text" name="tsf_multistep_checkout_btn_prev" value="<?php echo get_option('tsf_multistep_checkout_btn_prev') ? get_option('tsf_multistep_checkout_btn_prev') : "Previous" ?>" />
                        <span class="description"><?php _e('Enter text for Previous button', 'woocommerce-multistep-checkout') ?></span></td>
                </tr>
                <tr>
                    <td class="label-column"><?php _e('Previous Button icon', 'woocommerce-multistep-checkout') ?>
                      <span class=" premium">Premium feature</span></td>
                    <td >
                        <input disabled="disabled" type="text" name="tsf_multistep_checkout_btn_prev_icon" value="fa-chevron-left" />
                        <span class="description"><?php _e('Please go to <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome Icons</a> , then select icons and paste icon name  ', 'woocommerce-multistep-checkout') ?></span></td>
                </tr>
                <tr>
                    <td class="label-column"><?php _e('Place Order Button', 'woocommerce-multistep-checkout') ?></td>
                    <td>
                        <input type="text" name="tsf_multistep_checkout_btn_finish" value="<?php echo get_option('tsf_multistep_checkout_btn_finish') ? get_option('tsf_multistep_checkout_btn_finish') : "Place Order" ?>" />
                        <span class="description"><?php _e('Enter text for Place Order Button', 'woocommerce-multistep-checkout') ?></span></td>
                </tr>
                <tr>
                    <td class="label-column"><?php _e('Place Order Button Icon', 'woocommerce-multistep-checkout') ?>  <span class=" premium">Premium feature</span></td>
                    <td >
                        <input disabled="disabled" type="text" name="tsf_multistep_checkout_btn_finish_icon" value="fa-shopping-cart" />
                        <span class="description"><?php _e('Please go to <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome Icons</a> , then select icons and paste icon name  ', 'woocommerce-multistep-checkout') ?></span></td>
                </tr>
                <tr>
                    <td class="label-column"><?php _e('No Account Button', 'woocommerce-multistep-checkout') ?></td>
                    <td>
                        <input type="text" name="tsf_multistep_checkout_btn_no_account" value="<?php echo get_option('tsf_multistep_checkout_btn_no_account') ? stripslashes(get_option('tsf_multistep_checkout_btn_no_account')) : "I don't have an account" ?>" />
                        <span class="description"><?php _e('Enter text for No Account Button', 'woocommerce-multistep-checkout') ?></span></td>
                </tr>
                <tr>
                    <td class="label-column"><?php _e('No Account Button Icon', 'woocommerce-multistep-checkout') ?>  <span class=" premium">Premium feature</span></td>
                    <td >
                        <input  disabled="disabled" type="text" name="tsf_multistep_checkout_btn_no_account_icon" value="fa-user-times" />
                        <span class="description"><?php _e('Please go to <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome Icons</a> , then select icons and paste icon name  ', 'woocommerce-multistep-checkout') ?></span></td>
                </tr>
              </table>
            </div>

            <div data-target="step-titles" class="tsf-tab-content">
                <table class="form-table">
                  <tr>
                      <td class="label-column"><?php _e('Login', 'woocommerce-multistep-checkout') ?></td>
                      <td>
                          <input type="text" name="tsf_multistep_checkout_login_step_label" value="<?php echo get_option('tsf_multistep_checkout_login_step_label') ? get_option('tsf_multistep_checkout_login_step_label') : "Coupon" ?>" />
                          <span class="description"><?php _e('Enter text for Login label', 'woocommerce-multistep-checkout') ?></span></td>
                  </tr>
                  <tr>
                      <td class="label-column"><?php _e('Login description', 'woocommerce-multistep-checkout') ?>
                        <span class=" premium">Premium feature</span>
                      </td>
                      <td>
                          <input  disabled="disabled" type="text" name="tsf_multistep_checkout_login_step_desc"  />
                          <span class="description"><?php _e('Enter text for Login description', 'woocommerce-multistep-checkout') ?></span></td>
                  </tr>
                      <tr>
                          <td class="label-column"><?php _e('Coupon', 'woocommerce-multistep-checkout') ?></td>
                          <td>
                              <input type="text" name="tsf_multistep_checkout_coupon_step_label" value="<?php echo get_option('tsf_multistep_checkout_coupon_step_label') ? get_option('tsf_multistep_checkout_coupon_step_label') : "Coupon" ?>" />
                              <span class="description"><?php _e('Enter text for Coupon label', 'woocommerce-multistep-checkout') ?></span></td>
                      </tr>
                      <tr>
                          <td class="label-column"><?php _e('Coupon description', 'woocommerce-multistep-checkout') ?>
                          <span class=" premium">Premium feature</span></td>
                          <td>
                              <input  disabled="disabled" type="text" name="tsf_multistep_checkout_coupon_step_desc"  />
                              <span class="description"><?php _e('Enter text for Coupon description', 'woocommerce-multistep-checkout') ?></span></td>
                      </tr>
                      <tr>
                          <td class="label-column"><?php _e('Billing', 'woocommerce-multistep-checkout') ?></td>
                          <td>
                              <input type="text" name="tsf_multistep_checkout_billing_step_label" value="<?php echo get_option('tsf_multistep_checkout_billing_step_label') ? get_option('tsf_multistep_checkout_billing_step_label') : "Billing" ?>" />
                              <span class="description"><?php _e('Enter text for Billing label', 'woocommerce-multistep-checkout') ?></span></td>
                      </tr>
                      <tr>
                          <td class="label-column"><?php _e('Billing description', 'woocommerce-multistep-checkout') ?>
                          <span class=" premium">Premium feature</span></td>
                          <td>
                              <input  disabled="disabled" type="text" name="tsf_multistep_checkout_billing_step_desc"  />
                              <span class="description"><?php _e('Enter text for Billing description', 'woocommerce-multistep-checkout') ?></span></td>
                      </tr>
                      <tr>
                          <td class="label-column"><?php _e('Shipping', 'woocommerce-multistep-checkout') ?></td>
                          <td>
                              <input type="text" name="tsf_multistep_checkout_shipping_step_label" value="<?php echo get_option('tsf_multistep_checkout_shipping_step_label') ? get_option('tsf_multistep_checkout_shipping_step_label') : "Shipping" ?>" />
                              <span class="description"><?php _e('Enter text for Shipping label', 'woocommerce-multistep-checkout') ?></span></td>
                      </tr>
                      <tr>
                          <td class="label-column"><?php _e('Shipping description', 'woocommerce-multistep-checkout') ?>
                          <span class=" premium">Premium feature</span></td>
                          <td>
                              <input  disabled="disabled" type="text" name="tsf_multistep_checkout_shipping_step_desc" value="" />
                              <span class="description"><?php _e('Enter text for Shipping description', 'woocommerce-multistep-checkout') ?></span></td>
                      </tr>
                      <tr>
                          <td class="label-column"><?php _e('Billing & Shipping', 'woocommerce-multistep-checkout') ?></td>
                                      <td>
                                          <input type="text" name="tsf_multistep_checkout_billing_shipping_step_label" value="<?php echo get_option('tsf_multistep_checkout_billing_shipping_step_label') ? get_option('tsf_multistep_checkout_billing_shipping_step_label') : "Billing & Shipping" ?>" />
                                          <span class="description"><?php _e('Text for combined Billing & Shipping step', 'woocommerce-multistep-checkout') ?></span></td>
                        </tr>

                        <tr>
                            <td class="label-column"><?php _e('Billing & Shipping description', 'woocommerce-multistep-checkout') ?>
                            <span class=" premium">Premium feature</span>
                          </td>
                            <td>
                                <input  disabled="disabled" type="text" name="tsf_multistep_checkout_billing_shipping_step_desc"  />
                                <span class="description"><?php _e('Enter text for Billing & Shipping description', 'woocommerce-multistep-checkout') ?></span></td>
                        </tr>

                        <tr>
                            <td class="label-column"><?php _e('Order Information', 'woocommerce-multistep-checkout') ?></td>
                            <td>
                                <input type="text" name="tsf_multistep_checkout_orderinfo_step_label" value="<?php echo get_option('tsf_multistep_checkout_orderinfo_step_label') ? get_option('tsf_multistep_checkout_orderinfo_step_label') : "Order Information" ?>" />
                                <span class="description"><?php _e('Enter text for Order Information label', 'woocommerce-multistep-checkout') ?></span></td>
                        </tr>
                        <tr>
                            <td class="label-column"><?php _e('Order description', 'woocommerce-multistep-checkout') ?>
                            <span class=" premium">Premium feature</span></td>
                            <td>
                                <input  disabled="disabled" type="text" name="tsf_multistep_checkout_orderinfo_step_desc"  />
                                <span class="description"><?php _e('Enter text for Order description', 'woocommerce-multistep-checkout') ?></span></td>
                        </tr>
                        <tr>
                            <td class="label-column"><?php _e('Payment Info', 'woocommerce-multistep-checkout') ?></td>
                            <td>
                                <input type="text" name="tsf_multistep_checkout_paymentinfo_step_label" value="<?php echo get_option('tsf_multistep_checkout_paymentinfo_step_label') ? get_option('tsf_multistep_checkout_paymentinfo_step_label') : "Payment Info" ?>" />
                                <span class="description"><?php _e('Enter text for Payment Info label', 'woocommerce-multistep-checkout') ?></span></td>
                        </tr>
                        <tr>
                            <td class="label-column"><?php _e('Payment description', 'woocommerce-multistep-checkout') ?>
                            <span class=" premium">Premium feature</span></td>
                            <td>
                                <input  disabled="disabled" type="text" name="tsf_multistep_checkout_paymentinfo_step_desc"  />
                                <span class="description"><?php _e('Enter text for Payment description', 'woocommerce-multistep-checkout') ?></span></td>
                        </tr>
                </table>
                </div>
                <div data-target="error-messages" class="tsf-tab-content">
                  <table class="form-table">
                      <tr>
                          <td class="label-column"><?php _e('Empty Fields', 'woocommerce-multistep-checkout') ?></td>
                          <td>
                              <input type="text" name="tsf_multistep_checkout_empty_error" value="<?php echo get_option('tsf_multistep_checkout_empty_error') ?>" />
                              <span class="description"><?php _e('Enter text for empty field error', 'woocommerce-multistep-checkout') ?></span></td>
                      </tr>

                      <tr>
                          <td class="label-column"><?php _e('Invalid E-mail', 'woocommerce-multistep-checkout') ?></td>
                          <td>
                              <input type="text" name="tsf_multistep_checkout_email_error" value="<?php echo get_option('tsf_multistep_checkout_email_error'); ?>" />
                              <span class="description"><?php _e('Enter text for invalid email error', 'woocommerce-multistep-checkout') ?></span></td>
                      </tr>

                      <tr>
                          <td class="label-column"><?php _e('Invalid Phone', 'woocommerce-multistep-checkout') ?></td>
                          <td>
                              <input type="text" name="tsf_multistep_checkout_phone_error" value="<?php echo get_option('tsf_multistep_checkout_phone_error') ?>" />
                              <span class="description"><?php _e('Enter text for invalid phone number error', 'woocommerce-multistep-checkout') ?></span></td>
                      </tr>

                  </table>
                </div>


                    <?php
                      if (isset($_POST['send_form']) && sanitize_text_field($_POST['send_form']) == 'Y') {

                          $do_not_save = array('send_form', 'submit', 'tsf_restore_default');
                          foreach ($_POST as $option_name => $option_value) {
                              if (in_array($option_name, $do_not_save))
                                  continue;

                              // Save the posted value in the database
                              update_option($option_name, sanitize_text_field($option_value));
                          }

                          ?>
                          <div class="updated"><p><strong><?php _e('Settings saved', 'woocommerce-multistep-checkout'); ?></strong></p></div>
                          <?php
                      }
                    ?>
            <p class="submit">
                <input type="submit" name="submit" class="tsf-submit" value="<?php esc_attr_e('Save Changes') ?>" />
            </p>

        </form>

    </div>
<style>
.wrapper{
  background-color: #fff;
      padding: 10px 25px;
}
</style>

    <?php
}

?>
