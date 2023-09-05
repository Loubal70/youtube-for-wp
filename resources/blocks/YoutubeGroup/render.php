<?php

$youtubeForWpOptions = get_option("youtube_for_wp");

if ($youtubeForWpOptions && !empty($youtubeForWpOptions['apiKey']) && !empty($youtubeForWpOptions['channelID'])) {
    $apiKey = $youtubeForWpOptions['apiKey'];
    $channelId = $youtubeForWpOptions['channelID'];
    $maxResults = !empty($youtubeForWpOptions['maxResults']) ? $youtubeForWpOptions['maxResults'] : 5;

    $renderer = new \YoutubeForWP\YouTubeRender($apiKey, $channelId, $maxResults);

    $videos = $renderer->fetchYouTubeVideos();

    if (!empty($videos)) {
        $getYoutubeVideos = $renderer->renderYouTubeVideos($videos);
        echo apply_filters('youtube_for_wp_rendered_videos', $getYoutubeVideos['renderedVideos'], $getYoutubeVideos['dataVideos']);
    }
} else{
    error_log(__("Please provide all the necessary information in your administration panel.", YOUTUBE_FOR_WP_TEXT_DOMAIN));
}
?>
