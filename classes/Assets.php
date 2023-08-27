<?php

namespace YoutubeForWP;


class Assets extends BootLoadClass
{
    public function register(): void
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueueAdminAssets']);
    }

    public function enqueueAdminAssets(): void
    {
        if (!defined('YOUTUBE_FOR_WP_URL')) return;
        wp_register_style('youtube-for-wp-admin-style', YOUTUBE_FOR_WP_URL . 'dist/css/admin/admin.css');
        wp_enqueue_style('youtube-for-wp-admin-style');
    }
}