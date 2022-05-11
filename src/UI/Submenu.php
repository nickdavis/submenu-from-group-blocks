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

use BrightNucleus\Views;
use NickDavis\SubmenuGroupBlocks\Application\MenuGenerator;
use NickDavis\SubmenuGroupBlocks\Registerable;

final class Submenu implements Registerable {

	public function register(): void {
		add_action( 'submenu_group_blocks', [ $this, 'render' ] );
	}

	public function render(): void {
		$is_enabled = (bool) get_post_meta( get_the_ID(), AdminOption::SLUG, true );

		if ( ! $is_enabled ) {
			return;
		}

		if ( empty( $this->get_menu() ) ) {
			return;
		}

		echo Views::render( 'submenu-group-blocks', [ 'menu' => $this->get_menu() ] );
	}

	private function get_menu(): array {
		return ( new MenuGenerator() )->generate();
	}

}
