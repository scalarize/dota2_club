<?php

class PlayerController extends Controller
{

	public function actionBasic($id)
	{
		$player = $this->loadPlayer($id);
		$data = $player->attributes;
		$this->renderJson($data);
	}

	public function actionFull($id)
	{
		$player = $this->loadPlayer($id);
		$data = $player->fullAttributes;
		$this->renderJson($data);
	}

	public function actionTeammates($id)
	{
		$player = $this->loadPlayer($id);
		$teammates = array();
		foreach ($player->matches as $match) {
			$players = $match->players;
			$key = $match->win > 0 ? 'win' : 'lose';
			foreach ($players[$match->side] as $p) {
				if ($p->id == $player->id) continue;
				if (isset($teammates[$p->id])) {
					$teammates[$p->id][$key] += 1;
				} else {
					$teammates[$p->id] = $p->attributes;
					$teammates[$p->id]['win'] = 0;
					$teammates[$p->id]['lose'] = 0;
					$teammates[$p->id][$key] = 1;
				}
			}
		}
		$this->renderJson(array('basic' => $player->attributes, 'teammates' => $teammates));
	}

	public function actionOpponents($id)
	{
		$player = $this->loadPlayer($id);
		$opponents = array();
		foreach ($player->matches as $match) {
			$players = $match->players;
			$key = $match->win > 0 ? 'lose' : 'win';
			foreach ($players[1 - $match->side] as $p) {
				if ($p->id == $player->id) continue;
				if (isset($opponents[$p->id])) {
					$opponents[$p->id][$key] += 1;
				} else {
					$opponents[$p->id] = $p->attributes;
					$opponents[$p->id]['win'] = 0;
					$opponents[$p->id]['lose'] = 0;
					$opponents[$p->id][$key] = 1;
				}
			}
		}
		$this->renderJson(array('basic' => $player->attributes, 'opponents' => $opponents));
	}

	public function actionHistory($id)
	{
		$player = $this->loadPlayer($id);
		$this->renderJson(array('basic' => $player->attributes, 'history' => $player->matches));
	}

	protected function loadPlayer($id)
	{
		$model = SteamPlayerModel::model('SteamPlayerModel')->findByPK($id);
		if (!is_object($model)) {
			throw new CHttpException(404, 'no player found with id: ' . $id);
		}
		return $model;
	}

	public function actionAll()
	{
		$players = SteamPlayerModel::model('SteamPlayerModel')->findAll();
		$ret = array();
		foreach ($players as $player) {
			$ret []= $player->fullAttributes;
		}
		$this->renderJson($ret);
	}

	public function actionView($id)
	{
		$player = $this->loadPlayer($id);
		$this->render('view', array(
			'model'	=>	$player,
		));
	}

	public function actionIndex()
	{
		$players = array();
		foreach (SteamPlayerModel::model('SteamPlayerModel')->findAll() as $player) {
			if ($player->attendance > 0) $players []= $player;
		}
		usort($players, array($this, 'sortByScore'));
		$this->render('index', array(
			'players' => $players,
		));
	}

	public function sortByScore($a, $b)
	{
		return $b->score - $a->score;
	}

}

/** vim: set noet ts=4 sw=4 fdm=indent : */
