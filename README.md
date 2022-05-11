# Submenu from Group Blocks

WordPress plugin which generates a submenu from Group block ID attributes in the WordPress block editor. Requires developer setup.

## Usage

In the block editor, add an ID attribute to the Group block you want to add to your submenu, via the HTML anchor field under the Advanced section of the Block side panel.

The ID attribute will then be passed to a submenu view as both a title and as an ID. So, for example, an HTML anchor of `Special-Offers` would give you a title of `Special Offers` and an ID attribute of the same (`Special-Offers`).

Finally, for non block themes*, you will need to place the submenu where you want it in your theme by adding `<?php do_action( 'submenu_group_blocks' ); ?>` at the appropriate location and then adding a view for the submenu at `partials/submenu-group-blocks.php`.

*Block theme support coming soon 🤞.
