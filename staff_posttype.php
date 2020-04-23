<?php
/**
 * Plugin Name: Меню сотрудников
 * Description: Описание плагина (140 символов)
 * Plugin URI:  Ссылка на инфо о плагине
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


add_action( 'init', 'post_type_staff_register' );
add_action( 'init', 'taxonomy_catstaff_register' );
add_action( 'admin_init', 'add_custom_taxonomy' );
//lab_assist
//teacher
function taxonomy_catstaff_register() {
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
