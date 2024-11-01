<?php
/*
 * Plugin Name: TSF Multistep Checkout for WooCommerce
 * Description: Multistep Checkout for WooCommerce enable chance beautifying and simplifying checkout process. All buyers interested simple checkout process , so you can increase your sales.
 * Version: 1.0
 * Author: Askerov
 * Author URI: http://cidcode.net
 * Text Domain: woocommerce-multistep-checkout
 * Domain Path: /languages/
 */

 if (!defined('ABSPATH')) exit;

 if (!defined('TSF_MULTISTEP_CHECKOUT_SLUG')) {
     define('TSF_MULTISTEP_CHECKOUT_SLUG', 'tsf-multistep');
     define('TSF_MULTISTEP_CHECKOUT_VERSION', '1.0');
     define('TSF_MULTISTEP_CHECKOUT_FILE', __FILE__);
     define('TSF_MULTISTEP_CHECKOUT_PATH', plugin_dir_path(__FILE__));
     define('TSF_MULTISTEP_CHECKOUT_URL', plugin_dir_url(__FILE__));
     define('TSF_MULTISTEP_CHECKOUT_PLUGIN_SLUG', plugin_basename(__FILE__));
 }




 require_once(TSF_MULTISTEP_CHECKOUT_PATH . '/includes/tsf-defaults.php');
 require_once(TSF_MULTISTEP_CHECKOUT_PATH . '/includes/tsf-admin.php');
 require_once(TSF_MULTISTEP_CHECKOUT_PATH . '/includes/tsf-shortcode.php');



function tsf_multistep_checkout_activate()
{
    if (!is_plugin_active('woocommerce/woocommerce.php')) {
        // deactivate dependent plugin
        deactivate_plugins(TSF_MULTISTEP_CHECKOUT_PLUGIN_SLUG);

        exit('<strong>Multistep Checkout for WooCommerce</strong> requires <a target="_blank" href="http://wordpress.org/plugins/woocommerce/">WooCommerce</a> Plugin to be installed first.');
    } else {
      /**
      * default option for plugin
      * source : includes/tsf-defaults.php
      */
       tsf_multistep_checkout_restore_defaults();
    }
}

register_activation_hook(TSF_MULTISTEP_CHECKOUT_FILE, 'tsf_multistep_checkout_activate');


load_plugin_textdomain('woocommerce-multistep-checkout', false, dirname(TSF_MULTISTEP_CHECKOUT_PLUGIN_SLUG) . '/languages/');

add_filter('woocommerce_locate_template', 'tsf_multistep_checkout_locate_template', 1, 3);

function tsf_multistep_checkout_locate_template($template, $template_name, $plugin_path)
{

    $plugin_path = untrailingslashit(TSF_MULTISTEP_CHECKOUT_PATH) . '/woocommerce/';
    if (file_exists($plugin_path . $template_name)) {
        $template = $plugin_path . $template_name;
        return $template;
    }

    return $template;
}
