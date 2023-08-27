<?php

$youtubeForWpOptions = get_option("youtube_for_wp");

if (!$youtubeForWpOptions || empty($youtubeForWpOptions['apiKey']) || empty($youtubeForWpOptions['channelID'])) {
    return;
}

$apiKey = $youtubeForWpOptions['apiKey'];
$channelId = $youtubeForWpOptions['channelID'];
$maxResults = !empty($youtubeForWpOptions['maxResults']) ? $youtubeForWpOptions['maxResults'] : 5;

$url = "https://www.googleapis.com/youtube/v3/search?key=$apiKey&channelId=$channelId&part=snippet,id&order=date&maxResults=$maxResults";

$response = file_get_contents($url);
$data = json_decode($response);

$renderedVideos = '';

foreach ($data->items as $video) {
    $videoId = $video->id->videoId;
    $videoTitle = $video->snippet->title;
    $description = $video->snippet->description;
    $publishedAt = $video->snippet->publishedAt;
    $thumbnail = $video->snippet->thumbnails->medium->url;
    $channelTitle = $video->snippet->channelTitle;

    $renderedVideos .= "<h2>$videoTitle</h2>";
    $renderedVideos .= "<iframe width='100%' style='aspect-ratio: 16/9' src='https://www.youtube.com/embed/$videoId' 
            frameborder='0' 
            allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
}

$filteredVideos = apply_filters('youtube_for_wp_rendered_videos', $renderedVideos, $data->items);

echo $filteredVideos;
