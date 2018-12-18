<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TwitterAPIExchange;
use App\User;
use App\Friend;
use App\Tweet;
use App\Helpers\HeaderHelpers;
use App\Retweet;

class HomeController extends Controller
{
    public function findName(Request $request) 
    {   
        $url = 'https://api.twitter.com/1.1/users/search.json';
        $name = $request->name;
        $getfield = '?q='.$name;
        $requestMethod = 'GET';
        $headers = HeaderHelpers::getHeader();
        $twitter = new TwitterAPIExchange($headers);
        $tweets = $twitter->setGetfield($getfield)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest();
        if(count($tweets)) {
            $tweets = json_decode($tweets, true);
            $user = User::where('twitter_id', $tweets[0]['id'])->get();
            if(!sizeof($user)) {
                $user = new User;
                $user->twitter_id = $tweets[0]['id'];
                $user->name = $tweets[0]['name'];
                $user->screen_name = $tweets[0]['screen_name'];
                $user->save();
                // $this->getFriends($user);
                $this->getInteraction($user);
            }
        }
        return view('detail', compact('tweets'));
    }

    // public function getFriends($user) 
    // {
    //     $results = $user->getFriendIds();
    //     if(count($results)) {
    //         foreach($results as $id) {
    //             $model = new Friend;
    //             $model->twitter_id = $user->twitter_id;
    //             $model->friend_id = $id;
    //             $model->interactive = 0;
    //             $model->save();
    //         }
    //     }
    // }

    public function getInteraction($user) {
        $tweetIds = $this->getTweets($user['screen_name'], $user['twitter_id']);
        if(count($tweetIds)) {
            foreach($tweetIds as $tweetId) {
                $userIds = $this->getUserIdRetweets($tweetId);
                if(sizeof($userIds)) {
                    foreach($userIds as $userId) {
                        $model = Friend::where('twitter_id', $user->twitter_id)->where('friend_id', $userId)->first();
                        if($model) {
                            $model->interactive += 1;
                            $model->save();
                        } 
                        else {
                            $friend = new Friend;
                            $friend->twitter_id = $user->twitter_id;
                            $friend->friend_id = $userId;
                            $friend->interactive = 1;
                            $friend->save();
                        }
                    }
                }
            }
        }
    }

    public function getTweets($screen_name, $twitter_id) 
    {   
        $headers = HeaderHelpers::getHeader();
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name='.$screen_name.'&count=3';
        $twitter = new TwitterAPIExchange($headers);
        $statuses = $twitter->setGetfield($getfield)
                     ->buildOauth($url, 'GET')
                     ->performRequest();
        $statuses = json_decode($statuses, true);
        $tweetIds = [];
        if(count($statuses)) {
            foreach($statuses as $stat) {
                $tweetIds [] = $stat['id'];
            }
        }
        return $tweetIds;
    }

    public function getUserIdRetweets($tweetId) {
        $tweetId = number_format($tweetId, 0, '', '');
        $headers = HeaderHelpers::getHeader();
        $url = 'https://api.twitter.com/1.1/statuses/retweeters/ids.json';
        $getfield = '?id='.number_format($tweetId, 0, '', '').'&count=10&stringify_ids=true';
        $twitter = new TwitterAPIExchange($headers);
        $results = $twitter->setGetfield($getfield)
                     ->buildOauth($url, 'GET')
                     ->performRequest();
        $results = json_decode($results, true);
        $userIds = [];
        if(isset($results['ids'])) {
            if(sizeof($results['ids'])) {
                foreach($results['ids'] as $id) {
                    $userIds [] = $id;
                }
            }
        }
        return $userIds;
    }

    public function display(Request $request) {
        $id = $request->id;
        $friends = Friend::where('twitter_id', $id)->get();
        $data = [];
        if(count($friends)) {
            $headers = HeaderHelpers::getHeader();
            foreach($friends as $friend) {
                $friend_id = number_format($friend->friend_id, 0, '', '');
                $url = 'https://api.twitter.com/1.1/users/show.json';
                $getfield = '?user_id='.$friend_id;
                $twitter = new TwitterAPIExchange($headers);
                $result = $twitter->setGetfield($getfield)
                             ->buildOauth($url, 'GET')
                             ->performRequest();
                $result = json_decode($result, true);
                if(isset($result['screen_name'])) {
                    $friend->friend_screen_name = $result['screen_name'];
                }else {
                    $friend->friend_screen_name = 'John';
                }
                
                $friend->save();

                $data [] = [
                    'x' => rand(0, 100),
                    'y' => rand(0, 100),
                    'z' => $friend->interactive,
                    'name' => $friend->friend_screen_name,
                ];
            }
        }
        $data = json_encode($data);
        return view('display', compact('friends','data'));
    }
}
