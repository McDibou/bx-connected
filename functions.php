<?php

// inclus la class AD_Shipping_type.php
require_once 'class' . DIRECTORY_SEPARATOR . 'AD_Shipping_type.php';

// change les valeurs du type de livraison
add_filter('woocommerce_shipping_methods', function ($methods) {
    $methods['local_pickup'] = 'AD_Shipping_type';
    return $methods;
});

// change le label 'Expedition' -> page 'Panier/Commande'
add_filter('woocommerce_shipping_package_name', function () {
    return 'Point de retrait';
    // value: modifier expedition (espace admin woocommerce)
}, 10, 3);

// change le label 'Expedition' -> page 'Validation de Commande/Déails de la commance'
add_filter('woocommerce_get_order_item_totals', function ($total_rows) {
    $total_rows['shipping']['label'] = __('Point de retrait:', 'woocommerce'); // The row shipping label
    $total_rows['payment_method']['label'] = 'Paiement:';
    return $total_rows;
}, 10, 3);

// vide la variable 'Expedition' -> page 'Panier'
add_filter('woocommerce_shipping_packages', function ($packages) {
    $packages[0]['destination'] = [];
    return $packages;
});

// supprimer l'html 'lieu de livraison' -> page 'Panier'
add_filter('woocommerce_shipping_estimate_html', function () {
    return null;
});

// retourne le menu 'mon compte' / supprimer 'Téléchargement & Tableau de bord'
add_filter('woocommerce_account_menu_items', function () {
    return [
        'orders' => __('Orders', 'woocommerce'),
        'edit-address' => __('Addresses', 'woocommerce'),
        'edit-account' => __('Détails du compte', 'woocommerce'),
        'customer-logout' => __('Logout', 'woocommerce'),
    ];
    // modifier lien menu (mon compte) vers la page commande (liens personnaliser)
});
