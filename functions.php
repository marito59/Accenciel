<?php

	/*
	 * Fonction de base pour un child theme qui permet d'enregistrer le lien vers le thème parent
	 */
	function my_theme_enqueue_styles() {

		$parent_style = 'avada-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'child-style',
			get_stylesheet_directory_uri() . '/style.css',
			array( $parent_style ),
			wp_get_theme()->get('Version')
		);
	}
	add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

	function my_child_theme_setup() {
		// load translation file for the child theme
		load_child_theme_textdomain( 'Avada', get_stylesheet_directory() . '/languages' );
	}
	add_action( 'after_setup_theme', 'my_child_theme_setup' );

	/**
	 * Filter the "read more" excerpt string link to the post.
	 *
	 * @param string $more "Read more" excerpt string.
	 * @return string (Maybe) modified "read more" excerpt string.
	 */
	 function my_custom_excerpt_more( $more ) {
		return sprintf( '<br /><p><a class="read-more" href="%1$s">%2$s</a></p>',
			get_permalink( get_the_ID() ),
			__( 'Read More', 'Avada' )
		);
	}
	add_filter( 'excerpt_more', 'my_custom_excerpt_more' ); // pour the_excerpt (extrait créé automatiquement)
	add_filter( 'the_content_more_link', 'my_custom_excerpt_more' ); // pour the_content (extrait créé avec le more tag)

	?>