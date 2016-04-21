<?php

class HeroController extends Controller
{

	public function actionHistory($id)
	{
		$hero = $this->loadHero($id);
		$this->renderJson(array('basic' => $hero->attributes, 'history' => $hero->matches));
	}

	protected function loadHero($id)
	{
		$model = HeroModel::model('HeroModel')->findByPK($id);
		if (!is_object($model)) {
			throw new CHttpException(404, 'no hero found with id: ' . $id);
		}
		return $model;
	}

	public function actionView($id)
	{
		$hero = $this->loadHero($id);
		$this->render('view', array(
			'model'	=>	$hero,
		));
	}

	public function actionIndex()
	{
		$heroes = array();
		foreach (HeroModel::model('HeroModel')->findAll() as $hero) {
			if ($hero->attendance > 0) $heroes []= $hero;
		}
		usort($heroes, array($this, 'sortByAttendance'));
		$this->render('index', array(
			'heroes' => $heroes,
		));
	}

	public function sortByAttendance($a, $b)
	{
		return $b->attendance - $a->attendance;
	}

}

/** vim: set noet ts=4 sw=4 fdm=indent : */
