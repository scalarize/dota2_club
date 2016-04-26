<?php

class MatchController extends Controller
{

	public function actionDetail($id)
	{
		$match = $this->loadMatch($id);
		$data = $match->attributes;
		$data['winner'] = $match->winner;
		$data['attendants'] = $match->attendants;
		$data['info'] = $match->extraInfo;

		$this->renderJson($data);
	}

	public function actionAll($season = '2016s2')
	{
		$criteria = new CDbCriteria(array(
			'condition' => 'season=?',
			'order' => 'id desc',
			'params' => array($season),
		));
		$matches = MatchInfoModel::model('MatchInfoModel')->findAll($criteria);
		$ret = array();
		foreach ($matches as $match) {
			$row = $match->attributes;
			$row['winner'] = $match->winner;
			$row['attendants'] = $match->attendants;
			$ret []= $row;
		}
		$this->renderJson($ret);
	}

	protected function loadMatch($id)
	{
		$model = MatchInfoModel::model('MatchInfoModel')->findByPK($id);
		if (!is_object($model)) {
			throw new CHttpException(404, 'no match found with id: ' . $id);
		}
		return $model;
	}

	public function actionView($id)
	{
		$model = $this->loadMatch($id);
		$this->render('view', array(
			'model'	=>	$model,
		));
	}

	public function actionIndex($season = '2016s2')
	{
		$model = new MatchInfoModel();
		$model->attributes = $_REQUEST;
		$criteria = new CDbCriteria(array(
			'condition' => 'season=?',
			'order' => 'id desc',
			'params' => array($season),
		));
		$allPlayers = SteamPlayerModel::model('SteamPlayerModel')->findAll();
		$matches = array();
		foreach (MatchInfoModel::model('MatchInfoModel')->findAll($criteria) as $match) {
			if ($model->player) {
				$found = false;
				foreach ($match->attendants as $side => $players) {
					foreach ($players as $player) {
						if ($player->id == $model->player) {
							$found = true;
							if ($model->result == 1 && $player->match->win == 0) break;
							if ($model->result == 2 && $player->match->win > 0) break;
							$matches []= $match;
							break;
						}
					}
					if ($found) break;
				}
			} else {
				$matches []= $match;
			}
		}
		$this->render('index', array(
			'model'		=>	$model,
			'players'	=>	$allPlayers,
			'season'	=>	$season,
			'matches'	=>	$matches,
		));
	}

}
