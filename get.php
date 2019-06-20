<?php
require 'vendor/autoload.php';

// YOUR CREDENTIALS
$username = '';
$password = '';

// USERNAME TO GET PHOTOS
$userToShow = '';


$ig = new \InstagramAPI\Instagram(false, false);

try {
    $loginResponse = $ig->login($username, $password);
} catch (\Exception $e) {
    echo 'Something went wrong: ' . $e->getMessage() . "\n";
}


$userid = $ig->people->getUserIdForName($userToShow);

$request = $ig->request("feed/user/{$userid}/")
    ->addParam('exclude_comment', true)
    ->addParam('only_fetch_first_carousel_media', false);

$res = new \InstagramAPI\Response\UserFeedResponse();


$response = $request->getResponse($res);
$response = json_decode($response);


$images = [];

foreach ($response->items as $photo) {
    array_push($images, $photo->image_versions2->candidates[0]->url);
}


var_dump($images);
