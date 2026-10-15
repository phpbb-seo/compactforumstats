# phpBB Compact Forum Stats

[![phpBB Version](https://img.shields.io/badge/phpBB-3.3.x-blue.svg)](https://www.phpbb.com/)
[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D%207.4-8892BF.svg)](https://php.net/)
[![License](https://img.shields.io/badge/license-GPL--2.0-green.svg)](LICENSE)
[![Latest Release](https://img.shields.io/badge/release-v1.0.0-orange.svg)](https://github.com/phpbb-seo/compactforumstats/releases)
[![Type](https://img.shields.io/badge/type-phpBB%20Extension-brightgreen.svg)](https://www.phpbb.com/customise/db/extensions-36)

An advanced and lightweight **phpBB 3.3.x** extension that transforms large topic, post, user, and view counters across your forum into modern, clean shorthand numbers (e.g. `22.3K` or `1.5M` instead of lengthy figures like `22345`). Includes interactive hover tooltips displaying the exact numbers and full granular controls in the phpBB Administration Control Panel (ACP).

---

## 📑 Table of Contents

- [✨ Features](#-features)
- [📊 Supported Statistics & Locations](#-supported-statistics--locations)
- [⚙️ ACP Settings & Configuration](#️-acp-settings--configuration)
- [📋 Requirements](#-requirements)
- [🚀 Installation](#-installation)
- [🔄 Updating](#-updating)
- [🗑️ Uninstallation](#️-uninstallation)
- [🎨 Theme Compatibility & RTL](#-theme-compatibility--rtl)
- [⚡ Architecture & Performance](#-architecture--performance)
- [📄 License](#-license)

---

## ✨ Features

- **Modern Shorthand Formatting:** Automatically formats large numbers into clean, human-readable shorthand:
  - Thousands ($1,000 \to 999,999$): Formatted with `K` (e.g. `22,345` $\to$ `22.3K`)
  - Millions ($1,000,000 \to 999,999,999$): Formatted with `M` (e.g. `1,500,000` $\to$ `1.5M`)
  - Billions ($1,000,000,000+$): Formatted with `B` (e.g. `2,100,000,000` $\to$ `2.1B`)
- **Smart Decimal Truncation:** Strips redundant trailing decimal zeros automatically (`10K` instead of `10.0K`, while keeping `10.5K` intact).
- **Interactive Exact-Value Tooltip:** Hovering over any compact number displays the exact, formatted number (e.g. `22,345`) in a native tooltip without requiring extra clicks.
- **Configurable Suffix Styles:**
  - **International:** `K`, `M`, `B`
  - **Persian:** Localized Persian words (Thousand, Million, Billion)
  - **Language-based (Locale):** Automatically pulls terminology from the active user's language pack.
- **Granular Toggle Controls:** Easily turn compact formatting on or off independently for each section of the forum (forumlist, viewforum, index stats, member profiles, search results).
- **Zero Query Overhead (0 SQL Queries):** Uses native phpBB dispatcher events to format variables already loaded in memory—no extra database load.
- **Safe Pagination Protection:** Topic reply formatting safely updates template display blocks without altering underlying integer reply counters used for topic pagination.
- **100% RTL & LTR Ready:** Fully translated into both English and Persian (`fa`), seamlessly supporting RTL layouts.
- **Universal Style Compatibility:** Works out of the box with `prosilver`, `Mobbern 3.3`, `Zeina Theme Pro`, and all modern styles.

---

## 📊 Supported Statistics & Locations

| Location / Section | Template Variable | Description | Example Transformation |
| :--- | :--- | :--- | :--- |
| **Forum List** | `forumrow.TOPICS` | Total topics inside each forum | `22345` $\to$ **`22.3K`** |
| **Forum List** | `forumrow.POSTS` | Total posts inside each forum | `158900` $\to$ **`158.9K`** |
| **Forum List** | `forumrow.CLICKS` | Redirect link click counts | `3400` $\to$ **`3.4K`** |
| **Board Index Stats** | `TOTAL_POSTS` | Total board posts across all forums | `54200` $\to$ **`54.2K`** |
| **Board Index Stats** | `TOTAL_TOPICS` | Total board topics created | `12850` $\to$ **`12.9K`** |
| **Board Index Stats** | `TOTAL_USERS` | Total registered members | `8940` $\to$ **`8.9K`** |
| **Board Index Stats** | `RECORD_USERS` | Most users ever online record | `1450` $\to$ **`1.5K`** |
| **Topic List (viewforum)**| `topicrow.VIEWS` | Individual topic view counts | `15200` $\to$ **`15.2K`** |
| **Topic List (viewforum)**| `topicrow.REPLIES`| Topic reply counts (pagination safe) | `2449` $\to$ **`2.4K`** |
| **Topic Posts (viewtopic)**| `postrow.POSTER_POSTS`| Author post count in mini-profile | `4230` $\to$ **`4.2K`** |
| **Memberlist & Profile** | `template_data.POSTS`| User post count on profile & member table | `12940` $\to$ **`12.9K`** |
| **Search Results** | `searchresults.TOPIC_VIEWS` | Views of matched topics in search | `12400` $\to$ **`12.4K`** |
| **Search Results** | `searchresults.TOPIC_REPLIES`| Replies of matched topics in search | `1850` $\to$ **`1.9K`** |

---

## ⚙️ ACP Settings & Configuration

Navigate to **ACP &rarr; Customise &rarr; Extensions &rarr; Compact Forum Stats** to manage all options:

### 1. General Formatting Settings

| Setting | Config Key | Options / Range | Default | Description |
| :--- | :--- | :--- | :--- | :--- |
| **Enable compact numbers** | `cstats_enable` | Yes / No | `Yes` (1) | Master toggle to enable or disable compact formatting forum-wide. |
| **Formatting threshold** | `cstats_threshold` | Integer $\ge 0$ | `1000` | Minimum value before formatting activates. Numbers below this remain unchanged. |
| **Decimal precision** | `cstats_decimals` | `0`, `1`, `2` | `1` | Number of decimal places shown (`0` = `22K`, `1` = `22.3K`, `2` = `22.34K`). |
| **Suffix style** | `cstats_suffix_style`| `short`, `fa`, `locale` | `short` | Choose between International (`K/M/B`), Persian words, or Active Language. |
| **Show exact count on hover** | `cstats_tooltip` | Yes / No | `Yes` (1) | Wraps compact numbers in a tooltip with subtle dotted underline revealing the exact number on hover. |

### 2. Location Toggles

| Setting | Config Key | Default | Target Location |
| :--- | :--- | :--- | :--- |
| **Forumlist topics** | `cstats_forumlist_topics` | `Yes` (1) | Forum topics in forum lists on index and subforum pages. |
| **Forumlist posts** | `cstats_forumlist_posts` | `Yes` (1) | Forum posts in forum lists on index and subforum pages. |
| **Forumlist link clicks** | `cstats_forumlist_clicks` | `Yes` (1) | Redirect link clicks on link-type forums. |
| **Board index statistics** | `cstats_board_stats` | `Yes` (1) | Total board posts, topics, members, and online record on index. |
| **Viewforum topic views** | `cstats_viewforum_views` | `Yes` (1) | Views column in forum topic lists (`viewforum.php`). |
| **Viewforum topic replies** | `cstats_viewforum_replies` | `Yes` (1) | Replies column in forum topic lists (`viewforum.php`). |
| **Post author posts count** | `cstats_poster_posts` | `Yes` (1) | User post counter in topic mini-profiles (`viewtopic.php`). |
| **Member profile & memberlist**| `cstats_member_posts` | `Yes` (1) | User post counter on user profile and memberlist tables. |
| **Search results statistics** | `cstats_search_stats` | `Yes` (1) | Topic views and replies in search results. |

---

## 📋 Requirements

- **phpBB:** 3.3.0 or higher (fully compatible with 3.3.0 through 3.3.19+)
- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, or 8.4

---

## 🚀 Installation

### Option A: Install via Git (Recommended)

1. Clone the repository into your phpBB `ext/phpbbseo/compactforumstats` directory:

```bash
cd /path/to/your/phpbb/ext/
mkdir -p phpbbseo
cd phpbbseo
git clone https://github.com/phpbb-seo/compactforumstats.git compactforumstats
```

### Option B: Install via ZIP Download

1. Download the latest release `.zip` from the [Releases page](https://github.com/phpbb-seo/compactforumstats/releases).
2. Create the directory `phpbb_root/ext/phpbbseo/compactforumstats/`.
3. Extract the contents into that folder so that `composer.json` resides directly at:
   `phpbb_root/ext/phpbbseo/compactforumstats/composer.json`.

### Enabling the Extension

1. In your web browser, navigate to the **Administration Control Panel (ACP)**.
2. Go to **Customise** &rarr; **Manage extensions**.
3. Under **Disabled Extensions**, locate **phpBB Compact Forum Stats** and click **Enable**.
4. Configure options under **Extensions** &rarr; **Compact Forum Stats**.
5. Purge your forum cache via **ACP &rarr; General &rarr; Purge the cache**.

---

## 🔄 Updating

1. In the **ACP**, navigate to **Customise &rarr; Manage extensions**.
2. Click **Disable** on **phpBB Compact Forum Stats**.
3. Replace the files in `ext/phpbbseo/compactforumstats/` with the new version.
4. Click **Enable** on **phpBB Compact Forum Stats**.
5. Purge the forum cache.

---

## 🗑️ Uninstallation

1. Navigate to **ACP &rarr; Customise &rarr; Manage extensions**.
2. Click **Disable** on **phpBB Compact Forum Stats**.
3. To remove all database configuration settings permanently, click **Delete data**.
4. Delete the folder `ext/phpbbseo/compactforumstats/` from your server.

---

## 🎨 Theme Compatibility & RTL

- **prosilver:** Fully compatible with phpBB's default theme.
- **Zeina Theme Pro & Mobbern 3.3:** Built-in support for custom responsive grid and flex container classes.
- **RTL / LTR:** Fully optimized for Right-to-Left (Persian, Arabic) and Left-to-Right layouts.
- **Styling:** Injects a subtle, non-intrusive CSS helper via `styles/all/theme/compactstats.css` providing smooth hover states and tabular-nums alignment.

---

## ⚡ Architecture & Performance

- **0 Database Queries:** The extension hooks into core template event dispatchers (`core.display_forums_modify_template_vars`, `core.viewforum_modify_topicrow`, `core.viewforum_topic_row_after`, `core.index_modify_page_title`, etc.) to modify values already queried by phpBB.
- **Non-destructive:** Leaves your underlying post and topic counts completely untouched in the database.
- **Zero Core File Edits:** Cleanly isolated within the phpBB extension architecture.

---

## 📄 License

- **Developer:** [phpBB SEO](https://www.phpbbseo.com)
- **Homepage:** [https://www.phpbbseo.com](https://www.phpbbseo.com)
- **Repository:** [https://github.com/phpbb-seo/compactforumstats](https://github.com/phpbb-seo/compactforumstats)
- **License:** [GNU General Public License v2 (GPL-2.0)](LICENSE)
