<?php
	function storefront_post_header() {
		?>
		<header class="entry-header">
		<?php

		/**
         * Fonction associée à l'action de storefront_post_header_before.
         * Elle permet de ne pas afficher le titre sur la page d'accueil
		 * Elle remplace la fonction storefront_post_header se trouvant dans la page storefront-template-functions.php
		 */
		do_action( 'storefront_post_header_before' );
        //si c'est une simple page alors insertion de the_title
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
            //si ce n'est pas la page d'accueil, alors insertion des titres sur les autres pages
			if (!is_front_page() ){
				
			the_title( sprintf( '<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			}		
		}

		do_action( 'storefront_post_header_after' );
		?>
		</header><!-- .entry-header -->
		<?php
	}   
		add_action('storefront_loop_before','storefront_post_header');

		$ad_article = new WP_Query([
			'post_type' => 'product',
			'orderby' => 'rand',
			'posts_per_page' => 3,
			'meta_key' => '_sale_price',
		]);
