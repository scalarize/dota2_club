<?php

class MatchController extends Controller
{

	public function actionDetail($id)
	{
		$match = $this->loadMatch($id);
		$data = $match->attributes;
		$data['winner'] = $match->winner;
		$data['attendants'] = $match->attendants;

		$this->renderJson($data);
	}

	public function actionAll($season = '2016s2')
	{
		$matches = MatchInfoModel::model('MatchInfoModel')->findAll('season=?', array($season));
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
		$matches = MatchInfoModel::model('MatchInfoModel')->findAll('season=?', array($season));
		$this->render('index', array(
			'season'	=>	$season,
			'matches'	=>	$matches,
		));
	}

}
