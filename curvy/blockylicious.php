<?php

/**
 * Plugin Name:       Blockylicious
 * Description:       A plugin of funky blocks.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Raul Cano
 * Author URI:		  https://raulcano.dev
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       blockylicious
 *
 * @package CreateBlock
 */


/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */


namespace WebDevEducation;

if (!defined('ABSPATH')) {
	die('Silence is golden.');
}

final class Blockylicious
{
	static function init()
	{
		add_action('enqueue_block_assets', function () {
			$style_url = plugins_url('build/style-index.css', __FILE__);
			wp_enqueue_style('blockylicious-style', $style_url, array());
		});
		add_action('enqueue_block_assets', function () {
			wp_enqueue_style('dashicons');
		});
		add_action('init', function () {
			add_filter('block_categories_all', function ($categories) {
				// Agregar la categoría personalizada al principio del array
				array_unshift($categories, [
					'slug' => 'blockylicious',
					'title' => 'Blockylicious'
				]);
				return $categories;
			});
			register_block_type(__DIR__ . '/build/blocks/curvy');
			register_block_type(__DIR__ . '/build/blocks/clickyGroup');
			register_block_type(__DIR__ . '/build/blocks/clickyButton');
			register_block_type(__DIR__ . '/build/blocks/piccyGallery');
			register_block_type(__DIR__ . '/build/blocks/piccyImage');
			// Esto de abajo es para poder hacer el subrayado
			$script_url = plugins_url('build/index.js', __FILE__);
			wp_enqueue_script('blockylicious-index', $script_url, ['wp-blocks', 'wp-element', 'wp-editor']);

			$style_url = plugins_url('build/style-index.css', __FILE__);
			wp_enqueue_style('blockylicious-style', $style_url, array());
		});
	}

	static function convert_custom_properties($value)
	{
		$prefix     = 'var:';
		$prefix_len = strlen($prefix);
		$token_in   = '|';
		$token_out  = '--';
		if (str_starts_with($value, $prefix)) {
			$unwrapped_name = str_replace(
				$token_in,
				$token_out,
				substr($value, $prefix_len)
			);
			$value          = "var(--wp--$unwrapped_name)";
		}

		return $value;
	}
}

// Inicializar la clase después de la declaración del espacio de nombres
Blockylicious::init();
