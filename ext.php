<?php
/**
 * phpBB Compact Forum Stats Extension
 *
 * @copyright (c) 2026 Meis@M <info@phpbb-seo.ir>
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace phpbbseo\compactforumstats;

class ext extends \phpbb\extension\base
{
	/**
	 * Check whether the extension can be enabled
	 *
	 * @return bool
	 */
	public function is_enableable()
	{
		return phpbb_version_compare(PHPBB_VERSION, '3.3.0', '>=');
	}
}
