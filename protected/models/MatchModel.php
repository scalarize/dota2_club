<?php

class MatchModel extends MatchRecord
{
	public function relations()
	{
		return array(
			'info' => array(self::BELONGS_TO, 'MatchInfoModel', 'match_id'),
			'player' => array(self::BELONGS_TO, 'SteamPlayerModel', 'player_id'),
			'hero' => array(self::BELONGS_TO, 'HeroModel', 'hero_id'),
		);
	}

	public function getPlayers()
	{
		$players = array();
		$matches = MatchModel::model('MatchModel')->findAll('match_id=?', array($this->match_id));
		foreach ($matches as $match) {
			if (!isset($players[$match->side])) $players[$match->side] = array();
			$player = $match->player;
			$player->match = $match;
			$players[$match->side] []= $player;
		}
		return $players;
	}

	/** 参战率 */
	public function getParticipation()
	{
		$basis = 0;
		foreach ($this->players[1 - $this->side] as $player) {
			$basis += $player->match->deaths;
		}
		if ($basis == 0) {
			return 0.0;
		} else {
			return ($this->kills + $this->assists) * 1.0 / $basis;
		}
	}

	public function getGpm()
	{
		return $this->gold / $this->duration * 60;
	}

	public function getXpm()
	{
		return $this->xp / $this->duration * 60;
	}


}
