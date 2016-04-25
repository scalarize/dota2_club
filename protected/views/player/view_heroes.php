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
		'header' => '英雄',
		'urlExpression' => '"/hero/" . $data->hero->id',
		'labelExpression' => 'sprintf("<img class=\"match-avatars-img\" src=\"%s\" />", $data->hero->avatarUrl)',
		'headerHtmlOptions' => array('style' => 'width: 70px'),
		'htmlOptions' => array('style' => 'width: 70px'),
	),
	array(
		'name' => 'attendance',
		'headerHtmlOptions' => array('style' => 'width: 100px'),
		'htmlOptions' => array('style' => 'width: 100px'),
	),
	array(
		'name' => 'win',
		'headerHtmlOptions' => array('style' => 'width: 100px'),
		'htmlOptions' => array('style' => 'width: 100px'),
	),
	array(
		'name' => 'winrate',
		'type' => 'number',
		'headerHtmlOptions' => array('style' => 'width: 100px'),
		'htmlOptions' => array('style' => 'width: 100px'),
	),
	array(
		'name' => 'kda',
		'headerHtmlOptions' => array('style' => 'width: 100px'),
		'htmlOptions' => array('style' => 'width: 100px'),
	),
	array(
		'name' => 'gpm',
		'headerHtmlOptions' => array('style' => 'width: 100px'),
		'htmlOptions' => array('style' => 'width: 100px'),
	),
	array(
		'name' => 'xpm',
		'headerHtmlOptions' => array('style' => 'width: 100px'),
		'htmlOptions' => array('style' => 'width: 100px'),
	),
	'extra',
);

$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider' => new CArrayDataProvider($model->heroes, array(
		'pagination' => false,
		'sort' => array(
			'attributes' => array(
				'attendance' => array(
					'label' => '出场',
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
	'htmlOptions' => array('style' => 'table-layout: fixed'),
));

/** vim: set fdm=indent :
