<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout
if (!$checkout->enable_signup && !$checkout->enable_guest_checkout && !is_user_logged_in()) {
    echo apply_filters('woocommerce_checkout_must_be_logged_in_message', _e('You must be logged in to checkout.', 'woocommerce'));
    return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters('woocommerce_get_checkout_url', WC()->cart->get_checkout_url());
?>

<div class="container-coupon-login-form"></div>
<div class="tsf-loading-img">
</div>
<div id="tsf-wizard" class="tsf-wizard tsf-wizard-1" style="visibility:hidden" >
  <div class="tsf-nav-step">
      <!-- BEGIN STEP INDICATOR-->
      <ul class="gsi-step-indicator triangle gsi-style-1  gsi-transition ">
          <li class="current" data-target="step-1">
              <a href="#0">
                  <span class="number">1</span>
                  <span class="desc">
                      <label>Account setup</label>
                      <span>Account details</span>
                  </span>
              </a>
          </li>

      </ul>
      <!-- END STEP INDICATOR--->
  </div>
  <div class="tsf-container">
    <div class="tsf-content">
          <form  name="checkout" method="post"  action="<?php echo esc_url($get_checkout_url); ?>">
      <div id="wizard"><!---Start of jQuery Wizard -->
          <?php do_action('woocommerce_multistep_checkout_before'); ?>
          <?php if (sizeof($checkout->checkout_fields) > 0) : ?>

              <?php do_action('woocommerce_checkout_before_customer_details'); ?>

              <?php if (WC()->cart->ship_to_billing_address_only() && WC()->cart->needs_shipping() || get_option('tsf_multistep_checkout_merge_billing_shipping_tabs') == 'true') : ?>
                  <h1 class="title-billing-shipping tsf-title " data-step='billing-tab-contents' >
                    <?php echo get_option('tsf_multistep_checkout_billing_shipping_step_label') ? get_option('tsf_multistep_checkout_billing_shipping_step_label'): _e('Billing &amp; Shipping', 'woocommerce-multistep-checkout') ?>
                  </h1>
              <?php else: ?>
                    <h1 class="title-billing-shipping tsf-title " data-step='billing-tab-contents' >
                    <?php echo get_option('tsf_multistep_checkout_billing_step_label') ?get_option('tsf_multistep_checkout_billing_step_label') : _e('Billing', 'woocommerce-multistep-checkout') ?>
                  </h1>
              <?php endif; ?>

              <?php
              /**
               * If Combine Billing and Shipping Steps **
               */
              if (get_option('tsf_multistep_checkout_merge_billing_shipping_tabs') == 'false') {?>


                  <div class="billing-tab-contents tsf-step">
                      <?php
                      do_action('woocommerce_checkout_billing');

                      //If cart don't needs shipping
                      if (!WC()->cart->needs_shipping_address()) :
                          do_action('woocommerce_checkout_after_customer_details');
                          do_action('woocommerce_before_order_notes', $checkout);

                          if (apply_filters('woocommerce_enable_order_notes_field', get_option('woocommerce_enable_order_comments', 'yes') === 'yes')) :

                              if (!WC()->cart->needs_shipping() || WC()->cart->ship_to_billing_address_only()) :
                                  ?>

                                  <h3><?php _e('Additional Information', 'woocommerce'); ?></h3>

                              <?php endif; ?>

                              <?php foreach ($checkout->checkout_fields['order'] as $key => $field) : ?>

                                  <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>

                              <?php endforeach; ?>

                          <?php endif; ?>
                          <?php do_action('woocommerce_after_order_notes', $checkout); ?>
                      <?php endif; ?>
                  </div>

                  <?php if (!WC()->cart->ship_to_billing_address_only() && WC()->cart->needs_shipping()) : ?>

                      <?php do_action('woocommerce_multistep_checkout_before_shipping'); ?>

                      <div class="shipping-tab-contents">
                        <h1 class="title-shipping"><?php echo get_option('tsf_multistep_checkout_shipping_step_label') ? get_option('tsf_multistep_checkout_shipping_step_label') : _e('Shipping', 'woocommerce-multistep-checkout') ?></h1>

                          <?php do_action('woocommerce_checkout_shipping'); ?>

                          <?php do_action('woocommerce_checkout_after_customer_details'); ?>
                      </div>
                      <?php do_action('woocommerce_multistep_checkout_after_shipping'); ?>
                  <?php endif; ?>
              <?php } ?>
          <?php endif; ?>

          <?php do_action('woocommerce_multistep_checkout_before_order_info'); ?>


          <?php if (get_option('tsf_multistep_checkout_merge_order_payment_tabs') != "true"): ?>
              <h1 class="title-order-info tsf-title " data-step='shipping-tab' >
                <?php echo get_option('tsf_multistep_checkout_orderinfo_step_label') ? get_option('tsf_multistep_checkout_orderinfo_step_label'): _e('Order Information', 'woocommerce-multistep-checkout'); ?>
              </h1>
              <div class="shipping-tab tsf-step">
                  <?php do_action('woocommerce_multistep_checkout_before_order_contents'); ?>
              </div>
          <?php endif ?>

          <?php do_action('woocommerce_multistep_checkout_after_order_info'); ?>
          <?php do_action('woocommerce_multistep_checkout_before_payment'); ?>
          <h1 class="title-payment tsf-title" data-step="payment-tab-contents" ><?php echo get_option('tsf_multistep_checkout_paymentinfo_step_label') ? get_option('tsf_multistep_checkout_paymentinfo_step_label') : _e('Payment Info', 'woocommerce-multistep-checkout'); ?></h1>

          <div class="payment-tab-contents tsf-step">

              <div id="order_review" class="woocommerce-checkout-review-order">
                  <?php do_action('woocommerce_checkout_before_order_review'); ?>
                  <?php do_action('woocommerce_checkout_order_review'); ?>
              </div>
          </div>


          <?php do_action('woocommerce_multistep_checkout_after'); ?>
      </div>
  </form></div>
  <div class="tsf-controls ">
      <!-- BEGIN PREV BUTTTON-->
      <button type="button" data-type="prev" class="btn btn-left tsf-wizard-btn">
          <i class="fa fa-chevron-left"></i> PREV
      </button>
      <!-- END PREV BUTTTON-->
      <!-- BEGIN NEXT BUTTTON-->
      <button type="button" data-type="next" class="btn btn-right tsf-wizard-btn">
          NEXT <i class="fa fa-chevron-right"></i>
      </button>
      <!-- END NEXT BUTTTON-->
      <!-- BEGIN FINISH BUTTTON-->
      <button type="submit" data-type="finish" class="btn btn-right tsf-wizard-btn">
          FINISH
      </button>
      <!-- END FINISH BUTTTON-->
  </div>
  </div>
</div>
<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
