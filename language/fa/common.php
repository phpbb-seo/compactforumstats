<?php
/**
 * phpBB Compact Forum Stats Extension
 *
 * @copyright (c) 2026 phpBB SEO <https://www.phpbbseo.com>
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
	'CSTATS_THOUSAND' => 'هزار',
	'CSTATS_MILLION'  => 'میلیون',
	'CSTATS_BILLION'  => 'میلیارد',
]);
