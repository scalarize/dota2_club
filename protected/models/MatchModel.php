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
		return $this->gold / max(1, $this->duration / 60);
	}

	public function getXpm()
	{
		return $this->xp / max(1, $this->duration / 60);
	}

	public function getKda()
	{
		return ($this->kills + $this->assists) * 1.0 / max(1, $this->deaths);
	}

	public function getDamage()
	{
		$players = $this->info->extraInfo->players;
		if (is_array($players)) {
			foreach ($players as $player) {
				if ($player->steam_id == $this->player->steam_id) {
					return $player->hero_damage;
				}
			}
		}
		return 0;
	}

	public function getDamagePercentage()
	{
		$damage = 0;
		$totalDamage = 0;
		$players = $this->info->extraInfo->players;
		if (is_array($players)) {
			foreach ($players as $player) {
				if ($player->steam_id == $this->player->steam_id) {
					$damage = $player->hero_damage;
				}
				$side = $player->player_slot >= 128 ? 1 : 0;
				if ($side == $this->side) {
					$totalDamage += $player->hero_damage;
				}
			}
		}
		return $damage * 100.0 / max(1, $totalDamage);
	}

}

/** vim: set noet fdm=indent : */

