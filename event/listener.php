<?php
/**
 * phpBB Compact Forum Stats Extension
 *
 * @copyright (c) 2026 Meis@M <info@phpbb-seo.ir>
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace phpbbseo\compactforumstats\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use phpbb\config\config;
use phpbb\template\template;
use phpbb\user;
use phpbbseo\compactforumstats\service\formatter;

class listener implements EventSubscriberInterface
{
	/** @var config */
	protected $config;

	/** @var template */
	protected $template;

	/** @var user */
	protected $user;

	/** @var formatter */
	protected $formatter;

	/**
	 * Constructor
	 *
	 * @param config    $config
	 * @param template  $template
	 * @param user      $user
	 * @param formatter $formatter
	 */
	public function __construct(config $config, template $template, user $user, formatter $formatter)
	{
		$this->config = $config;
		$this->template = $template;
		$this->user = $user;
		$this->formatter = $formatter;
	}

	/**
	 * Assign subscribed events
	 *
	 * @return array
	 */
	public static function getSubscribedEvents()
	{
		return [
			'core.page_header'                         => 'page_header',
			'core.display_forums_modify_template_vars' => 'display_forums_modify_template_vars',
			'core.index_modify_page_title'             => 'index_modify_page_title',
			'core.viewforum_modify_topicrow'           => 'viewforum_modify_topicrow',
			'core.viewforum_topic_row_after'           => 'viewforum_topic_row_after',
			'core.viewtopic_modify_post_row'           => 'viewtopic_modify_post_row',
			'core.memberlist_prepare_profile_data'     => 'memberlist_prepare_profile_data',
			'core.search_modify_tpl_ary'               => 'search_modify_tpl_ary',
		];
	}

	/**
	 * Inject common language file on page header
	 *
	 * @param object $event
	 */
	public function page_header($event)
	{
		if (!$this->formatter->is_enabled())
		{
			return;
		}

		$this->user->add_lang_ext('phpbbseo/compactforumstats', 'common');
	}

	/**
	 * Format Forumlist counts (Topics, Posts, Clicks)
	 *
	 * @param object $event
	 */
	public function display_forums_modify_template_vars($event)
	{
		if (!$this->formatter->is_enabled())
		{
			return;
		}

		$forum_row = $event['forum_row'];

		if (!empty($this->config['cstats_forumlist_topics']) && isset($forum_row['TOPICS']))
		{
			$forum_row['TOPICS'] = $this->formatter->format($forum_row['TOPICS']);
		}

		if (!empty($this->config['cstats_forumlist_posts']) && isset($forum_row['POSTS']))
		{
			$forum_row['POSTS'] = $this->formatter->format($forum_row['POSTS']);
		}

		if (!empty($this->config['cstats_forumlist_clicks']) && isset($forum_row['CLICKS']))
		{
			$forum_row['CLICKS'] = $this->formatter->format($forum_row['CLICKS']);
		}

		$event['forum_row'] = $forum_row;
	}

	/**
	 * Format Board Index Statistics (Total Posts, Topics, Users, Record)
	 *
	 * @param object $event
	 */
	public function index_modify_page_title($event)
	{
		if (!$this->formatter->is_enabled() || empty($this->config['cstats_board_stats']))
		{
			return;
		}

		$this->user->add_lang_ext('phpbbseo/compactforumstats', 'common');

		$updates = [];

		if (isset($this->config['num_posts']))
		{
			$orig_posts_lang = $this->user->lang('TOTAL_POSTS_COUNT', (int) $this->config['num_posts']);
			$updates['TOTAL_POSTS'] = $this->formatter->format_in_strong($orig_posts_lang, $this->config['num_posts']);
		}

		if (isset($this->config['num_topics']))
		{
			$orig_topics_lang = $this->user->lang('TOTAL_TOPICS', (int) $this->config['num_topics']);
			$updates['TOTAL_TOPICS'] = $this->formatter->format_in_strong($orig_topics_lang, $this->config['num_topics']);
		}

		if (isset($this->config['num_users']))
		{
			$orig_users_lang = $this->user->lang('TOTAL_USERS', (int) $this->config['num_users']);
			$updates['TOTAL_USERS'] = $this->formatter->format_in_strong($orig_users_lang, $this->config['num_users']);
		}

		if (isset($this->config['record_online_users']))
		{
			$formatted_record = $this->formatter->format($this->config['record_online_users'], true);
			$orig_record_lang = sprintf($this->user->lang['RECORD_ONLINE_USERS'], $this->config['record_online_users'], $this->user->format_date($this->config['record_online_date']));
			$updates['RECORD_USERS'] = preg_replace('/<strong>[^<]+<\/strong>/', '<strong>' . $formatted_record . '</strong>', $orig_record_lang);
		}

		if (!empty($updates))
		{
			$this->template->assign_vars($updates);
		}
	}

	/**
	 * Format Topic Views in Viewforum
	 *
	 * @param object $event
	 */
	public function viewforum_modify_topicrow($event)
	{
		if (!$this->formatter->is_enabled())
		{
			return;
		}

		$topic_row = $event['topic_row'];

		if (!empty($this->config['cstats_viewforum_views']) && isset($topic_row['VIEWS']))
		{
			$topic_row['VIEWS'] = $this->formatter->format($topic_row['VIEWS']);
		}

		$event['topic_row'] = $topic_row;
	}

	/**
	 * Safely format Topic Replies in Viewforum without disrupting pagination calculations
	 *
	 * @param object $event
	 */
	public function viewforum_topic_row_after($event)
	{
		if (!$this->formatter->is_enabled() || empty($this->config['cstats_viewforum_replies']))
		{
			return;
		}

		$row = $event['row'];
		$replies = isset($row['topic_posts_approved']) ? max(0, (int) $row['topic_posts_approved'] - 1) : 0;
		$formatted_replies = $this->formatter->format($replies);

		$this->template->alter_block_array('topicrow', [
			'REPLIES' => $formatted_replies,
		], true, 'change');
	}

	/**
	 * Format Poster's Post Count in Viewtopic mini-profile
	 *
	 * @param object $event
	 */
	public function viewtopic_modify_post_row($event)
	{
		if (!$this->formatter->is_enabled() || empty($this->config['cstats_poster_posts']))
		{
			return;
		}

		$post_row = $event['post_row'];
		if (isset($post_row['POSTER_POSTS']))
		{
			$post_row['POSTER_POSTS'] = $this->formatter->format($post_row['POSTER_POSTS']);
			$event['post_row'] = $post_row;
		}
	}

	/**
	 * Format Member Posts in Profile and Memberlist
	 *
	 * @param object $event
	 */
	public function memberlist_prepare_profile_data($event)
	{
		if (!$this->formatter->is_enabled() || empty($this->config['cstats_member_posts']))
		{
			return;
		}

		$template_data = $event['template_data'];
		if (isset($template_data['POSTS']))
		{
			$template_data['POSTS'] = $this->formatter->format($template_data['POSTS']);
			$event['template_data'] = $template_data;
		}
	}

	/**
	 * Format Search Results (Replies and Views)
	 *
	 * @param object $event
	 */
	public function search_modify_tpl_ary($event)
	{
		if (!$this->formatter->is_enabled() || empty($this->config['cstats_search_stats']))
		{
			return;
		}

		$tpl_ary = $event['tpl_ary'];

		if (isset($tpl_ary['TOPIC_REPLIES']))
		{
			$tpl_ary['TOPIC_REPLIES'] = $this->formatter->format($tpl_ary['TOPIC_REPLIES']);
		}

		if (isset($tpl_ary['TOPIC_VIEWS']))
		{
			$tpl_ary['TOPIC_VIEWS'] = $this->formatter->format($tpl_ary['TOPIC_VIEWS']);
		}

		$event['tpl_ary'] = $tpl_ary;
	}
}
