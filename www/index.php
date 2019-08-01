<?php

require_once 'libs/TwitterAPIExchange.php';
require_once 'class/connection.php';

$hashtags = $_GET['hashtags'];
$strings = explode(",",$hashtags);

$query = "#" . $hashtags;
if (count($strings) > 1) {
  $query = "#" . str_replace(",", "+OR+#",$hashtags);
}

$settings = array(
    'oauth_access_token' => "17870597-RWlWxCTro84XvzzeeoMW40z2f5oSCzyc7AEMH4zkt",
    'oauth_access_token_secret' => "vaJPYUFpi4Q54LAmnYwtn2KBKXfB9zsVGZPp6DiS90Jao",
    'consumer_key' => "vS5z8BIa9LCBBud1jKDQfz0SL",
    'consumer_secret' => "GwUmxoH1XPxYzq2fhfL6dFdmhjoUHBjvLDbKTJRQEBHNUgzyEc"
);

$url = "https://api.twitter.com/1.1/search/tweets.json";
$getfield = "?q={$query}&count=30&result_type=recent";
$requestMethod = "GET";

$twitter = new TwitterAPIExchange($settings);
$json = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();
$twitters = json_decode($json);

$prepare = array();
foreach ($twitters->statuses as $item) {
  $prepare[] = array(
		'name' => $item->user->name,
		'screen_name' => $item->user->screen_name,
		'followers_count' => $item->user->followers_count
             ); 
}

$connection = new Connection();

$sql = $connection->prepare($prepare);
$result = $connection->save($sql);

if ($result == 1) {
  print('Success!');
  exit;
}
die('Error: ' . print_r($result));