<?php

class SteamPlayerModel extends PlayerModel
{

	public $match;

	static $API = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=8D7A47691578D020B421A7DAE8261786&steamids=%s';

	public function getSteamProfile()
	{
		$url = sprintf(self::$API, $this->steam_id);
		$timeout = 5;
		$request = curl_init($url);
		curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($request, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3; Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36');
		curl_setopt($request, CURLOPT_HEADER, false);
		curl_setopt($request, CURLOPT_TIMEOUT, $timeout);
		$message = @curl_exec($request);
		curl_close($request);

		$ret = @json_decode($message);
		if (is_object($ret) && isset($ret->response) && isset($ret->response->players)) {
			$players = $ret->response->players;
			if (is_array($players)) {
				foreach ($players as $player) {
					if ($player->steamid == $this->steam_id) {
						return (array)$player;
					}
				}
			}
		}
		return null;
	}

	public function getFullAttributes()
	{
		$attrs = $this->attributes;
		$steam_profile = $this->steamProfile;
		if (!empty($steam_profile)) {
			foreach (array('personaname', 'lastlogoff', 'avatar', 'avatarmedium', 'avatarfull') as $key) {
				if (isset($steam_profile[$key])) {
					$attrs["steam_$key"] = $steam_profile[$key];
				} else {
					$attrs["steam_$key"] = '';
				}
			}
		}
		return $attrs;
	}

	public function getSteamName()
	{
		return $this->fullAttributes['steam_personaname'];
	}

}
