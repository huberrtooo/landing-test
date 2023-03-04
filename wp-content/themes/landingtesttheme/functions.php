<?php

// dynamic adding .css and .js to head
function scripts()
{
	$dirJS = new DirectoryIterator(get_stylesheet_directory() . '/dist');
	foreach ($dirJS as $file) {
		if (pathinfo($file, PATHINFO_EXTENSION) === 'css') {
			$cssName = basename($file);

			wp_enqueue_style('style', get_template_directory_uri() . '/dist/' . $cssName, null, null, 'all');
		}
		if (pathinfo($file, PATHINFO_EXTENSION) === 'js') {
			$jsName = basename($file);
			$name = substr(basename($jsName), 0, strpos(basename($jsName), '.'));
			switch ($name) {
				case 'main':
					$deps = array('vendor');
					break;
				default:
					$deps = array('jquery');
					break;
			}
			wp_enqueue_script($name, get_template_directory_uri() . '/dist/' . $jsName, $deps, '1.0', true);
		}
	}
}
add_action('wp_enqueue_scripts', 'scripts');



// theme support
function config_custom_theme()
{
	add_theme_support('post-thumbnails');
	add_post_type_support('page', 'excerpt');
	add_theme_support('custom-logo');
	add_theme_support('widgets');
	add_theme_support('widgets-block-editor');
	add_theme_support('woocommerce', [
		'thumbnail_image_width' => 300,
		'gallery_thumbnail_image_width' => 100,
		'single_image_width' => 500,
	]);
}
add_action('after_setup_theme', 'config_custom_theme');



// register menu
register_nav_menus([
	'header-menu' => __('Menu główne'),
	'footer-menu' => __('Menu w stopce'),
	'offer-menu' => __('Menu z ofertą'),
]);


// bootstrap 5 wp_nav_menu walker
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
	private $current_item;
	private $dropdown_menu_alignment_values = [
		'dropdown-menu-start',
		'dropdown-menu-end',
		'dropdown-menu-sm-start',
		'dropdown-menu-sm-end',
		'dropdown-menu-md-start',
		'dropdown-menu-md-end',
		'dropdown-menu-lg-start',
		'dropdown-menu-lg-end',
		'dropdown-menu-xl-start',
		'dropdown-menu-xl-end',
		'dropdown-menu-xxl-start',
		'dropdown-menu-xxl-end'
	];

	function start_lvl(&$output, $depth = 0, $args = null)
	{
		$dropdown_menu_class[] = '';
		foreach ($this->current_item->classes as $class) {
			if (in_array($class, $this->dropdown_menu_alignment_values)) {
				$dropdown_menu_class[] = $class;
			}
		}
		$indent = str_repeat("\t", $depth);
		$submenu = ($depth > 0) ? ' sub-menu' : '';
		$output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ", $dropdown_menu_class)) . " depth_$depth\">\n";
	}

	function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
	{
		$this->current_item = $item;

		$indent = ($depth) ? str_repeat("\t", $depth) : '';

		$li_attributes = '';
		$class_names = $value = '';

		$classes = empty($item->classes) ? array() : (array) $item->classes;

		$classes[] = ($args->walker->has_children) ? 'dropdown' : '';
		$classes[] = 'nav-item';
		$classes[] = 'nav-item-' . $item->ID;
		if ($depth && $args->walker->has_children) {
			$classes[] = 'dropdown-menu dropdown-menu-end';
		}

		$class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = ' class="' . esc_attr($class_names) . '"';

		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
		$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

		$output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

		$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

		$active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
		$nav_link_class = ($depth > 0) ? 'dropdown-item ' : 'nav-link ';
		$attributes .= ($args->walker->has_children) ? ' class="' . $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="' . $nav_link_class . $active_class . '"';

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}