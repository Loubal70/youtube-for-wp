<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$youtubeForWpOptions = get_option("youtube_for_wp");

if (!$youtubeForWpOptions || empty($youtubeForWpOptions['apiKey']) || empty($youtubeForWpOptions['channelID'])) {
    return;
}

$apiKey = $youtubeForWpOptions['apiKey'];
$channelId = $youtubeForWpOptions['channelID'];
$maxResults = !empty($youtubeForWpOptions['maxResults']) ? $youtubeForWpOptions['maxResults'] : 5;

$url = "https://www.googleapis.com/youtube/v3/search?key=$apiKey&channelId=$channelId&part=snippet,id&order=date&maxResults=$maxResults";

$client = new Client();

try {
    $response = $client->get($url);
    $statusCode = $response->getStatusCode();

    if ($statusCode === 200) {
        // La requête a réussi
        $data = json_decode($response->getBody());

        $renderedVideos = '';
        $videos = [];

        foreach ($data->items as $video) {
            $videoId = $video->id->videoId;
            $videoTitle = $video->snippet->title;
            $description = $video->snippet->description;
            $publishedAt = $video->snippet->publishedAt;
            $thumbnail = $video->snippet->thumbnails->medium->url;
            $channelTitle = $video->snippet->channelTitle;
            $channelTitle = $video->snippet->channelTitle;
            $videoUrl = 'https://www.youtube.com/embed/'.$videoId;

            $videos[] = [
                'videoId' => $videoId,
                'videoTitle' => $videoTitle,
                'description' => $description,
                'publishedAt' => $publishedAt,
                'thumbnail' => $thumbnail,
                'channelTitle' => $channelTitle,
                'videoUrl' => $videoUrl,
            ];

            $renderedVideos .= "<h2>$videoTitle</h2>";
            $renderedVideos .= "<iframe loading='lazy' width='100%' style='aspect-ratio: 16/9' src='$videoUrl' 
                    frameborder='0' 
                    allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
        }

        $filteredVideos = apply_filters('youtube_for_wp_rendered_videos', $renderedVideos, $videos);

        echo $renderedVideos;
    } else {
        error_log(__("La requête a échoué avec le code d'état :", YOUTUBE_FOR_WP_TEXT_DOMAIN). ' ' . $statusCode, 1, get_bloginfo('admin_email'));
    }
} catch (RequestException $e) {
    error_log(__("Une erreur s'est produite lors de la requête :", YOUTUBE_FOR_WP_TEXT_DOMAIN) . ' ' . $e->getMessage(), 1, get_bloginfo('admin_email'));
}