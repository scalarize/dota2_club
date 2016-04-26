<?php

$columns = array(
	array(
		'header' => '',
		'value' => '$row+1',
		'headerHtmlOptions' => array('style' => 'width: 80px'),
		'htmlOptions' => array('style' => 'width: 80px'),
	),
	array(
		'class' => 'CLinkColumn',
		'header' => '',
		'urlExpression' => '"/player/" . $data->player->id',
		'labelExpression' => 'sprintf("<img class=\"player-avatars-img\" src=\"%s\" /> %s", $data->player->avatarUrl, $data->player->steamName)',
		'headerHtmlOptions' => array('style' => 'width: 180px'),
		'htmlOptions' => array('style' => 'width: 180px'),
	),
	array(
		'name' => 'count',
		'headerHtmlOptions' => array('style' => 'width: 60px'),
		'htmlOptions' => array('style' => 'width: 60px'),
	),
	array(
		'name' => 'win',
		'headerHtmlOptions' => array('style' => 'width: 60px'),
		'htmlOptions' => array('style' => 'width: 60px'),
	),
	array(
		'name' => 'winrate',
		'type' => 'number',
		'headerHtmlOptions' => array('style' => 'width: 60px'),
		'htmlOptions' => array('style' => 'width: 60px'),
	),
	array(
		'name' => 'player.currentRank',
		'headerHtmlOptions' => array('style' => 'width: 60px'),
		'htmlOptions' => array('style' => 'width: 60px'),
	),
	array(
		'name' => 'kda',
		'headerHtmlOptions' => array('style' => 'width: 60px'),
		'htmlOptions' => array('style' => 'width: 60px'),
	),
	array(
		'name' => 'gpm',
		'headerHtmlOptions' => array('style' => 'width: 60px'),
		'htmlOptions' => array('style' => 'width: 60px'),
	),
	array(
		'name' => 'xpm',
		'headerHtmlOptions' => array('style' => 'width: 60px'),
		'htmlOptions' => array('style' => 'width: 60px'),
	),
	'extra',
);

$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider' => new CArrayDataProvider(array_values($model->opponents), array(
		'pagination' => false,
		'sort' => array(
			'attributes' => array(
				'count' => array(
					'label' => '场次',
					'default' => 'desc',
				),
				'win' => array(
					'label' => '胜场',
					'default' => 'desc',
				),
				'winrate' => array(
					'label' => '胜率',
					'default' => 'desc',
				),
				'player.currentRank' => array(
					'label' => '当前实力',
					'default' => 'desc',
				),
				'kda' => array(
					'label' => 'KDA',
					'default' => 'desc',
				),
				'gpm' => array(
					'label' => 'GPM',
					'default' => 'desc',
				),
				'xpm' => array(
					'label' => 'XPM',
					'default' => 'desc',
				),
			),
		),
	)),
	'columns' => $columns,
	'rowCssClassExpression' => '$data->win > $data->lose ? "lose" : "win"',
	'htmlOptions' => array('style' => 'table-layout: fixed'),
));

/** vim: set fdm=indent: */
