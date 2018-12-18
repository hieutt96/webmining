<?php

namespace App\Helpers;

class HeaderHelpers {

	public static function getHeader() {
    	return [
            'oauth_access_token' => env('ACCESS_TOKEN','1074220831222358016-JSMXy7lgJra9PrPnssPSVPbLDrfgke'),
            'oauth_access_token_secret' => env('ACCESS_TOKEN_SECRET','YQSvhu1ZJuAUCeirXbKhCfeBQrCtCtoOUmAw33AoK2Rie'),
            'consumer_key' => env('CONSUMER_KEY', 'xQFXHkxlM8ZxovsMYy2l0E1Mk'),
            'consumer_secret' => env('CONSUMER_SECRET','uKdhgnU3EFuacBsPUowaBnnk3nn8iZfxHh1u7T1Fibht1QOSbH')
        ];
	}
}