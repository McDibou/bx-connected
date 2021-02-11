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

// Ajouter Methode de payement + images footer `colonne 3

function storefront_post_header()
{
    ?>
	<header class="entry-header">
<?php

    /**
     * Fonction associée à l'action de storefront_post_header_before.
     * Elle permet de ne pas afficher le titre sur la page d'accueil
     * Elle remplace la fonction storefront_post_header se trouvant dans wp-content/themes/storefront/inc/storefront-template-functions.php
     */
    do_action('storefront_post_header_before');
    //si c'est une simple page alors insertion de the_title
    if (is_single()) {
        the_title('<h1 class="entry-title">', '</h1>');
    } else {
        //si ce n'est pas la page d'accueil, alors insertion des titres sur les autres pages
        if (!is_front_page()) {

            the_title(sprintf('<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
        }
    }
    if (is_front_page()) {
        the_title('<h1>Bonjour</h1>');
    }
    do_action('storefront_post_header_after');
    ?>
	</header><!-- .entry-header -->
<?php
}
add_action('storefront_loop_before', 'storefront_post_header');

//fonction pour ajouter lire la suite sur un article sur la page d'accueil
function new_excerpt_more($more)
{
    global $post;
    return '<a class="moretag" href="' . get_permalink($post->ID) . '"> lire la suite</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

