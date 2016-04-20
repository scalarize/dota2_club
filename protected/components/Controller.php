<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

	public $cachableAction = null;

	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function getMenuItems()
	{
		return array(
			array(
				'label' => '全部比赛',
				'url' => '/match/',
			),
			array(
				'label' => '全部选手',
				'url' => '/player/',
			),
		);
	}

	public function getDocItems()
	{
		$ret = array();
		$docsPath = dirname(__FILE__) . '/../docs/';
		$dir = opendir($docsPath);
		if (!is_resource($dir)) return;

		while(false !== ($file = readdir($dir))){
			if (!preg_match('/\.md$/', $file)) continue;
			$content = file_get_contents($docsPath . $file);
			if(preg_match('/^#(.*)/', $content, $a)){
				$ret[] = array(
					'label' => trim($a[1]),
					'url' => Yii::app()->baseUrl . "/docs/" . str_replace('.md', '.html', $file),
				);
			}
		}
		closedir($dir);
		return $ret;
	}

	public function renderAjaxModel($model)
	{
		$success = !$model->hasErrors();
		if (isset($model->message)) {
			$message = $model->message;
			$data = array(
					'success' => $success,
					'message' => $message,
					'data' => $model->data,
					);
		}
		else {
			$data = array(
					'success' => $success,
					'messages' => $this->getErrorMsg($model->errors),
					'data' => $model->data,
					);
		}
		$this->renderJson($data);
	}

	public function getErrorMsg($errors) {
		$errorMsgs = "";
		if(!empty($errors)) {
			foreach($errors as $key=>$error) {
				foreach($error as $v) {
					$errorMsgs .= $v . '<br/>';
				}
			}
		}
		return trim($errorMsgs, '<br/>');
	}

	public function renderJson($data)
	{
		print(CJSON::encode($data));
	}

	public function tryRenderFromCache($param)
	{
		$key = Yii::app()->request->requestURI . '#' . $param . '#' . BUILD_VERSION;
		$redis = new Redis();
		$redis->connect('localhost', 6379);
		$redis->select(0);
		$content = $redis->get($key);
		if ($content) {
			echo $content;
			die();
		}
	}

	public function renderToCache($param, $content)
	{
		$key = Yii::app()->request->requestURI . '#' . $param . '#' . BUILD_VERSION;
		$redis = new Redis();
		$redis->connect('localhost', 6379);
		$redis->select(0);
		$redis->set($key, $content);
		echo $content;
	}

}

/**

	public function beforeAction($action)
	{
		parent::beforeAction($action);
		if (is_array($this->cachableAction) && isset($this->cachableAction[$action->id])) {
			$latestMatchId = MatchInfoModel::model('MatchInfoModel')->getLatestMatch()->id;
			$this->tryRenderFromCache($latestMatchId);
			ob_start();
		}
	}

	public function afterAction($action)
	{
		parent::afterAction($action);
		if (is_array($this->cachableAction) && isset($this->cachableAction[$action->id])) {
			$latestMatchId = MatchInfoModel::model('MatchInfoModel')->getLatestMatch()->id;
			$content = ob_get_contents();
			ob_end_clean();
			$this->renderToCache($latestMatchId, $content);
		}
	}

}


