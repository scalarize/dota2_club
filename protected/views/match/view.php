<?php
$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
	'links' => array(
		'全部比赛' => '/match/',
		$model->match_id,
	),
));

$this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'match_id',
		'date',
		'duration',
		'winnerText',
	),
));

$columns = array(
	// 'steamName',
	array(
		'class' => 'CLinkColumn',
		'header' => '选手',
		'urlExpression' => '"/player/" . $data->id',
		'labelExpression' => '$data->name',
		'headerHtmlOptions' => array('style' => 'width: 120px'),
		'htmlOptions' => array('style' => 'width: 120px'),
	),
	array(
		'header' => '英雄',
		'name' => 'match.hero.chinese_name',
		'headerHtmlOptions' => array('style' => 'width: 120px'),
		'htmlOptions' => array('style' => 'width: 120px'),
	),
	array(
		'header' => 'KDA',
		'type' => 'raw',
		'value' => 'str_replace(" ", "&nbsp;", sprintf("%2d/%2d/%2d", $data->match->kills, $data->match->deaths, $data->match->assists))',
		'headerHtmlOptions' => array('style' => 'width: 160px'),
		'htmlOptions' => array('style' => 'width: 160px'),
	),
	array(
		'header' => '参战率',
		'value' => 'sprintf("%.1f%%", $data->match->participation * 100)',
		'headerHtmlOptions' => array('style' => 'width: 120px'),
		'htmlOptions' => array('style' => 'width: 120px'),
	),
	array(
		'header' => 'GPM',
		'value' => 'sprintf("%d", $data->match->gpm)',
		'headerHtmlOptions' => array('style' => 'width: 120px'),
		'htmlOptions' => array('style' => 'width: 120px'),
	),
	array(
		'header' => 'XPM',
		'value' => 'sprintf("%d", $data->match->xpm)',
		'headerHtmlOptions' => array('style' => 'width: 120px'),
		'htmlOptions' => array('style' => 'width: 120px'),
	),
	'extra',
);

$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider' => new CArrayDataProvider($model->attendants['radiant']),
	'columns' => $columns,
	'htmlOptions' => array('style' => 'table-layout: fixed'),
	'template' => '<h4>天辉</h4> <hr /> {items}',
));

$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider' => new CArrayDataProvider($model->attendants['dire']),
	'columns' => $columns,
	'htmlOptions' => array('style' => 'table-layout: fixed'),
	'template' => '<h4>夜魇</h4> <hr /> {items}',
));

