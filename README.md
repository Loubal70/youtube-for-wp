# Youtube For WP 🐝 [![plugin version](https://img.shields.io/badge/version-v0.1.0-color.svg)](https://github.com/Loubal70/youtube-for-wp/releases/latest)

Youtube for WP is a plugin that enables you to add a new Gutenberg block for listing your latest YouTube videos.

## Versions

The current version of YoutubeForWP is `v0.1.0`. Please refer to the [Changelog](#changelog) section for details about previous versions.

## Youtube API
In order for the Gutenberg block to function, it is essential to provide your Google API key and activate 
the "Youtube Data API v3" library on your project.

#### Get the Youtube Data API V3

```http
https://console.cloud.google.com/apis/library/youtube.googleapis.com
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key |

#### Get channel ID
To target your YouTube channel, we also require your YouTube channel ID. <br />
You have two methods to find it: go to your YouTube channel, display the page source code 
<i>(right-click and then View Page Source)</i>, search for "<b>channel_id</b>" using "Ctrl F". 
You will get <u>multiple results</u>, and the goal is to find a URL with the mentioned ID, 
like the one below: "href="https://www.youtube.com/feeds/videos.xml?channel_id=yourcopiedkey">

| Parameter    | Type     | Description                                  |
|:-------------| :------- |:---------------------------------------------|
| `channel_id` | `string` | **Required**. Id of channel to fetch videos  |

#### Provide the information

Now that you have this information, go to the WordPress admin panel, navigate to the "Youtube" tab in the sidebar, 
and fill in the information in the corresponding fields. <br />
Once you've filled in the inputs, you'll be able to add the Gutenberg block to your posts.

## Changelog

<details>
<summary><strong>v0.1.0</strong></summary>
<p>

- Initial version of YoutubeForWP
- Adding a menu to the WordPress administration area (back office) to include option :
    - API keys
    - YouTube channel ID
    - Collecte et stockage des réponses des employés
    - Number of videos to retrieve in the Gutenberg block
- Adding a Gutenberg block to display the latest videos from a YouTube channel
- Adding a hook to override the view of the latest videos

</p>
</details>

<details>
<summary><strong>v0.2.0</strong> (Upcoming features)</summary>
<p>

- Adding WordPress notices for option field validation

</p>
</details>

