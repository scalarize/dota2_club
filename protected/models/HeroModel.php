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

}
