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
		$this->renderJson(array('basic' => $player->attributes, 'teammates' => $player->teammates));
	}

	public function actionOpponents($id)
	{
		$player = $this->loadPlayer($id);
		$this->renderJson(array('basic' => $player->attributes, 'opponents' => $player->opponents));
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
		$player->attributes = $_GET;
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
