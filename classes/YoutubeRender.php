<?php

namespace YoutubeForWP;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class YoutubeRender {
    private $apiKey;
    private $channelId;
    private $maxResults;

    public function __construct($apiKey, $channelId, $maxResults = 5) {
        $this->apiKey = $apiKey;
        $this->channelId = $channelId;
        $this->maxResults = $maxResults;
    }

    public function fetchYouTubeVideos() {
        $url = "https://www.googleapis.com/youtube/v3/search?key={$this->apiKey}&channelId={$this->channelId}&part=snippet,id&order=date&maxResults={$this->maxResults}";
        $client = new Client();

        try {
            $response = $client->get($url);
            $statusCode = $response->getStatusCode();

            if ($statusCode === 200) {
                return json_decode($response->getBody())->items;
            } else {
                error_log(__("The Youtube API request failed with the status code:", YOUTUBE_FOR_WP_TEXT_DOMAIN). ' ' . $statusCode, 1, get_bloginfo('admin_email'));
            }
        } catch (RequestException $e) {
            error_log(__("An error occurred during the Youtube API request:", YOUTUBE_FOR_WP_TEXT_DOMAIN) . ' ' . $e->getMessage(), 1, get_bloginfo('admin_email'));
        }
        return [];
    }

    public function renderYouTubeVideos($videos) {
        $renderedVideos = '';
        $dataVideos = [];

        foreach ($videos as $video) {
            $videoUrl = 'https://www.youtube.com/embed/' . $video->id->videoId;
            $dataVideos[] = [
                'videoId' => $video->id->videoId,
                'videoTitle' => $video->snippet->title,
                'description' => $video->snippet->description,
                'publishedAt' => $video->snippet->publishedAt,
                'thumbnail' => $video->snippet->thumbnails->medium->url,
                'channelTitle' => $video->snippet->channelTitle,
                'videoUrl' => $videoUrl,
            ];
            
            $renderedVideos .= "<h2>{$video->snippet->title}</h2>";
            $renderedVideos .= "<iframe loading='lazy' width='100%' style='aspect-ratio: 16/9' src='$videoUrl'
                frameborder='0'
                allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
        }

        return [
            'renderedVideos' => $renderedVideos,
            'dataVideos' => $dataVideos,
        ];
    }
}