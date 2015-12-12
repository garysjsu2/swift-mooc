<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// First, include Requests
include('/home2/youthcyb/public_html/sjsucs/cs160/sec4group3/vendor/rmccue/requests/library/Requests.php');

// Next, make sure Requests can load internal classes
Requests::register_autoloader();

$response = Requests::get('https://www.youtube.com/results?search_query=elyonbeats');

$re = '/href=\"\/watch\?v=(.{11})/';
$str = $response->body;

preg_match_all($re, $str, $matches);

echo '<pre>'; print_r($matches); echo '</pre>';

// Get the first three results of the query
//echo print_r($matches[0][0]);
//echo print_r($matches[0][2]);
//echo print_r($matches[0][4]);

$first_video = $matches[0][0]; 
$second_video = $matches[0][2];
$third_video = $matches[0][4];

echo $first_video;

?>