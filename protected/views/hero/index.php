<h2>D.O.T.A. 出场英雄</h2>

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
		'urlExpression' => '"/hero/" . $data->id',
		'labelExpression' => '$data->chinese_name',
		'headerHtmlOptions' => array('style' => 'width: 100px'),
		'htmlOptions' => array('style' => 'width: 120px'),
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
	'extra',
);

$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider' => new CArrayDataProvider($heroes, array(
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
				'currentRank' => array(
					'label' => '当前实力',
					'default' => 'desc',
				),
				'rankDiff' => array(
					'label' => '赛季成长',
					'default' => 'desc',
				),
				'score' => array(
					'label' => '赛季积分',
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
