<h2>D.O.T.A. 菜鸡总动员</h2>

<?php
$columns = array(
	array(
		'header' => '',
		'value' => '$row+1',
		'headerHtmlOptions' => array('style' => 'width: 60px'),
		'htmlOptions' => array('style' => 'width: 60px'),
	),
	array(
		'class' => 'CLinkColumn',
		'header' => '使用者',
		'urlExpression' => '"/player/" . $data->id',
		'labelExpression' => 'sprintf("<img class=\"match-avatars-img\" src=\"%s\" /> %s", $data->avatarUrl, $data->steamName)',
		'headerHtmlOptions' => array('style' => 'width: 180px'),
		'htmlOptions' => array('style' => 'width: 180px'),
	),
	array(
		'name' => 'attendance',
		'headerHtmlOptions' => array('style' => 'width: 60px'),
		'htmlOptions' => array('style' => 'width: 60px'),
	),
	array(
		'name' => 'win',
		'headerHtmlOptions' => array('style' => 'width: 60px'),
		'htmlOptions' => array('style' => 'width: 60px'),
	),
	array(
		'name' => 'lose',
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
		'name' => 'currentRank',
		'headerHtmlOptions' => array('style' => 'width: 60px'),
		'htmlOptions' => array('style' => 'width: 60px'),
	),
	array(
		'name' => 'rankDiff',
		'headerHtmlOptions' => array('style' => 'width: 60px'),
		'htmlOptions' => array('style' => 'width: 60px'),
	),
	array(
		'name' => 'score',
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
	'dataProvider' => new CArrayDataProvider($players, array(
		'pagination' => false,
		'sort' => array(
			'attributes' => array(
				'attendance' => array(
					'label' => '出勤',
					'default' => 'desc',
				),
				'win' => array(
					'label' => '胜场',
					'default' => 'desc',
				),
				'lose' => array(
					'label' => '负场',
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
