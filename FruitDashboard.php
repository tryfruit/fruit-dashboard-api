<?php

class FruitDashboard {
    const URL = 'https://dashboard.tryfruit.com';

    /**
     * The API key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * The API version.
     *
     * @var string
     */
    protected $apiVersion;

    /**
     * Constructor
     *
     * @param string $apiKey
     * @param string $apiVersion
     */
    public function __construct($apiKey, $apiVersion) {
        $this->apiKey = $apiKey;
        $this->apiVersion = $apiVersion;
    }

    /**
     * Creates the post url.
     *
     * @param int $widgetId
     * @return string
     */
    private function buildPostUrl($widgetId) {
        $url = self::URL;
        $url .= '/api/' . $this->apiVersion;
        $url .= '/' . $this->apiKey;
        $url .= '/' . $widgetId;
        return $url;
    }

    /**
     * Sending the request to the API.
     *
     * @param string $postData
     * @return response
    */
    public function post($postData) {
        // Popping widget id from data.
        if ( ! array_key_exists('widgetId', $postData)) {
            $widgetId = 0;
        } else {
            $widgetId = $postData['widgetId'];
            unset($postData['widgetId']);
        }

        // Setting up curl.
        $ch = curl_init($this->buildPostUrl($widgetId));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Executing query.
        return json_decode(curl_exec( $ch ), 1);
    }
}
