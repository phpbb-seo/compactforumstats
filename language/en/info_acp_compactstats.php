<?php
/**
 * phpBB Compact Forum Stats Extension
 *
 * @copyright (c) 2026 Meis@M <info@phpbb-seo.ir>
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	'ACP_COMPACTSTATS_TITLE'            => 'Compact Forum Stats',
	'ACP_COMPACTSTATS_SETTINGS'         => 'Settings',
	'ACP_COMPACTSTATS_SETTINGS_EXPLAIN' => 'Configure compact and shorthand formatting for large numbers, statistics, and counters across your forum (e.g. 22.3K instead of 22345).',
	'ACP_COMPACTSTATS_SAVED'            => 'Compact forum stats settings have been successfully updated.',

	// General
	'ACP_COMPACTSTATS_GENERAL_SETTINGS'     => 'General Formatting Settings',
	'ACP_COMPACTSTATS_ENABLE'               => 'Enable compact numbers',
	'ACP_COMPACTSTATS_ENABLE_EXPLAIN'       => 'Master toggle to enable or disable compact number formatting across the entire board.',
	'ACP_COMPACTSTATS_THRESHOLD'            => 'Formatting threshold',
	'ACP_COMPACTSTATS_THRESHOLD_EXPLAIN'    => 'Minimum number value to start formatting (e.g. 1000). Numbers below this threshold will remain in standard format.',
	'ACP_COMPACTSTATS_DECIMALS'             => 'Decimal precision',
	'ACP_COMPACTSTATS_DECIMALS_EXPLAIN'     => 'Number of decimal places to show for shortened numbers.',
	'ACP_COMPACTSTATS_DECIMAL_0_EX'         => 'e.g. 22K',
	'ACP_COMPACTSTATS_DECIMAL_1_EX'         => 'e.g. 22.3K',
	'ACP_COMPACTSTATS_DECIMAL_2_EX'         => 'e.g. 22.34K',
	'ACP_COMPACTSTATS_SUFFIX_STYLE'         => 'Suffix style',
	'ACP_COMPACTSTATS_SUFFIX_STYLE_EXPLAIN' => 'Choose whether to use international shorthand symbols or localized words.',
	'ACP_COMPACTSTATS_SUFFIX_SHORT'         => 'International (K, M, B)',
	'ACP_COMPACTSTATS_SUFFIX_FA'            => 'Persian words (هزار, میلیون, میلیارد)',
	'ACP_COMPACTSTATS_SUFFIX_LOCALE'        => 'Language localized (e.g. Thousand, Million)',
	'ACP_COMPACTSTATS_TOOLTIP'              => 'Show exact count on hover',
	'ACP_COMPACTSTATS_TOOLTIP_EXPLAIN'      => 'Displays the exact, full number as a tooltip when a user hovers the cursor over a shortened number.',

	// Locations
	'ACP_COMPACTSTATS_LOCATIONS'                  => 'Sections & Locations',
	'ACP_COMPACTSTATS_FORUMLIST_TOPICS'           => 'Forumlist topics',
	'ACP_COMPACTSTATS_FORUMLIST_TOPICS_EXPLAIN'   => 'Format topic counters in the forum list on index and subforum pages.',
	'ACP_COMPACTSTATS_FORUMLIST_POSTS'            => 'Forumlist posts',
	'ACP_COMPACTSTATS_FORUMLIST_POSTS_EXPLAIN'    => 'Format post counters in the forum list on index and subforum pages.',
	'ACP_COMPACTSTATS_FORUMLIST_CLICKS'           => 'Forumlist link clicks',
	'ACP_COMPACTSTATS_FORUMLIST_CLICKS_EXPLAIN'   => 'Format link redirect click counts in the forum list.',
	'ACP_COMPACTSTATS_BOARD_STATS'                => 'Board index statistics',
	'ACP_COMPACTSTATS_BOARD_STATS_EXPLAIN'        => 'Format total board posts, topics, users, and online record at the bottom of the index page.',
	'ACP_COMPACTSTATS_VIEWFORUM_VIEWS'            => 'Viewforum topic views',
	'ACP_COMPACTSTATS_VIEWFORUM_VIEWS_EXPLAIN'    => 'Format topic view counters in forum topics list.',
	'ACP_COMPACTSTATS_VIEWFORUM_REPLIES'          => 'Viewforum topic replies',
	'ACP_COMPACTSTATS_VIEWFORUM_REPLIES_EXPLAIN'  => 'Format topic reply counters in forum topics list.',
	'ACP_COMPACTSTATS_POSTER_POSTS'               => 'Post author posts count',
	'ACP_COMPACTSTATS_POSTER_POSTS_EXPLAIN'       => 'Format user post counts displayed in mini-profiles next to topic posts.',
	'ACP_COMPACTSTATS_MEMBER_POSTS'               => 'Member profile & memberlist',
	'ACP_COMPACTSTATS_MEMBER_POSTS_EXPLAIN'       => 'Format user post counts on member profile pages and memberlist tables.',
	'ACP_COMPACTSTATS_SEARCH_STATS'               => 'Search results statistics',
	'ACP_COMPACTSTATS_SEARCH_STATS_EXPLAIN'       => 'Format topic views and replies in search results.',
]);
