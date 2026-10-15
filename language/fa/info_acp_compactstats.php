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
	'ACP_COMPACTSTATS_TITLE'            => 'آمار خلاصه انجمن',
	'ACP_COMPACTSTATS_SETTINGS'         => 'تنظیمات',
	'ACP_COMPACTSTATS_SETTINGS_EXPLAIN' => 'تنظیم و سفارشی‌سازی فرمت‌بندی هوشمند و خلاصه‌سازی ارقام بزرگ در سراسر بخش‌های انجمن (مثلاً 22.3K به جای 22345).',
	'ACP_COMPACTSTATS_SAVED'            => 'تنظیمات آمار خلاصه انجمن با موفقیت ذخیره شد.',

	// General
	'ACP_COMPACTSTATS_GENERAL_SETTINGS'     => 'تنظیمات عمومی فرمت‌بندی',
	'ACP_COMPACTSTATS_ENABLE'               => 'فعال‌سازی اعداد خلاصه',
	'ACP_COMPACTSTATS_ENABLE_EXPLAIN'       => 'کلید اصلی برای فعال یا غیرفعال‌سازی خلاصه‌سازی اعداد در سراسر انجمن.',
	'ACP_COMPACTSTATS_THRESHOLD'            => 'حداقل آستانه تبدیل',
	'ACP_COMPACTSTATS_THRESHOLD_EXPLAIN'    => 'حداقل مقداری که فرمت خلاصه از آن به بعد اعمال می‌شود (مثلاً 1000). مقادیر کمتر از این آستانه به صورت معمولی نمایش می‌یابند.',
	'ACP_COMPACTSTATS_DECIMALS'             => 'دقت ارقام اعشار',
	'ACP_COMPACTSTATS_DECIMALS_EXPLAIN'     => 'تعداد ارقام اعشار برای نمایش پس از خلاصه‌سازی.',
	'ACP_COMPACTSTATS_DECIMAL_0_EX'         => 'مثال: 22K',
	'ACP_COMPACTSTATS_DECIMAL_1_EX'         => 'مثال: 22.3K',
	'ACP_COMPACTSTATS_DECIMAL_2_EX'         => 'مثال: 22.34K',
	'ACP_COMPACTSTATS_SUFFIX_STYLE'         => 'سبک پسوندها',
	'ACP_COMPACTSTATS_SUFFIX_STYLE_EXPLAIN' => 'انتخاب استفاده از نمادهای بین‌المللی کوتاه یا کلمات فارسی.',
	'ACP_COMPACTSTATS_SUFFIX_SHORT'         => 'بین‌المللی (K, M, B)',
	'ACP_COMPACTSTATS_SUFFIX_FA'            => 'کلمات فارسی (هزار، میلیون، میلیارد)',
	'ACP_COMPACTSTATS_SUFFIX_LOCALE'        => 'بر اساس زبان فعال کاربر',
	'ACP_COMPACTSTATS_TOOLTIP'              => 'نمایش عدد دقیق در هاور (Tooltip)',
	'ACP_COMPACTSTATS_TOOLTIP_EXPLAIN'      => 'هنگامی که کاربر نشانگر ماوس را روی عدد خلاصه نگه می‌دارد، رقم دقیق و کامل به نمایش درمی‌آید.',

	// Locations
	'ACP_COMPACTSTATS_LOCATIONS'                  => 'بخش‌ها و مکان‌های اعمال',
	'ACP_COMPACTSTATS_FORUMLIST_TOPICS'           => 'موضوعات لیست انجمن‌ها',
	'ACP_COMPACTSTATS_FORUMLIST_TOPICS_EXPLAIN'   => 'خلاصه‌سازی تعداد موضوعات هر انجمن در صفحه اصلی و زیرانجمن‌ها.',
	'ACP_COMPACTSTATS_FORUMLIST_POSTS'            => 'پست‌های لیست انجمن‌ها',
	'ACP_COMPACTSTATS_FORUMLIST_POSTS_EXPLAIN'    => 'خلاصه‌سازی تعداد پست‌های هر انجمن در صفحه اصلی و زیرانجمن‌ها.',
	'ACP_COMPACTSTATS_FORUMLIST_CLICKS'           => 'کلیک‌های پیوندهای ارجاعی',
	'ACP_COMPACTSTATS_FORUMLIST_CLICKS_EXPLAIN'   => 'خلاصه‌سازی تعداد کلیک‌های پیوندها در لیست انجمن‌ها.',
	'ACP_COMPACTSTATS_BOARD_STATS'                => 'آمار کلی سایت در صفحه اصلی',
	'ACP_COMPACTSTATS_BOARD_STATS_EXPLAIN'        => 'خلاصه‌سازی مجموع کل پست‌ها، موضوعات، کاربران عضو و رکورد کاربران آنلاین در فوتر و صفحه اصلی.',
	'ACP_COMPACTSTATS_VIEWFORUM_VIEWS'            => 'بازدید موضوعات در تالار',
	'ACP_COMPACTSTATS_VIEWFORUM_VIEWS_EXPLAIN'    => 'خلاصه‌سازی تعداد بازدیدهای هر موضوع در صفحه فهرست موضوعات (viewforum).',
	'ACP_COMPACTSTATS_VIEWFORUM_REPLIES'          => 'پاسخ‌های موضوعات در تالار',
	'ACP_COMPACTSTATS_VIEWFORUM_REPLIES_EXPLAIN'  => 'خلاصه‌سازی تعداد پاسخ‌های هر موضوع در صفحه فهرست موضوعات (viewforum).',
	'ACP_COMPACTSTATS_POSTER_POSTS'               => 'تعداد ارسال‌های نویسنده پست',
	'ACP_COMPACTSTATS_POSTER_POSTS_EXPLAIN'       => 'خلاصه‌سازی تعداد پست‌های کاربر در مینی‌پروفایل کنار پیام‌ها در صفحه موضوعات.',
	'ACP_COMPACTSTATS_MEMBER_POSTS'               => 'پروفایل کاربر و لیست اعضا',
	'ACP_COMPACTSTATS_MEMBER_POSTS_EXPLAIN'       => 'خلاصه‌سازی تعداد ارسال‌های کاربران در صفحه پروفایل و جدول لیست کاربران.',
	'ACP_COMPACTSTATS_SEARCH_STATS'               => 'آمار نتایج جستجو',
	'ACP_COMPACTSTATS_SEARCH_STATS_EXPLAIN'       => 'خلاصه‌سازی بازدیدها و پاسخ‌ها در صفحه نتایج جستجو.',
]);
