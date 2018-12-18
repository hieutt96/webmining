<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Helpers\HeaderHelpers;
use App\Http\Controllers\TwitterAPIExchange;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'screen_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function getFriendIds() {
        $c = 20;
        $url = 'https://api.twitter.com/1.1/friends/ids.json';
        $getfield = '?screen_name='.$this->screen_name.'&count='.$c;
        $requestMethod = 'GET';
        $headers = HeaderHelpers::getHeader();
        $twitter = new TwitterAPIExchange($headers);
        $results = $twitter->setGetfield($getfield)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest();
        $results = json_decode($results, true);
        $friendIds = [];
        if(count($results['ids'])) {
            foreach ($results['ids'] as $id) {
                $friendIds [] = $id;
            }
        }
        return $friendIds;
    }
}
