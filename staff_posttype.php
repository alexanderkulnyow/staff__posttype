<?php
/**
 * Plugin Name: Меню сотрудников
 * Description: Описание плагина (140 символов)
 * Plugin URI:  https://github.com/alexanderkulnyow/staff__posttype
 * Author URI:  Ссылка на автора
 * Author:      alexander kulnyow
 *
 * Text Domain: ID перевода. Пр: my-plugin
 * Domain Path: Путь до MO файла (относительно папки плагина)
 *
 * Requires PHP: 5.4
 * Requires at least: 2.5
 *
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Network:     true - активирует плагин для всей сети
 * Version:     1.0
 */

/*
|--------------------------------------------------------------------------
| CONSTANTS
|--------------------------------------------------------------------------
*/

if( !defined( 'staff__posttype_BASE_FILE' ) )		define( 'staff__posttype_BASE_FILE', __FILE__ );
if( !defined( 'staff__posttype_BASE_DIR' ) ) 		define( 'staff__posttype_BASE_DIR', dirname( staff__posttype_BASE_FILE ) );
if( !defined( 'staff__posttype_PLUGIN_URL' ) ) 	define( 'staff__posttype_PLUGIN_URL', plugin_dir_url( __FILE__ ) );


function staff__posttype_scripts() {
	wp_enqueue_style( 'penus', staff__posttype_PLUGIN_URL . 'styles/style.css', array(), '1.0.0' );
//	wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'staff__posttype_scripts' );
/*
|--------------------------------------------------------------------------
| FILTERS
|--------------------------------------------------------------------------
*/
add_filter( 'init', 'post_type_staff_register' );
add_filter( 'init', 'taxonomy_tax_staff_register' );
add_filter( 'admin_init', 'add_custom_taxonomy' );
add_filter( 'template_include', 'staff__posttype_template_chooser');
/*
|--------------------------------------------------------------------------
| DEFINE THE CUSTOM TAXONOMY
|--------------------------------------------------------------------------
*/

/**
 * Setup staff Custom Taxonomy
 *
 * @since       1.0
 */

function taxonomy_tax_staff_register() {
	register_taxonomy( 'tax_staff', array( 'staff' ), [
		'label'             => '',
		'labels'            => [
			'name'               => 'Категория',
			'singular_name'      => 'Категория', // админ панель Добавить->Функцию
			'add_new'            => 'Добавить категорию',
			'add_new_item'       => 'Добавить новую категорию', // заголовок тега <title>
			'edit_item'          => 'Редактировать категорию',
			'new_item'           => 'Новая категория',
			'all_items'          => 'Все категории',
			'view_item'          => 'Просмотр категорий на сайте',
			'search_items'       => 'Искать категорию',
			'not_found'          => 'Категория не найдена.',
			'not_found_in_trash' => 'В корзине нет категорий',
			'menu_name'          => 'Категории' // ссылка в меню в админке
		],
		'description'       => '',
		'public'            => true,
		'hierarchical'      => true,
		'rewrite'           => true,
		'capabilities'      => array( '' ),
		'meta_box_cb'       => null,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rest_base'         => null,
	] );
}

/**
 * Add staff Custom Taxonomy
 *
 * @since       1.0
 */

function add_custom_taxonomy() {
	$cat_staff = array(
//		'cat_ID'               => 897,
		'cat_name'             => 'Преподавательский состав',
		'category_description' => 'Преподавательский состав',
		'category_nicename'    => 'teacher',
		'category_parent'      => '',
		'taxonomy'             => 'tax_staff'
	);
	wp_insert_category( $cat_staff );

	$lab_assist = array(
//		'cat_ID'               => 897,
		'cat_name'             => 'Лаборантский состав',
		'category_description' => 'Лаборантский состав',
		'category_nicename'    => 'lab_assist',
		'category_parent'      => '',
		'taxonomy'             => 'tax_staff'
	);
	wp_insert_category( $lab_assist );

}
/*
|--------------------------------------------------------------------------
| DEFINE THE CUSTOM POST TYPE
|--------------------------------------------------------------------------
*/

/**
 * Setup staff Custom Post Type
 *
 * @since       1.0
 */

function post_type_staff_register() {
	$labels = array(
		'name'               => 'Сотрудники',
		'singular_name'      => 'Сотрудник', // админ панель Добавить->Функцию
		'add_new'            => 'Добавить сотудника',
		'add_new_item'       => 'Добавить нового сотудника', // заголовок тега <title>
		'edit_item'          => 'Редактировать сотудника',
		'new_item'           => 'Новый сотудник',
		'all_items'          => 'Сотудники',
		'view_item'          => 'Просмотр сотудников на сайте',
		'search_items'       => 'Искать сотудника',
		'not_found'          => 'Сотудник не найдено.',
		'not_found_in_trash' => 'В корзине нет сотудников',
		'menu_name'          => 'Сотрудники' // ссылка в меню в админке
	);
	$args   = array(
		'labels'            => $labels,
		'rewrite'           => array( 'slug' => 'prepodavateli' ),
		'public'            => true, // благодаря этому некоторые параметры можно пропустить
		'show_in_nav_menus' => true,
		'show_in_rest'      => true,
		'rest_base'         => null,
		'menu_icon'         => 'dashicons-businessman',
		'menu_position'     => 5,
		'has_archive'       => true,
		'supports'          => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'tax_staff' ),
		'taxonomies'        => array( 'tax_staff' )
	);
	register_post_type( 'staff', $args );
}

/*
|--------------------------------------------------------------------------
| PLUGIN FUNCTIONS
|--------------------------------------------------------------------------
*/

/**
 * Returns template file
 *
 * @since       1.0
 */

function staff__posttype_template_chooser($template) {
	// Post ID
	$post_id = get_the_ID();
	// For all other CPT
	if( get_post_type( $post_id ) != 'staff' ) {
		return $template;
	} else {
		if ( is_archive() ) {
//		staff__posttype_PLUGIN_URL . 'includes/templates/archive-staff.php';
			return staff__posttype_get_template_hierarchy('archive-staff');
		}
		elseif ( is_single() ) {
			return staff__posttype_get_template_hierarchy('single-staff');
		}
		else {
			return null;
		}
	}
}

/**
 * Get the custom template if is set
 *
 * @since       1.0
 */

function staff__posttype_get_template_hierarchy( $template ) {

	// Get the template slug
	$template_slug = rtrim($template, '.php');
	$template      = $template_slug . '.php';

	// Check if a custom template exists in the theme folder, if not, load the plugin template file
	if ( $theme_file = locate_template(array('plugin_template/'.$template)) ) {
		$file = $theme_file;
	}
	else {
		$file = staff__posttype_BASE_DIR . '/includes/templates/' . $template;
	}

	return apply_filters( 'staff__posttype_repl_template_'.$template, $file);
}
