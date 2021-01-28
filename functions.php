<?php

require_once 'class' . DIRECTORY_SEPARATOR . 'AD_Shipping_type.php';

add_filter('woocommerce_shipping_methods', function($methods) {
    $methods['local_pickup'] = 'AD_Shipping_type';
    return $methods;
});

add_filter( 'woocommerce_shipping_package_name', function() {
    return 'Point de retrait';
});
