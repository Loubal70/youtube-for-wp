<?php

namespace YoutubeForWP;

use YoutubeForWP\Settings\SettingsPage;

class Options extends BootLoadClass
{
    public function register(): void
    {
        SettingsPage::make(__('Youtube for WP', YOUTUBE_FOR_WP_TEXT_DOMAIN), __('Youtube', YOUTUBE_FOR_WP_TEXT_DOMAIN), 'youtube_for_wp')
            ->setIconUrl($this->getIcon())
            ->setPosition(100)
            ->addSection('Settings', 'setting', __('Parameters required for the operation of the extension', YOUTUBE_FOR_WP_TEXT_DOMAIN))
            ->addField(__('Api Key', YOUTUBE_FOR_WP_TEXT_DOMAIN),
                'apiKey',
                'text',
                __('Please enter your Google API Key and don\'t forget to activate the YouTube Data API v3.', YOUTUBE_FOR_WP_TEXT_DOMAIN),
                'setting')
            ->addField(__('Channel ID', YOUTUBE_FOR_WP_TEXT_DOMAIN),
                'channelID',
                'text',
                __('Please enter your channel ID.', YOUTUBE_FOR_WP_TEXT_DOMAIN),
                'setting', [
                    'min' => '0',
                    'max' => '1000',
                    'step' => '1',
                ])
            ->addField(__('Number of results', YOUTUBE_FOR_WP_TEXT_DOMAIN),
                'maxResults',
                'number',
                __('(Optional) Specify the number of videos you would like to display. By default, the five most recent videos are displayed.', YOUTUBE_FOR_WP_TEXT_DOMAIN),
                'setting', [
                    'min' => '0',
                    'max' => '20',
                    'step' => '1',
                ])
            ->render();
    }

    private function getIcon(): string
    {
        $iconContent = file_get_contents(YOUTUBE_FOR_WP_DIR . '/resources/icons/youtube.svg');
        $iconContent = base64_encode($iconContent);
        return 'data:image/svg+xml;base64,' . $iconContent;
    }

}