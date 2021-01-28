<?php

require_once 'class' . DIRECTORY_SEPARATOR . 'AD_Shipping_type.php';

add_filter('woocommerce_shipping_methods', function($methods) {
    $methods['local_pickup'] = 'AD_Shipping_type';
    return $methods;
});

add_filter( 'woocommerce_shipping_package_name', function() {
    return 'Point de retrait';
    // value: modifier expedition (espace admin woocommerce)
});

add_filter ( 'woocommerce_account_menu_items', function() {
    return [
        'orders'             => __( 'Orders', 'woocommerce' ),
        'edit-address'       => __( 'Addresses', 'woocommerce' ),
        'edit-account'    	=> __( 'Account Details', 'woocommerce' ),
        'customer-logout'    => __( 'Logout', 'woocommerce' ),
    ];

    // modifier lien menu (mon compte) vers la page commande (liens personnaliser)
});