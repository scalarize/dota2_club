<?php

class IndexController extends Controller
{

	public $defaultAction = 'S2';

	public function actionS2()
	{
		$this->redirect('/match/');
		$this->render('season', array(
			'season'	=>	'2016s2',
		));
	}

	public function actionS1()
	{
		$this->render('season', array(
			'season'	=>	'2016s1',
		));
	}

}


