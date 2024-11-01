<?php

if (!defined('ABSPATH')) exit;
/**
* default options for plugin*
*/
 function tsf_multistep_checkout_restore_defaults()
{
  /*general settings*/
  update_option('tsf_multistep_checkout_style', 'style1');
  update_option('tsf_multistep_checkout_animation', 'basic');
  update_option('tsf_multistep_checkout_nav_position', 'top');
  update_option('tsf_multistep_checkout_step_transition', 'false');
  update_option('tsf_multistep_checkout_height', 'auto');
  update_option('tsf_multistep_checkout_show_buttons', 'true');
  // update_option('tsf_many_steps', 'true');
  update_option('tsf_multistep_checkout_add_login_form', 'true');
  update_option('tsf_multistep_checkout_add_coupon_form', 'true');
  update_option('tsf_multistep_checkout_merge_billing_shipping_tabs', 'false');
  update_option('tsf_multistep_checkout_merge_order_payment_tabs', 'false');
  update_option('tsf_multistep_checkout_show_step_num', 'true');
  update_option('tsf_multistep_checkout_zipcode_validation', 'true');

  /*Buttons text*/
  update_option('tsf_multistep_checkout_btn_next', 'Next');
  update_option('tsf_multistep_checkout_btn_prev', 'Previous');
  update_option('tsf_multistep_checkout_btn_finish', 'Place Order');
  update_option('tsf_multistep_checkout_btn_no_account', 'I don\'t have an account');

  /*Step titles*/
  update_option('tsf_multistep_checkout_login_step_label', 'Login');
  update_option('tsf_multistep_checkout_coupon_step_label', 'Coupon');
  update_option('tsf_multistep_checkout_billing_step_label', 'Billing');
  update_option('tsf_multistep_checkout_shipping_step_label', 'Shipping');
  update_option('tsf_multistep_checkout_billing_shipping_step_label', 'Billing & Shipping');
  update_option('tsf_multistep_checkout_orderinfo_step_label', 'Order Information');
  update_option('tsf_multistep_checkout_paymentinfo_step_label', 'Payment Info');

  /*error messages*/
  update_option('tsf_multistep_checkout_empty_error', 'This field is required');
  update_option('tsf_multistep_checkout_email_error', 'Please enter a valid email address');
  update_option('tsf_multistep_checkout_phone_error', 'Please enter valid phone number');
  update_option('tsf_multistep_checkout_terms_error', 'You must accept our Terms & Conditions');

  /*color customization*/
  update_option('tsf_multistep_checkout_active_step_color', '#ffffff');
  update_option('tsf_multistep_checkout_active_hover_step_color', '#ffffff');
  update_option('tsf_multistep_checkout_active_step_bg_color', '#96c03d');
  update_option('tsf_multistep_checkout_active_step_hover_bg_color', '#2c3f4c');

  update_option('tsf_multistep_checkout_inactive_step_bg_color', '#e5e5e5');
  update_option('tsf_multistep_checkout_inactive_step_color', '#5d5d5d');

  update_option('tsf_multistep_checkout_completed_step_bg_color', '#a6d04e');
  update_option('tsf_multistep_checkout_completed_step_hover_bg_color', '#2c3f4c');
  update_option('tsf_multistep_checkout_completed_step_color', '#ffffff');
  update_option('tsf_multistep_checkout_completed_hover_step_color', '#ffffff');

  update_option('tsf_multistep_checkout_buttons_bg_color', '#96c03d');
  update_option('tsf_multistep_checkout_buttons_hover_bg_color', '#2c3f4c');
  update_option('tsf_multistep_checkout_buttons_font_color', '#ffffff');
  update_option('tsf_multistep_checkout_buttons_hover_font_color', '#fff');
}

?>
