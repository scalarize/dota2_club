<?php

class HeroModel extends HeroRecord
{

	protected $_matches = array();

	public function getMatches($season = '2016s2')
	{
		if (!isset($this->_matches[$season])) {
			$matches = array();
			foreach (MatchModel::model('MatchModel')->with('info')->findAll('hero_id=? and info.season=?',
				array($this->id, $season)) as $match) {
				$matches[$match->match_id] = $match;
			}
			ksort($matches);
			$this->_matches[$season] = $matches;
		}
		return $this->_matches[$season];
	}

	public function getKda()
	{
		$kills = 0;
		$deaths = 0;
		$assists = 0;
		foreach ($this->matches as $match) {
			$kills += $match->kills;
			$deaths += $match->deaths;
			$assists += $match->assists;
		}
		return sprintf('%.2f', ($kills + $assists) / max(1, $deaths));
	}

	public function getGpm()
	{
		$gold = 0;
		$duration = 0;
		foreach ($this->matches as $match) {
			$gold += $match->gold;
			$duration += $match->duration;
		}
		return sprintf('%d', $gold / max(1, $duration / 60));
	}

	public function getXpm()
	{
		$xp = 0;
		$duration = 0;
		foreach ($this->matches as $match) {
			$xp += $match->xp;
			$duration += $match->duration;
		}
		return sprintf('%d', $xp / max(1, $duration / 60));
	}

	public function getBanPicks()
	{
		$ret = array('ban' => array(), 'pick' => array());
		$criteria = new CDbCriteria(array(
			'condition' => 'hero_id=?',
			'order' => 'match_id, idx',
			'params' => array(
				$this->id,
			),
		));
		$bps = MatchBanPickModel::model('MatchBanPickModel')->findAll($criteria);
		foreach ($bps as $bp) {
			$op = $bp->op == 0 ? 'ban' : 'pick';
			$ret[$op] []= $bp;
		}
		return $ret;
	}

	public function getBanned()
	{
		return count($this->banPicks['ban']);
	}

	public function getAttendance()
	{
		return count($this->matches);
	}

	public function getWin($season = '2016s2')
	{
		$win = 0;
		foreach ($this->getMatches($season) as $match_id => $match) {
			$win += $match->win > 0 ? 1 : 0;
		}
		return $win;
	}

	public function getWinrate($season = '2016s2')
	{
		$winrate = $this->getWin($season) * 1.0 / max(1, $this->getAttendance($season));
		return $winrate * 100.0;
	}

	public function getAvatarUrl()
	{
		return sprintf('http://cdn.dota2.com/apps/dota2/images/heroes/%s_full.png',
		//return sprintf('http://cdn.dota2.com/apps/dota2/images/heroes/%s_vert.jpg',
			str_replace('npc_dota_hero_', '', $this->name)
		);
	}

}

/** vim: set fdm=indent : */
