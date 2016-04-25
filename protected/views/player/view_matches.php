<?php

$columns = array(
	array(
		'class' => 'CLinkColumn',
		'header' => 'steam ID',
		'urlExpression' => '"/match/" . $data->info->id',
		'labelExpression' => '$data->info->match_id',
		'headerHtmlOptions' => array('style' => 'width: 100px'),
		'htmlOptions' => array('style' => 'width: 100px'),
	),
	array(
		'header' => '时间',
		'name' => 'info.date',
		'headerHtmlOptions' => array('style' => 'width: 180px'),
		'htmlOptions' => array('style' => 'width: 180px'),
	),
	array(
		'header' => '胜方',
		'value' => '$data->info->winnerText',
		'headerHtmlOptions' => array('style' => 'width: 60px'),
		'htmlOptions' => array('style' => 'width: 60px'),
	),
	array(
		'header' => '用时',
		'value' => '$data->info->duration',
		'headerHtmlOptions' => array('style' => 'width: 80px'),
		'htmlOptions' => array('style' => 'width: 80px'),
	),
	array(
		'class' => 'CLinkColumn',
		'header' => '出场英雄',
		'urlExpression' => '"/hero/" . $data->hero->id',
		'labelExpression' => 'sprintf("<img src=\"%s\" class=\"match-avatars-img\" />",
					$data->hero->avatarUrl)',
		'headerHtmlOptions' => array('style' => 'width: 80px'),
		'htmlOptions' => array('style' => 'width: 80px'),
	),
	array(
		'header' => '战果',
		'value' => '$data->win > 0 ? "胜利" : "失败"',
		'headerHtmlOptions' => array('style' => 'width: 50px'),
		'htmlOptions' => array('style' => 'width: 50px'),
	),
	array(
		'header' => 'KDA',
		'type' => 'raw',
		'value' => 'str_replace(" ", "&nbsp;", sprintf("%2d.%1d %2d/%2d/%2d", $data->kda, $data->kda * 10 % 10,
				$data->kills, $data->deaths, $data->assists))',
		'headerHtmlOptions' => array('style' => 'width: 160px'),
		'htmlOptions' => array('style' => 'width: 160px'),
	),
	array(
		'header' => '参战率',
		'value' => 'sprintf("%.1f%%", $data->participation * 100)',
		'headerHtmlOptions' => array('style' => 'width: 80px'),
		'htmlOptions' => array('style' => 'width: 80px'),
	),
	array(
		'header' => 'GPM',
		'value' => 'sprintf("%d", $data->gpm)',
		'headerHtmlOptions' => array('style' => 'width: 80px'),
		'htmlOptions' => array('style' => 'width: 80px'),
	),
	array(
		'header' => 'XPM',
		'value' => 'sprintf("%d", $data->xpm)',
		'headerHtmlOptions' => array('style' => 'width: 80px'),
		'htmlOptions' => array('style' => 'width: 80px'),
	),
	'extra',
);

$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider' => new CArrayDataProvider(array_reverse($model->matches), array(
		'pagination' => false,
	)),
	'columns' => $columns,
	'rowCssClassExpression' => '$data->win > 0 ? "win" : "lose"',
	'htmlOptions' => array('style' => 'table-layout: fixed'),
));

/** vim: set fdm=indent: */
