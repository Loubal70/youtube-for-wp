<?php

namespace YoutubeForWP;

class Blocks extends BootLoadClass
{
    public function register(): void
    {
        add_action('block_categories_all', [$this, 'registerBlockCategory']);
        add_action('init', [$this, 'registerBlockTypes']);
    }

    public function registerBlockTypes(): void
    {
        if (!defined('YOUTUBE_FOR_WP_DIR')) return;
        $gutenbergBuildDir = YOUTUBE_FOR_WP_DIR . '/dist/blocks';
        $gutenbergBuildDirChildren = scandir($gutenbergBuildDir);
        $gutenbergBuildDirChildren = array_filter($gutenbergBuildDirChildren, function ($child) {
            return $child !== '.' && $child !== '..';
        });
        $gutenbergBuildDirChildren = array_map(function ($child) use ($gutenbergBuildDir) {
            return $gutenbergBuildDir . '/' . $child;
        }, $gutenbergBuildDirChildren);

        foreach ($gutenbergBuildDirChildren as $buildDirChild) {
            register_block_type($buildDirChild);
        }
    }

    public function registerBlockCategory($categories): array
    {
        return array_merge(
            $categories,
            [
                [
                    'slug' => 'youtube-for-wp',
                    'title' => __('Youtube For WP', YOUTUBE_FOR_WP_TEXT_DOMAIN),
                    'icon' => 'wordpress',
                ],
            ]
        );
    }
}