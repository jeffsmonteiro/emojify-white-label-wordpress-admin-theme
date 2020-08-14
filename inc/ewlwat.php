<?php
// if ( ! defined( 'ABSPATH' ) ) {
// 	exit;
// }

$code = "dddaace7-2ed6-41d8-ba18-1796cf90cb56";
$personalToken = "7WkH2E4kQe6rlHebFeM1wdF3xWKCuzgw";
$userAgent = "Purchase code verification on mywebsite.com";

// Surrounding whitespace can cause a 404 error, so trim it first
$code = trim($code);

// Make sure the code looks valid before sending it to Envato
if (!preg_match("/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $code)) {
    throw new Exception("Invalid code");
}

// Build the request
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => "https://api.envato.com/v3/market/author/sale?code={$code}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 20,
    
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer {$personalToken}",
        "User-Agent: {$userAgent}"
    )
));

// Send the request with warnings supressed
$response = @curl_exec($ch);

// Handle connection errors (such as an API outage)
// You should show users an appropriate message asking to try again later
if (curl_errno($ch) > 0) { 
    throw new Exception("Error connecting to API: " . curl_error($ch));
}

// If we reach this point in the code, we have a proper response!
// Let's get the response code to check if the purchase code was found
$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// HTTP 404 indicates that the purchase code doesn't exist
if ($responseCode === 404) {
    throw new Exception("The purchase code was invalid");
}

// Anything other than HTTP 200 indicates a request or API error
// In this case, you should again ask the user to try again later
if ($responseCode !== 200) {
    throw new Exception("Failed to validate code due to an error: HTTP {$responseCode}");
}

// Parse the response into an object with warnings supressed
$body = @json_decode($response);

// Check for errors while decoding the response (PHP 5.3+)
if ($body === false && json_last_error() !== JSON_ERROR_NONE) {
    throw new Exception("Error parsing response");
}

// Now we can check the details of the purchase code
// At this point, you are guaranteed to have a code that belongs to you
// You can apply logic such as checking the item's name or ID

$id = $body->item->id; // (int) 17022701
$name = $body->item->name; // (string) "SEO Studio - Professional Tools for SEO"

echo $name;