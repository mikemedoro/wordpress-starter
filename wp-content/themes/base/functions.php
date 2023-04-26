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
 * Just set this value to true
 */
Timber::$autoescape = false;

/**
 * Configure the theme inside of a subclass of Timber\Site
 */
class BaseTheme extends Timber\Site {
  /** Add timber support */
	public function __construct() {
    add_filter( 'timber/context', array( $this, 'add_to_context' ) );
    add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );

    add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    add_action( 'init', array( $this, 'remove_tag_taxonomy' ) );
    add_action( 'init', array( $this, 'admin_login_customizations' ) );
    add_action( 'wp_before_admin_bar_render', array( $this, 'admin_bar_render' ) );
    add_action( 'admin_menu', array( $this, 'admin_menu_render' ), 999 );
    add_action( 'admin_init', array( $this, 'remove_comments' ) );
    add_action( 'admin_init', array( $this, 'tinymce_customizations' ) );
    add_action( 'admin_init', array( $this, 'yoast_settings' ) );
    add_action( 'acf/init', array( $this, 'acf_settings' ) );
    add_action( 'wp', array( $this, 'helpers' ) );

    parent::__construct();
  }

  public function theme_supports() {
    require get_template_directory() . '/includes/setup.php';
  }

  /** Setup scripts and styles */
  public function enqueue_scripts() {
    require get_template_directory() . '/includes/enqueue.php';
  }

  /** Admin login page custimizations */
  public function admin_login_customizations() {
    require get_template_directory() . '/includes/admin.php';
  }

  /** ACF settings */
  public function acf_settings() {
    // define( 'ACF_PRO_LICENSE', 'XXXXXXXXXXXXXXXXXXXXXXX' );
    // define( 'ACFE_PRO_KEY', 'XXXXXXXXXXXXXXXXXXXXXXX' );
    require get_template_directory() . '/includes/acf.php';
    require get_template_directory() . '/includes/acfe.php';
  }

  /** Removes items from admin bar */
  public function admin_bar_render() {
    global $wp_admin_bar;
    // $wp_admin_bar->remove_menu( 'wp-logo' );
    $wp_admin_bar->remove_menu( 'updates' );
    $wp_admin_bar->remove_menu( 'new-content' );
    $wp_admin_bar->remove_menu( 'comments' );
	}

  /** Remove pages from admin menu */
  public function admin_menu_render() {
    remove_menu_page( 'edit-comments.php' );
    remove_submenu_page( 'themes.php', 'theme-editor.php' );
    remove_submenu_page( 'plugins.php', 'plugin-editor.php' );

    $current_user = wp_get_current_user();

    if( $current_user->user_nicename != 'admin' ) {
      remove_menu_page( 'plugins.php' );
    }
	}

  /** Disable auto update notification emails for plugins */
  public function disable_plugin_email() {
    add_filter( 'auto_plugin_update_send_email', '__return_false' );
  }

  /** Remove comment functionality for all post types */
  public function remove_comments() {
    $post_types = get_post_types();

    foreach ( $post_types as $post_type ) {
      if( post_type_supports( $post_type, 'comments' ) ) {
        remove_post_type_support( $post_type, 'comments' );
        remove_post_type_support( $post_type, 'trackbacks' );
      }
    }
  }

  /** Remove tags from posts */
  public function remove_tag_taxonomy() {
    unregister_taxonomy_for_object_type( 'post_tag', 'post' );
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

    $twig->addFilter( new Timber\Twig_Filter( 'get_svg_text', function ( $path ) {
      return file_get_contents( $path );
		} ) );

    return $twig;
  }

  /** TinyMCE custimizations */
  public function tinymce_customizations() {
    require get_template_directory() . '/includes/tinymce.php';
  }

  /** Yoast settings */
  public function yoast_settings() {
    require get_template_directory() . '/includes/yoast.php';
  }

  /** Additonal helper functions */
  public function helpers() {
    require get_template_directory() . '/includes/helpers.php';
  }
}

new BaseTheme();
