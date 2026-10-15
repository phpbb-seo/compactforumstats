<?php
/**
 * phpBB Compact Forum Stats Extension
 *
 * @copyright (c) 2026 phpBB SEO <https://www.phpbbseo.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace phpbbseo\compactforumstats\acp;

class main_module
{
	public $u_action;
	public $tpl_name;
	public $page_title;

	public function main($id, $mode)
	{
		global $config, $request, $template, $user;

		$user->add_lang_ext('phpbbseo/compactforumstats', 'info_acp_compactstats');

		$this->tpl_name = 'acp_compactstats';
		$this->page_title = $user->lang('ACP_COMPACTSTATS_TITLE');

		add_form_key('acp_compactstats_settings');

		if ($request->is_set_post('submit'))
		{
			if (!check_form_key('acp_compactstats_settings'))
			{
				trigger_error($user->lang('FORM_INVALID'), E_USER_WARNING);
			}

			// General settings
			$cstats_enable       = $request->variable('cstats_enable', 0);
			$cstats_threshold    = max(0, $request->variable('cstats_threshold', 1000));
			$cstats_decimals     = max(0, min(3, $request->variable('cstats_decimals', 1)));
			$cstats_suffix_style = $request->variable('cstats_suffix_style', 'short');
			if (!in_array($cstats_suffix_style, ['short', 'fa', 'locale'], true))
			{
				$cstats_suffix_style = 'short';
			}
			$cstats_tooltip      = $request->variable('cstats_tooltip', 0);

			// Section toggles
			$cstats_forumlist_topics  = $request->variable('cstats_forumlist_topics', 0);
			$cstats_forumlist_posts   = $request->variable('cstats_forumlist_posts', 0);
			$cstats_forumlist_clicks  = $request->variable('cstats_forumlist_clicks', 0);
			$cstats_board_stats       = $request->variable('cstats_board_stats', 0);
			$cstats_viewforum_replies = $request->variable('cstats_viewforum_replies', 0);
			$cstats_viewforum_views   = $request->variable('cstats_viewforum_views', 0);
			$cstats_poster_posts      = $request->variable('cstats_poster_posts', 0);
			$cstats_member_posts      = $request->variable('cstats_member_posts', 0);
			$cstats_search_stats      = $request->variable('cstats_search_stats', 0);

			// Save to config
			$config->set('cstats_enable', $cstats_enable);
			$config->set('cstats_threshold', $cstats_threshold);
			$config->set('cstats_decimals', $cstats_decimals);
			$config->set('cstats_suffix_style', $cstats_suffix_style);
			$config->set('cstats_tooltip', $cstats_tooltip);

			$config->set('cstats_forumlist_topics', $cstats_forumlist_topics);
			$config->set('cstats_forumlist_posts', $cstats_forumlist_posts);
			$config->set('cstats_forumlist_clicks', $cstats_forumlist_clicks);
			$config->set('cstats_board_stats', $cstats_board_stats);
			$config->set('cstats_viewforum_replies', $cstats_viewforum_replies);
			$config->set('cstats_viewforum_views', $cstats_viewforum_views);
			$config->set('cstats_poster_posts', $cstats_poster_posts);
			$config->set('cstats_member_posts', $cstats_member_posts);
			$config->set('cstats_search_stats', $cstats_search_stats);

			trigger_error($user->lang('ACP_COMPACTSTATS_SAVED') . adm_back_link($this->u_action));
		}

		$template->assign_vars([
			'U_ACTION'                 => $this->u_action,

			// General
			'CSTATS_ENABLE'            => (bool) $config['cstats_enable'],
			'CSTATS_THRESHOLD'         => (int) $config['cstats_threshold'],
			'CSTATS_DECIMALS'          => (int) $config['cstats_decimals'],
			'CSTATS_SUFFIX_STYLE'      => (string) $config['cstats_suffix_style'],
			'CSTATS_TOOLTIP'           => (bool) $config['cstats_tooltip'],

			// Locations
			'CSTATS_FORUMLIST_TOPICS'  => (bool) $config['cstats_forumlist_topics'],
			'CSTATS_FORUMLIST_POSTS'   => (bool) $config['cstats_forumlist_posts'],
			'CSTATS_FORUMLIST_CLICKS'  => (bool) $config['cstats_forumlist_clicks'],
			'CSTATS_BOARD_STATS'       => (bool) $config['cstats_board_stats'],
			'CSTATS_VIEWFORUM_REPLIES' => (bool) $config['cstats_viewforum_replies'],
			'CSTATS_VIEWFORUM_VIEWS'   => (bool) $config['cstats_viewforum_views'],
			'CSTATS_POSTER_POSTS'      => (bool) $config['cstats_poster_posts'],
			'CSTATS_MEMBER_POSTS'      => (bool) $config['cstats_member_posts'],
			'CSTATS_SEARCH_STATS'      => (bool) $config['cstats_search_stats'],
		]);
	}
}
