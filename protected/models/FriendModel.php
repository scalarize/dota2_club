<?php

/**
 * a friend is another player played with me, either teammate or opponent
 */
class FriendModel extends CFormModel
{

	public $player;
	public $matches = array();

	public $win = 0;
	public $lose = 0;
	public $count = 0;

	public function __construct($player)
	{
		$this->player = $player;
	}

	public function getId()
	{
		return $this->player->id;
	}

	public function getAttributes($names = null)
	{
		return array_merge(
			$this->player->getAttributes($names),
			parent::getAttributes($names)
		);
	}

	public function append($match)
	{
		$this->matches []= $match;
		if ($match->win > 0) {
			$this->win += 1;
		} else {
			$this->lose += 1;
		}
		$this->count += 1;
	}

	public function getWinrate()
	{
		$winrate = $this->win * 1.0 / max(1, $this->count);
		return $winrate * 100.0;
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

}

/** vim: set fdm=indent : */
