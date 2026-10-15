<?php
/**
 * phpBB Compact Forum Stats Extension
 *
 * @copyright (c) 2026 Meis@M <info@phpbb-seo.ir>
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace phpbbseo\compactforumstats\migrations;

use phpbb\db\migration\migration;

class v100_initial extends migration
{
	/**
	 * Dependent migrations
	 *
	 * @return array
	 */
	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v330\v330'];
	}

	/**
	 * Add default configs and ACP modules
	 *
	 * @return array
	 */
	public function update_data()
	{
		return [
			// General settings
			['config.add', ['cstats_enable', 1]],
			['config.add', ['cstats_threshold', 1000]],
			['config.add', ['cstats_decimals', 1]],
			['config.add', ['cstats_suffix_style', 'short']],
			['config.add', ['cstats_tooltip', 1]],

			// Section toggles
			['config.add', ['cstats_forumlist_topics', 1]],
			['config.add', ['cstats_forumlist_posts', 1]],
			['config.add', ['cstats_forumlist_clicks', 1]],
			['config.add', ['cstats_board_stats', 1]],
			['config.add', ['cstats_viewforum_replies', 1]],
			['config.add', ['cstats_viewforum_views', 1]],
			['config.add', ['cstats_poster_posts', 1]],
			['config.add', ['cstats_member_posts', 1]],
			['config.add', ['cstats_search_stats', 1]],

			// ACP Module
			['module.add', [
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_COMPACTSTATS_TITLE',
			]],
			['module.add', [
				'acp',
				'ACP_COMPACTSTATS_TITLE',
				[
					'module_basename' => '\phpbbseo\compactforumstats\acp\main_module',
					'modes'           => ['settings'],
				],
			]],
		];
	}
}
