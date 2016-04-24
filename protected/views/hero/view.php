<?php

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
	'links' => array(
		'出场英雄' => '/hero/',
		$model->chinese_name,
	),
));

$this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
		'name',
		'chinese_name',
		'attendance',
		'win',
		'banned',
	),
));

$columns = array(
	array(
		'class' => 'CLinkColumn',
		'header' => 'id',
		'urlExpression' => '"/match/" . $data->info->id',
		'labelExpression' => '$data->info->match_id',
		'headerHtmlOptions' => array('style' => 'width: 120px'),
		'htmlOptions' => array('style' => 'width: 120px'),
	),
	array(
		'header' => '日期',
		'name' => 'info.date',
		'headerHtmlOptions' => array('style' => 'width: 220px'),
		'htmlOptions' => array('style' => 'width: 220px'),
	),
	array(
		'header' => '胜方',
		'value' => '$data->info->winnerText',
		'headerHtmlOptions' => array('style' => 'width: 120px'),
		'htmlOptions' => array('style' => 'width: 120px'),
	),
	array(
		'header' => '用时',
		'value' => '$data->info->duration',
		'headerHtmlOptions' => array('style' => 'width: 120px'),
		'htmlOptions' => array('style' => 'width: 120px'),
	),
	array(
		'header' => '使用者',
		'class' => 'CLinkColumn',
		'urlExpression' => '"/player/" . $data->player->id',
		'labelExpression' => '$data->player->name',
		'headerHtmlOptions' => array('style' => 'width: 160px'),
		'htmlOptions' => array('style' => 'width: 160px'),
	),
	array(
		'header' => '战果',
		'value' => '$data->win > 0 ? "胜利" : "失败"',
		'headerHtmlOptions' => array('style' => 'width: 120px'),
		'htmlOptions' => array('style' => 'width: 120px'),
	),
	array(
		'header' => 'KDA',
		'type' => 'raw',
		'value' => 'str_replace(" ", "&nbsp;", sprintf("%2d/%2d/%2d", $data->kills, $data->deaths, $data->assists))',
		'headerHtmlOptions' => array('style' => 'width: 160px'),
		'htmlOptions' => array('style' => 'width: 160px'),
	),
	array(
		'header' => '参战率',
		'value' => 'sprintf("%.1f%%", $data->participation * 100)',
		'headerHtmlOptions' => array('style' => 'width: 120px'),
		'htmlOptions' => array('style' => 'width: 120px'),
	),
	array(
		'header' => 'GPM',
		'value' => 'sprintf("%d", $data->gpm)',
		'headerHtmlOptions' => array('style' => 'width: 120px'),
		'htmlOptions' => array('style' => 'width: 120px'),
	),
	array(
		'header' => 'XPM',
		'value' => 'sprintf("%d", $data->xpm)',
		'headerHtmlOptions' => array('style' => 'width: 120px'),
		'htmlOptions' => array('style' => 'width: 120px'),
	),
	'extra',
);

$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider' => new CArrayDataProvider(array_reverse($model->matches), array(
		'pagination' => false,
	)),
	'rowCssClassExpression' => '$data->win > 0 ? "win" : "lose"',
	'columns' => $columns,
	'htmlOptions' => array('style' => 'table-layout: fixed'),
));

/** vim: set fdm=indent: */
