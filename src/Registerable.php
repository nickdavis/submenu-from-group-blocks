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

namespace NickDavis\SubmenuGroupBlocks;

interface Registerable {
	public function register(): void;
}
