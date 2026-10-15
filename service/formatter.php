<?php
/**
 * phpBB Compact Forum Stats Extension
 *
 * @copyright (c) 2026 phpBB SEO <https://www.phpbbseo.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace phpbbseo\compactforumstats\service;

use phpbb\config\config;
use phpbb\user;

class formatter
{
	/** @var config */
	protected $config;

	/** @var user */
	protected $user;

	/**
	 * Constructor
	 *
	 * @param config $config
	 * @param user   $user
	 */
	public function __construct(config $config, user $user)
	{
		$this->config = $config;
		$this->user = $user;
	}

	/**
	 * Check if master switch is enabled
	 *
	 * @return bool
	 */
	public function is_enabled()
	{
		return !empty($this->config['cstats_enable']);
	}

	/**
	 * Format a given number into compact notation (e.g. 22.3K)
	 *
	 * @param int|float|string $number  Raw number
	 * @param bool             $as_html Whether to wrap in tooltip span
	 * @return string
	 */
	public function format($number, $as_html = true)
	{
		if (!$this->is_enabled())
		{
			return (string) $number;
		}

		// Extract raw numeric value if formatted string was passed
		$clean = is_string($number) ? preg_replace('/[^\d\.\-]/', '', $number) : $number;
		if (!is_numeric($clean))
		{
			return (string) $number;
		}

		$num = (float) $clean;
		$threshold = isset($this->config['cstats_threshold']) ? (int) $this->config['cstats_threshold'] : 1000;

		// If less than threshold, return original
		if (abs($num) < $threshold)
		{
			return (string) $number;
		}

		$decimals = isset($this->config['cstats_decimals']) ? (int) $this->config['cstats_decimals'] : 1;
		$suffix_style = isset($this->config['cstats_suffix_style']) ? $this->config['cstats_suffix_style'] : 'short';

		$divisor = 1;
		$suffix = '';

		if (abs($num) >= 1000000000)
		{
			$divisor = 1000000000;
			if ($suffix_style === 'fa')
			{
				$suffix = ' ' . 'میلیارد';
			}
			elseif ($suffix_style === 'locale')
			{
				$suffix = ' ' . $this->get_lang('CSTATS_BILLION', 'B');
			}
			else
			{
				$suffix = 'B';
			}
		}
		elseif (abs($num) >= 1000000)
		{
			$divisor = 1000000;
			if ($suffix_style === 'fa')
			{
				$suffix = ' ' . 'میلیون';
			}
			elseif ($suffix_style === 'locale')
			{
				$suffix = ' ' . $this->get_lang('CSTATS_MILLION', 'M');
			}
			else
			{
				$suffix = 'M';
			}
		}
		else
		{
			$divisor = 1000;
			if ($suffix_style === 'fa')
			{
				$suffix = ' ' . 'هزار';
			}
			elseif ($suffix_style === 'locale')
			{
				$suffix = ' ' . $this->get_lang('CSTATS_THOUSAND', 'K');
			}
			else
			{
				$suffix = 'K';
			}
		}

		$compact_val = $num / $divisor;
		$formatted_num = number_format($compact_val, $decimals, '.', '');

		// Trim trailing zeros from decimal (e.g., 10.0 -> 10, 10.50 -> 10.5)
		if (strpos($formatted_num, '.') !== false)
		{
			$formatted_num = rtrim(rtrim($formatted_num, '0'), '.');
		}

		$compact_text = $formatted_num . $suffix;

		// Wrap in tooltip HTML if enabled
		if ($as_html && !empty($this->config['cstats_tooltip']))
		{
			$exact = number_format($num, 0, '.', ',');
			return '<span class="cstats-compact" title="' . $exact . '" data-original="' . $exact . '">' . $compact_text . '</span>';
		}

		return $compact_text;
	}

	/**
	 * Replace number inside HTML tags like <strong>...</strong> in language strings
	 * (e.g. "Total posts <strong>12,345</strong>" => "Total posts <strong>12.3K</strong>")
	 *
	 * @param string $html_string
	 * @param int|float|string $raw_number
	 * @return string
	 */
	public function format_in_strong($html_string, $raw_number)
	{
		if (!$this->is_enabled())
		{
			return $html_string;
		}

		$formatted = $this->format($raw_number, true);
		return preg_replace('/<strong>[^<]+<\/strong>/', '<strong>' . $formatted . '</strong>', $html_string);
	}

	/**
	 * Retrieve language string safely
	 *
	 * @param string $key
	 * @param string $default
	 * @return string
	 */
	public function get_lang($key, $default = '')
	{
		if (isset($this->user->lang[$key]))
		{
			return $this->user->lang[$key];
		}

		if (method_exists($this->user, 'lang'))
		{
			$val = $this->user->lang($key);
			if ($val !== $key)
			{
				return $val;
			}
		}

		return $default;
	}
}

