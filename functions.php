<?php
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