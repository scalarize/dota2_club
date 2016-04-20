<?php

class MatchInfoModel extends MatchInfoRecord
{

	public function attributeLabels()
	{
		return array_merge(
			parent::attributeLabels(),
			array(
				'match_id' => 'steam id',
				'winnerText' => '胜方',
				'duration' => '时长',
			)
		);
	}

	public function getLatestMatch()
	{
		return self::model()->findBySql('select * from ' . $this->tableName() . ' order by id desc limit 1');
	}

	public function getAttendants()
	{
		$players = array();
		$matches = MatchModel::model('MatchModel')->findAll('match_id=?', array($this->id));
		foreach ($matches as $match) {
			$side = $match->side > 0 ? 'dire' : 'radiant';
			if (!isset($players[$side])) $players[$side] = array();
			$player = $match->player;
			$player->match = $match;
			$players[$side] []= $player;
		}
		return $players;
	}

	public function getWinner()
	{
		$matches = MatchModel::model('MatchModel')->findAll('match_id=? and win > 0', array($this->id));
		foreach ($matches as $match) {
			$side = $match->side > 0 ? 'dire' : 'radiant';
			return $side;
		}
		return 'unknown';
	}

	public function getDuration()
	{
		$matches = MatchModel::model('MatchModel')->findAll('match_id=? and win > 0', array($this->id));
		foreach ($matches as $match) {
			$duration = intval($match->duration / 60);
			return $duration . '分钟';
		}
		return 'unknown';
	}

	public function getWinnerText()
	{
		switch ($this->winner) {
		case 'radiant':
			return '天辉';
		case 'dire':
			return '夜魇';
		default:
			return '未知';
		}
	}

}
