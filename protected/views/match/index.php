<h2>D.O.T.A. 赛季: <?php echo $season; ?></h2>

<?php
$columns = array(
	array(
		'class' => 'CLinkColumn',
		'header' => 'id',
		'urlExpression' => '"/match/" . $data->id',
		'labelExpression' => '$data->match_id',
		'headerHtmlOptions' => array('style' => 'width: 120px'),
		'htmlOptions' => array('style' => 'width: 120px'),
	),
	array(
		'name' => 'date',
		'headerHtmlOptions' => array('style' => 'width: 220px'),
		'htmlOptions' => array('style' => 'width: 220px'),
	),
	array(
		'header' => '胜方',
		'value' => '$data->winnerText',
		'headerHtmlOptions' => array('style' => 'width: 120px'),
		'htmlOptions' => array('style' => 'width: 120px'),
	),
	array(
		'header' => '用时',
		'value' => '$data->duration',
		'headerHtmlOptions' => array('style' => 'width: 120px'),
		'htmlOptions' => array('style' => 'width: 120px'),
	),
	'extra',
);

$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider' => new CArrayDataProvider($matches, array('pagination' => false)),
	'columns' => $columns,
	'htmlOptions' => array('style' => 'table-layout: fixed'),
));

