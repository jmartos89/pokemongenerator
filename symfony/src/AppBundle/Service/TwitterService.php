<?php
namespace AppBundle\Service;

use TwitterAPIExchange;

class TwitterService
{
    private $twitter;

    public function __construct($settings)
    {
        $this->twitter = new TwitterAPIExchange($settings);
    }

    public function getTweets($limit = 100)
    {
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getField = '?screen_name=pokemongenerat7&count=' . $limit;
        $json = $this->twitter->setGetfield($getField)->buildOauth($url, 'GET')->performRequest();
        return $json;
    }
}