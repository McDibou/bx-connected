<?php

class AD_Shipping_type extends WC_Shipping_Method
{

    public function __construct($instance_id = 0)
    {
        $this->id = 'local_pickup';
        $this->instance_id = absint($instance_id);
        $this->method_title = __('Retrait en magasin', 'woocommerce');
        $this->method_description = __('Permettre aux clients de retirer eux mêmes leurs commandes.', 'woocommerce');
        $this->supports = array(
            'shipping-zones',
            'instance-settings',
            'instance-settings-modal',
        );
        $this->init();
    }

    public function init()
    {

        $this->init_form_fields();
        $this->init_settings();

        $this->title = $this->get_option('title');
        $this->tax_status = $this->get_option('tax_status');
        $this->cost = $this->get_option('cost');

        add_action('woocommerce_update_options_shipping_' . $this->id, array($this, 'process_admin_options'));
    }

    public function calculate_shipping($package = array())
    {
        $this->add_rate(
            array(
                'label' => $this->title,
                'package' => $package,
                'cost' => $this->cost,
            )
        );
    }

    public function init_form_fields()
    {
        $this->instance_form_fields = array(
            'title' => array(
                'title' => __('Adresse Postal', 'woocommerce'),
                'type' => 'text',
                'description' => __('This controls the title which the user sees during checkout.', 'woocommerce'),
                'default' => __('Local pickup', 'woocommerce'),
                'desc_tip' => true,
            ),
            'tax_status' => array(
                'title' => __('Tax status', 'woocommerce'),
                'type' => 'select',
                'class' => 'wc-enhanced-select',
                'default' => 'taxable',
                'options' => array(
                    'none' => _x('None', 'Tax status', 'woocommerce'),
                ),
            ),
        );
    }
}
