<?php

use YoutubeForWP\Assets;
use YoutubeForWP\Blocks;
use YoutubeForWP\Options;

/**
 * Plugin Name:       Youtube For WP
 * Description:       Add last Youtube video to your website
 * Requires at least: 5.7
 * Requires PHP:      7.4
 * Version:           0.1.1
 * Author:            Loubal70
 * Author URI:        https://louis-boulanger.fr
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       youtube-for-wp
 *
 * @package           youtube-for-wp
 */

class YoutubeForWP
{
    public function boot(): void
    {
        $this->setConstants();
        $this->registerAutoload();

        Assets::boot();
        Blocks::boot();
        Options::boot();
    }

    public function setConstants(): void
    {
        define('YOUTUBE_FOR_WP_DIR', plugin_dir_path(__FILE__));
        define('YOUTUBE_FOR_WP_URL', plugin_dir_url(__FILE__));
        define('YOUTUBE_FOR_WP_TEXT_DOMAIN', 'youtube-for-wp');
    }

    public function registerAutoload(): void
    {
        require_once YOUTUBE_FOR_WP_DIR . '/vendor/autoload.php';
    }
}

$YoutubeForWP = new YoutubeForWP();
$YoutubeForWP->boot();