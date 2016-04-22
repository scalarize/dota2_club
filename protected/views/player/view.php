<?php

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
	'links' => array(
		'全部选手' => '/player/',
		$model->name,
	),
));

$this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'name',
		'form',
		'rank_score',
		'currentRank',
		'score',
		'attendance',
		'win',
		'kda',
		'gpm',
		'xpm',
	),
));

$params = $_GET;
$items = array();
foreach (array('matches' => '比赛', 'teammates' => '队友', 'opponents' => '对手', 'heroes' => '英雄') as $tab => $label) {
	$params['tab'] = $tab;
	$items []= array(
		'label' => $label,
		'url' => $this->createUrl('/player/view', $params),
		'active' => $model->tab == $tab,
	);
}

$this->widget('bootstrap.widgets.TbMenu', array(
	'type' => 'tabs',
	'stacked' => false,
	'items' => $items,
));

$this->renderPartial('view_' . $model->tab, array(
	'model' => $model,
));
