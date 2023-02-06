<?php

/*------------------------------------------------------------------------
Setup theme functions
------------------------------------------------------------------------*/

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
	});

	add_filter( 'template_include', function( $template ) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});

	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'views', 'templates' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;

/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */

class BaseTheme extends Timber\Site {
	/** Add timber support */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
        add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
        add_action( 'init', array( $this, 'register_taxonomies' ) );
        add_action( 'acf/init', array( $this, 'acf_settings' ) );
        add_action( 'init', array( $this, 'additional_settings' ) );

		parent::__construct();
    }

    public function theme_supports() {
        require get_template_directory() . '/includes/setup.php';
    }

	/** Setup scripts and styles */
	public function enqueue_scripts() {
        require get_template_directory() . '/includes/enqueue.php';
	}

	/** Register custom post types */
	public function register_post_types() {
        require get_template_directory() . '/includes/post-types.php';
    }

	/** Register custom taxonomies */
	public function register_taxonomies() {
        require get_template_directory() . '/includes/taxonomies.php';
    }

    /** ACF settings */
    public function acf_settings() {
        // define( 'ACF_PRO_LICENSE', 'XXXXXXXXXXXXXXXXXXXXXXX' );
        // define( 'ACFE_PRO_KEY', 'XXXXXXXXXXXXXXXXXXXXXXX' );
        require get_template_directory() . '/includes/acf.php';
        require get_template_directory() . '/includes/acfe.php';
    }

    /** Additonal settings and functions */
	public function additional_settings() {
		require get_template_directory() . '/includes/admin.php';
		require get_template_directory() . '/includes/shortcodes.php';
        require get_template_directory() . '/includes/helpers.php';
        require get_template_directory() . '/includes/yoast.php';
	}

    /** Customize flexible field logic */
	public function flexible_field_logic() {
		$flex_fields = get_field('flexible_content');
		if( $flex_fields ) {
			foreach( $flex_fields as $i => $flex_item ) {
				switch ( $flex_item['acf_fc_layout'] ) {
                    case 'video':
                    default:
				}
				$flex_fields[$i] = $flex_item;
			}
		}
		return $flex_fields;
	}

	/* Add to context */
	public function add_to_context( $context ) {
		$context['primary_menu'] = new \Timber\Menu( 'primary-menu' );
        $context['footer_menu'] = new \Timber\Menu( 'footer-menu' );

        $context['is_404'] = is_404();
        $context['is_home'] = is_page( array( 'home' ) );
        $context['is_archive'] = is_archive();
        $context['is_post'] = is_singular( array( 'post' ) );

        $context['options'] = get_fields('option');
        $context['flex_fields'] = $this->flexible_field_logic();

        require get_template_directory() . '/includes/context-logic.php';

        $context['site'] = $this;

		return $context;
    }

	/** Add custom functions to twig
	 *
	 * @param string $twig get extension
	 */
	public function add_to_twig( $twig ) {
		$twig->addExtension( new Twig_Extension_StringLoader() );
		return $twig;
	}
}

new BaseTheme();
