<?php
/**
 * phpBB Compact Forum Stats Extension
 *
 * @copyright (c) 2026 phpBB SEO <https://www.phpbbseo.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace phpbbseo\compactforumstats\acp;

class main_info
{
	public function module()
	{
		return [
			'filename' => '\phpbbseo\compactforumstats\acp\main_module',
			'title'    => 'ACP_COMPACTSTATS_TITLE',
			'modes'    => [
				'settings' => [
					'title' => 'ACP_COMPACTSTATS_SETTINGS',
					'auth'  => 'ext_phpbbseo/compactforumstats && acl_a_board',
					'cat'   => ['ACP_COMPACTSTATS_TITLE'],
				],
			],
		];
	}
}
