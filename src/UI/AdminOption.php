<?php declare( strict_types=1 );

/**
 * Submenu from Group Blocks.
 *
 * @package   NickDavis\SubmenuGroupBlocks
 * @author    Nick Davis
 * @license   MIT
 * @link      https://nickdavis.net
 * @copyright 2022 Nick Davis
 */

namespace NickDavis\SubmenuGroupBlocks\UI;

use NickDavis\SubmenuGroupBlocks\Registerable;

final class AdminOption implements Registerable {

	public const SLUG = 'nd_submenu_group_blocks_enable';

	public function register(): void {
		add_action( 'acf/init', [ $this, 'register_page_sidebar_field' ] );
	}

	public function register_page_sidebar_field(): void {
		acf_add_local_field_group( array(
			'key'                   => 'group_' . self::SLUG,
			'title'                 => 'Submenu (Group Blocks)',
			'fields'                => array(
				array(
					'key'               => 'field_' . self::SLUG,
					'label'             => 'Enable?',
					'name'              => self::SLUG,
					'type'              => 'true_false',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'message'           => '',
					'default_value'     => 0,
					'ui'                => 1,
					'ui_on_text'        => '',
					'ui_off_text'       => '',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'page',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'side',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => '',
			'show_in_rest'          => 0,
		) );
	}

}
