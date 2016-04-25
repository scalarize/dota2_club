<h2>D.O.T.A. 赛季: <?php echo $season; ?></h2>

<?php
$columns = array(
	array(
		'class' => 'CLinkColumn',
		'header' => 'steam ID',
		'urlExpression' => '"/match/" . $data->id',
		'labelExpression' => '$data->match_id',
		'headerHtmlOptions' => array('style' => 'width: 100px'),
		'htmlOptions' => array('style' => 'width: 100px'),
	),
	array(
		'header' => '时间',
		'name' => 'date',
		'headerHtmlOptions' => array('style' => 'width: 180px'),
		'htmlOptions' => array('style' => 'width: 180px'),
	),
	array(
		'header' => '胜方',
		'value' => '$data->winnerText',
		'headerHtmlOptions' => array('style' => 'width: 60px'),
		'htmlOptions' => array('style' => 'width: 60px'),
	),
	array(
		'header' => '用时',
		'value' => '$data->duration',
		'headerHtmlOptions' => array('style' => 'width: 80px'),
		'htmlOptions' => array('style' => 'width: 80px'),
	),
	array(
		'class' => 'MatchAttandentsColumn',
		'header' => '天辉',
		'name' => 'radiant',
		'headerHtmlOptions' => array('style' => 'width: 180px'),
		'htmlOptions' => array('style' => 'width: 180px'),
	),
	array(
		'class' => 'MatchAttandentsColumn',
		'header' => '夜魇',
		'name' => 'dire',
		'headerHtmlOptions' => array('style' => 'width: 180px'),
		'htmlOptions' => array('style' => 'width: 180px'),
	),
	'extra',
);

$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider' => new CArrayDataProvider($matches, array('pagination' => false)),
	'columns' => $columns,
	'htmlOptions' => array('style' => 'table-layout: fixed'),
));

/** vim: set noet fdm=indent : */

