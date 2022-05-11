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

namespace NickDavis\SubmenuGroupBlocks\Application;

final class MenuGenerator {

	/**
	 * Parses the Post content for Group blocks with ID attribute set and
	 * returns an array of title and IDs.
	 *
	 * @return array
	 */
	public function generate(): array {
		global $post;

		$blocks     = parse_blocks( $post->post_content );
		$menu_items = [];

		foreach ( $blocks as $block ) {

			if ( 'core/group' === $block['blockName'] ) {

				$menu_items = $this->set_menu_items_from_block( $block, $menu_items );

			} else {

				foreach ( $block['innerBlocks'] as $second_level_block ) {

					if ( 'core/group' !== $second_level_block['blockName'] ) {
						continue;
					}

					$menu_items = $this->set_menu_items_from_block( $second_level_block, $menu_items );
				}

			}

		}

		return $menu_items;
	}

	private function set_menu_items_from_block( array $block, array $menu_items ): array {
		preg_match( '/id="([^"]*)"/', $block['innerHTML'], $ids );

		if ( isset( $ids[1] ) ) {
			$menu_items[] = [
				'title' => ucwords( str_replace( [ '-', 'section ' ], [ ' ', '' ], $ids[1] ) ),
				'id'    => $ids[1],
			];
		}

		return $menu_items;
	}

}
