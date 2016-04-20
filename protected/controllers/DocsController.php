<?php

class DocsController extends Controller
{

	public function actionView($id = '')
	{
		$content = file_get_contents(dirname(__FILE__) . '/../docs/' . $id . '.md');
		$this->render('view', array(
			'doc' => $id,
			'content' => $content,
		));
	}

}

