<?php
/**
 * Referenced Lemmy's OsuAPI class in the osu! signature generator project.
 * https://github.com/Lemmmy/osusig/blob/master/class/OsuAPI.php
 *
 * A class to access the YouTube API. It queries the API at {@link API_URL}.
 *
 * @author Adrian
 */
class YouTubeAPI
{
	/*
	 * The YouTube API url
	 */
	const API_URL = "";

	/**
	 * Your private osu!API key
	 *
	 * @var string
	 */
	private $apiKey;

	/**
	 * Creates a new instance of YouTube API
	 *
	 * @param string $apiKey Your private YouTube API key
	 */
	public function __construct($apiKey) {
		$this->apiKey = $apiKey;
	}
	
	/**
	 * Gets relevant videos from a query
	 *
	 * @param string $query Query to find relevant videos for
	 *
	 * @return array|bool
	 */
	public function getRelevantVideos($query) {
		
	}

	/**
	 * Request from the YouTube API
	 *
	 * @param string $url The resource to fetch
	 * @param array $params A list of arguments to give for the resource
	 *
	 * @return array|null The decoded JSON object containing the fetched resource, or null.
	 */
	public function request($url, $params = []) {
		$params = array_merge(["k" => $this->apiKey], $params);
		$url = static::API_URL . $url . '?' . http_build_query($params);

		return $this->decode(file_get_contents($url));
	}

	/**
	 * Decode a response from the API
	 *
	 * @param string $content The response from the API
	 * @return array|null The decoded JSON object, or null.
	 */
	protected function decode($content) {
		if (strlen($content) > 0 && $content) {
			return json_decode($content, true);
		}

		return null;
	}
}