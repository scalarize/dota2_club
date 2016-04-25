<?php

class PlayerModel extends PlayerRecord
{

	public $tab = 'matches';

	protected $_matches = array();

	public function rules()
	{
		return array(
			array('tab', 'safe'),
		);
	}

	public function attributeLabels()
	{
		return array_merge(
			parent::attributeLabels(),
			array(
				'name' => '姓名',
				'form' => '最近战绩',
				'rank_score' => '初始分',
				'currentRank' => '当前分',
				'score' => '赛季分',
				'attendance' => '出场',
				'win' => '胜场',
				'kda' => 'KDA',
				'gpm' => 'GPM',
				'xpm' => 'XPM',
			)
		);
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

	public function getMatches($season = '2016s2')
	{
		if (!isset($this->_matches[$season])) {
			$matches = array();
			foreach (MatchModel::model('MatchModel')->with('info')->findAll('player_id=? and info.season=?',
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

	public function getForm($season = '2016s2')
	{
		$form = '';
		foreach ($this->getMatches($season) as $match_id => $match) {
			$form .= $match->win > 0 ? 'W' : 'L';
		}
		return $form;
	}

	public function getCurrentRank()
	{
		$rank = $this->rank_score;
		foreach ($this->matches as $match) {
			if ($match->win > 0) {
				$rank += 25;
			} else {
				$rank -= 25;
			}
		}
		return $rank;
	}

	public function getRankDiff()
	{
		return $this->currentRank - $this->rank_score;
	}

	public function getAttributes($names = true)
	{
		$ret = parent::getAttributes($names);
		$ret['current_rank'] = $this->currentRank;
		$ret['s1_history'] = $this->getForm('2016s1');
		$ret['s2_history'] = $this->getForm('2016s2');
		return $ret;
	}

	public function getScore($season = '2016s2')
	{
		$score = 0;
		foreach ($this->getMatches($season) as $match_id => $match) {
			$score += $match->win > 0 ? 3 : 1;
		}
		return $score;
	}

	public function getWin($season = '2016s2')
	{
		$win = 0;
		foreach ($this->getMatches($season) as $match_id => $match) {
			$win += $match->win > 0 ? 1 : 0;
		}
		return $win;
	}

	public function getLose($season = '2016s2')
	{
		$lose = 0;
		foreach ($this->getMatches($season) as $match_id => $match) {
			$lose += $match->win > 0 ? 0 : 1;
		}
		return $lose;
	}

	public function getWinrate($season = '2016s2')
	{
		$winrate = $this->getWin($season) * 1.0 / max(1, $this->getAttendance($season));
		return $winrate * 100.0;
	}

	public function getTeammates()
	{
		$teammates = array();
		foreach ($this->matches as $match) {
			$players = $match->players;
			foreach ($players[$match->side] as $p) {
				if ($p->id == $this->id) continue;
				if (isset($teammates[$p->id])) {
					$teammates[$p->id]->append($p->match);
				} else {
					$teammates[$p->id] = new FriendModel($p);
					$teammates[$p->id]->append($p->match);
				}
			}
		}
		return $teammates;
	}

	public function getOpponents()
	{
		$opponents = array();
		foreach ($this->matches as $match) {
			$players = $match->players;
			foreach ($players[1 - $match->side] as $p) {
				if (isset($opponents[$p->id])) {
					$opponents[$p->id]->append($p->match);
				} else {
					$opponents[$p->id] = new FriendModel($p);
					$opponents[$p->id]->append($p->match);
				}
			}
		}
		return $opponents;
	}

	public function getHeroes()
	{
		$heroes = array();
		foreach ($this->matches as $match) {
			if (isset($heroes[$match->hero->id])) {
				$heroes[$match->hero->id]->append($match);
			} else {
				$heroes[$match->hero->id] = new PlayerHeroModel($match->hero);
				$heroes[$match->hero->id]->append($match);
			}
		}
		return array_values($heroes);
	}

}

/** vim: set fdm=indent : */

