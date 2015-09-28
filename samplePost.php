/**
 * sendRequest
 * Sending the request to the API.
 * --------------------------------------------------
 * @param string $postUrl
 * @param string $postData
 * @return response
 * --------------------------------------------------
*/
function sendRequest($postUrl, $postData) {
    // Setting up curl.
    $ch = curl_init($postUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Executing query.
    return curl_exec( $ch );
}

/**
 * postToWidget
 * Sending data to a widget on FruitDashboard.
 * --------------------------------------------------
 * @param string $postUrl
 * @param array $data
 * --------------------------------------------------
*/
function postToWidget($postUrl, array $data) {
    $response = json_decode(self::sendRequest($postUrl, $data), 1);
    if ($response['status'] === FALSE) {
        // An error occurred.
        echo 'Something went wrong. This is what we know: ';
    }
    // Printing message from server.
    echo $response['message'];
}

// Usage:
$myData = array(
    'date'              => '1998-09-04',
    'my_first_dataset'  => 21,
    'my_second_dataset' => 2
);

postToWidget('your_post_url', $myData);