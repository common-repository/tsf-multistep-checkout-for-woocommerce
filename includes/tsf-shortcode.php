<?php


if (!defined('ABSPATH')) exit;




function tsf_multistep_checkout_steps_options()
{
    if (is_checkout() || defined('ICL_LANGUAGE_CODE')){
      ?>
      <style>

        .tsf-loading-img{
          background-image: url(<?php echo TSF_MULTISTEP_CHECKOUT_URL;?>/assets/images/animatedEllipse.gif);
        }

        /*buttons styles begin*/
        .tsf-controls .tsf-wizard-btn, .tsf-wizard .button{
            background-color: <?php echo get_option('tsf_multistep_checkout_buttons_bg_color');?> !important;
            color: <?php echo get_option('tsf_multistep_checkout_buttons_font_color');?> !important;
        }
        .tsf-controls .tsf-wizard-btn:hover, .tsf-wizard .button:hover{
          background-color:<?php echo get_option('tsf_multistep_checkout_buttons_hover_bg_color');?> !important;
          color:<?php echo get_option('tsf_multistep_checkout_buttons_hover_font_color');?> !important;
        }

        /*buttons styles end*/



        /*active steps begin*/

        .gsi-step-indicator.triangle li.current>*{
          color: <?php echo get_option('tsf_multistep_checkout_active_step_color');?> !important;
          background-color: <?php echo get_option('tsf_multistep_checkout_active_step_bg_color');?> !important;
          border-color: <?php echo get_option('tsf_multistep_checkout_active_step_bg_color');?> !important;
        }
        .gsi-step-indicator.triangle li.current a:hover{
          color: <?php echo get_option('tsf_multistep_checkout_active_hover_step_color');?> !important;
          background-color: <?php echo get_option('tsf_multistep_checkout_active_step_hover_bg_color');?> !important;
          border-color: <?php echo get_option('tsf_multistep_checkout_active_step_hover_bg_color');?> !important;
        }
        .gsi-style-4 li.current>* {
            background-color: <?php echo get_option('tsf_multistep_checkout_active_step_bg_color');?> !important;
            color: <?php echo get_option('tsf_multistep_checkout_active_step_color');?> !important;
        }
        .gsi-style-4 li.current a:hover{
          color: <?php echo get_option('tsf_multistep_checkout_active_hover_step_color');?> !important;
          background-color: <?php echo get_option('tsf_multistep_checkout_active_step_hover_bg_color');?> !important;
        }

        .gsi-style-4 li.current>* .number:before {
            border-left-color: <?php echo get_option('tsf_multistep_checkout_active_step_bg_color');?> !important;
        }
        .gsi-style-4 li.current:hover>* .number:before {
            border-left-color: <?php echo get_option('tsf_multistep_checkout_active_step_hover_bg_color');?> !important;
        }

        .gsi-style-7.border-top li.current>*{
            border-top: 10px solid <?php echo get_option('tsf_multistep_checkout_active_step_hover_bg_color');?> !important;
            background-color: <?php echo get_option('tsf_multistep_checkout_active_step_bg_color');?> !important;
            color: <?php echo get_option('tsf_multistep_checkout_active_step_color');?> !important;
        }
        .gsi-style-7.border-top li.current a:hover{
          color: <?php echo get_option('tsf_multistep_checkout_active_hover_step_color');?> !important;
          background-color: <?php echo get_option('tsf_multistep_checkout_active_step_hover_bg_color');?> !important;
        }



        /*active steps end*/


      </style>

      <?php

    }
}

add_action('wp_head', 'tsf_multistep_checkout_steps_options');




function tsf_multistep_checkout_add_enqueue_scripts()
{
    wp_enqueue_script("jquery");
    wp_enqueue_script('jquery-parsley-js', TSF_MULTISTEP_CHECKOUT_URL . 'assets/js/parsley.min.js');
    wp_enqueue_script('jquery-tsf-steps-js', TSF_MULTISTEP_CHECKOUT_URL . 'assets/js/tsf-wizard.bundle.min.js');


    wp_register_style('style-parsley', plugins_url('assets/css/parsley.min.css', TSF_MULTISTEP_CHECKOUT_FILE), null, TSF_MULTISTEP_CHECKOUT_VERSION);
    wp_register_style('style-tsf-steps', plugins_url('assets/css/tsf-wizard.bundle.min.css', TSF_MULTISTEP_CHECKOUT_FILE), null, TSF_MULTISTEP_CHECKOUT_VERSION);

    /*****Only add on WooCommerce checkout page*****/
    if (is_checkout()) {
        wp_enqueue_script('jquery-parsley-js');
        wp_enqueue_script('jquery-tsf-steps-js');

        wp_enqueue_style('style-parsley');
        wp_enqueue_style('style-tsf-steps');
        wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');

    }
}

add_action('wp_enqueue_scripts', 'tsf_multistep_checkout_add_enqueue_scripts');

/* * *Loading variables to wizard file ** */

function tsf_multistep_checkout_load_scripts()
{
    $vars = array(

        /*general setting*/
        'tsf_multistep_checkout_style'=> get_option('tsf_multistep_checkout_style'),
        'tsf_multistep_checkout_animation'=> get_option('tsf_multistep_checkout_animation'),
        'tsf_multistep_checkout_nav_position'=> get_option('tsf_multistep_checkout_nav_position'),
        'tsf_multistep_checkout_step_transition'=> get_option('tsf_multistep_checkout_step_transition'),
        'tsf_multistep_checkout_height'=> get_option('tsf_multistep_checkout_height'),
        'tsf_multistep_checkout_show_buttons'=> get_option('tsf_multistep_checkout_show_buttons'),
        // 'tsf_many_steps'=> get_option('tsf_many_steps'),
        'tsf_multistep_checkout_add_login_form'=> get_option('tsf_multistep_checkout_add_login_form'),
        'tsf_multistep_checkout_add_coupon_form'=>get_option('tsf_multistep_checkout_add_coupon_form'),
        'tsf_multistep_checkout_merge_billing_shipping_tabs'=> get_option('tsf_multistep_checkout_merge_billing_shipping_tabs'),
        'tsf_multistep_checkout_merge_order_payment_tabs'=> get_option('tsf_multistep_checkout_merge_order_payment_tabs'),
        'tsf_multistep_checkout_show_step_num'=> get_option('tsf_multistep_checkout_show_step_num'),
        'tsf_multistep_checkout_zipcode_validation'=> get_option('tsf_multistep_checkout_zipcode_validation'),

        /*Buttons text*/
        'tsf_multistep_checkout_btn_next'=> get_option('tsf_multistep_checkout_btn_next'),
        'tsf_multistep_checkout_btn_next_icon'=> get_option('tsf_multistep_checkout_btn_next_icon'),
        'tsf_multistep_checkout_btn_prev'=> get_option('tsf_multistep_checkout_btn_prev'),
        'tsf_multistep_checkout_btn_prev_icon'=> get_option('tsf_multistep_checkout_btn_prev_icon'),
        'tsf_multistep_checkout_btn_finish'=> get_option('tsf_multistep_checkout_btn_finish'),
        'tsf_multistep_checkout_btn_finish_icon'=> get_option('tsf_multistep_checkout_btn_finish_icon'),
        'tsf_multistep_checkout_btn_no_account'=> get_option('tsf_multistep_checkout_btn_no_account'),
        'tsf_multistep_checkout_btn_no_account_icon'=> get_option('tsf_multistep_checkout_btn_no_account_icon'),

        /*Step titles*/
        'tsf_multistep_checkout_coupon_step_label'=> get_option('tsf_multistep_checkout_coupon_step_label'),
        'tsf_multistep_checkout_billing_step_label'=> get_option('tsf_multistep_checkout_billing_step_label'),
        'tsf_multistep_checkout_shipping_step_label'=> get_option('tsf_multistep_checkout_shipping_step_label'),
        'tsf_multistep_checkout_billing_shipping_step_label'=> get_option('tsf_multistep_checkout_billing_shipping_step_label'),
        'tsf_multistep_checkout_orderinfo_step_label'=> get_option('tsf_multistep_checkout_orderinfo_step_label'),
        'tsf_multistep_checkout_paymentinfo_step_label'=> get_option('tsf_multistep_checkout_paymentinfo_step_label'),

        /*error messages*/
        'tsf_multistep_checkout_empty_error'=>get_option('tsf_multistep_checkout_empty_error'),
        'tsf_multistep_checkout_email_error'=>get_option('tsf_multistep_checkout_email_error'),
        'tsf_multistep_checkout_phone_error'=>get_option('tsf_multistep_checkout_phone_error'),
        'tsf_multistep_checkout_terms_error'=>get_option('tsf_multistep_checkout_terms_error')

    );
    if (is_checkout()) {

        wp_enqueue_script('tsf-wizard', TSF_MULTISTEP_CHECKOUT_URL . 'assets/js/tsf-wizard.js');

        wp_enqueue_script('tsf-wizard');
        wp_localize_script('tsf-wizard', 'tsf_wizard', $vars);
    }
}

tsf_multistep_checkout_enqueue_load_scripts();

function tsf_multistep_checkout_enqueue_load_scripts()
{
     add_action('wp_enqueue_scripts', 'tsf_multistep_checkout_load_scripts', 100);
}






add_action('woocommerce_checkout_order_review', 'tsf_multistep_checkout_update_shipping_info');

function tsf_multistep_checkout_update_shipping_info()
{
    ?>
    <?php if (get_option('tsf_multistep_checkout_merge_order_payment_tabs') != "true" || get_option('tsf_multistep_checkout_merge_order_payment_tabs') == ""): ?>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                // jQuery(".shipping-tab .shop_table").empty();
                // jQuery(".shop_table").appendTo(".shipping-tab");

            })
        </script>
        <?php
    endif;
}

add_action('after_setup_theme', 'tsf_multistep_checkout_avada_checkoutfix');

function tsf_multistep_checkout_avada_checkoutfix()
{
    if (function_exists('avada_woocommerce_checkout_after_customer_details')) {
        remove_action('woocommerce_checkout_after_customer_details', 'avada_woocommerce_checkout_after_customer_details');
    }

    if (function_exists('avada_woocommerce_checkout_before_customer_details')) {
        remove_action('woocommerce_checkout_before_customer_details', 'avada_woocommerce_checkout_before_customer_details');
    }
}

/* * * Add login tow wizard * */
$add_login = get_option('tsf_multistep_checkout_add_login_form');
if ($add_login == 'true' || $add_login == "") {
    add_action('after_setup_theme', 'wmc_add_checkout_login_form');

    function wmc_add_checkout_login_form()
    {
        if (!has_action('woocommerce_before_checkout_form')) {
            add_action('woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10);
        }
    }

//add login form to wizard
    add_action('woocommerce_multistep_checkout_before', 'tsf_multistep_checkout_add_login_to_wizard');

    function tsf_multistep_checkout_add_login_to_wizard()
    {
      // if (get_option('tsf_multistep_checkout_add_login_form')=='true') {
      //   return;
      // }
        if (is_user_logged_in() || 'no' === get_option('woocommerce_enable_checkout_login_reminder')) {
            return;
        }
        ?>
        <script>
            jQuery(function () {
                // jQuery(".woocommerce-info a.showlogin").parent().detach();
                // jQuery("form.login").appendTo('.login-step');
                // jQuery(".login-step form.login").show();
            });</script>
        <h1 class="title-login-wizard tsf-title" data-step='login-step' ><?php _e('Login', 'woocommerce') ?></h1>
        <div class="login-step tsf-step">


        </div>
        <?php
    }

}

/* * ***************Add Coupon form to wizard * */
$add_coupon_form = get_option('tsf_multistep_checkout_add_coupon_form');
if ($add_coupon_form == 'true') {
    /*     * Check if coupons are enabled. */
    if (get_option('woocommerce_enable_coupons') != "yes") {
        return;
    }
    add_action('woocommerce_multistep_checkout_before', 'tsf_multistep_checkout_add_coupon_form', 20);

    function tsf_multistep_checkout_add_coupon_form()
    {
        ?>
        <script>
            jQuery(function () {
                // jQuery(".woocommerce-info a.showcoupon").parent().detach();
                // jQuery("form.checkout_coupon").appendTo('.coupon-step');
                // jQuery(".coupon-step form.checkout_coupon").show();
            });</script>
          <h1 class="title-coupon-wizard tsf-title" data-step='coupon-step' ><?php echo get_option('tsf_multistep_checkout_coupon_step_label') ? get_option('tsf_multistep_checkout_coupon_step_label') : _e('Coupon', 'woocommerce-multistep-checkout'); ?></h1>

        <div class="coupon-step tsf-step">


        </div>
        <?php
    }

}

function isAuthorizedUser()
{
    return get_current_user_id();
}

add_action('wp_ajax_valid_post_code', 'tsf_multistep_checkout_validate_post_code');
add_action('wp_ajax_nopriv_valid_post_code', 'tsf_multistep_checkout_validate_post_code');

//validate PostCode
function tsf_multistep_checkout_validate_post_code()
{
    $country = sanitize_text_field($_POST['country']);
    $postCode = strtoupper(str_replace(' ', '', sanitize_text_field($_POST['postCode'])));
    echo WC_Validation::is_postcode($postCode, $country);

    exit();
}

add_action('wp_ajax_validate_phone', 'tsf_multistep_checkout_validate_phone_number');
add_action('wp_ajax_nopriv_validate_phone', 'tsf_multistep_checkout_validate_phone_number');

function tsf_multistep_checkout_validate_phone_number()
{
    $phone = sanitize_text_field($_POST['phone']);
    echo WC_Validation::is_phone($phone);

    exit();
}

//Handle Login form

add_action('wp_ajax_wmc_check_user_login', 'tsf_multistep_checkout_authenticate_user');
add_action('wp_ajax_nopriv_wmc_check_user_login', 'tsf_multistep_checkout_authenticate_user');

function tsf_multistep_checkout_authenticate_user()
{
    check_ajax_referer('wmc-login-nonce');
    if (is_email(sanitize_text_field($_POST['username'])) && apply_filters('woocommerce_get_username_from_email', true)) {
        $user = get_user_by('email', sanitize_text_field($_POST['username']));

        if (isset($user->user_login)) {
            $creds['user_login'] = $user->user_login;
        }
    } else {
        $creds['user_login'] =sanitize_text_field($_POST['username']);
    }

    $creds['user_password'] = sanitize_text_field($_POST['password']);
    $creds['remember'] = isset($_POST['rememberme']);
    $secure_cookie = is_ssl() ? true : false;
    $user = wp_signon(apply_filters('woocommerce_login_credentials', $creds), $secure_cookie);


    if (tsf_multistep_checkout_is_eruser_authenticate($user)) {
        echo '<p class="error-msg">' . _e('Incorrect username/password.', 'woocommerce-multistep-checkout') . ' </p>';
    } else {
        echo 'successfully';
    }

    exit();
}

function tsf_multistep_checkout_is_eruser_authenticate($result)
{
    return is_wp_error($result);
}


?>
