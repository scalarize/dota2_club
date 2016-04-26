<h2>D.O.T.A. 赛季: <?php echo $season; ?></h2>

<?php

$playerList = array('0' => '全部');
foreach ($players as $player) {
	$playerList[$player->id] = $player->steamName;
}
$resultList = array('0' => '无所谓', '1' =>'胜', '2' => '负');

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => '/match/',
	'method' => 'GET',
));

echo $form->dropDownList($model, 'player', $playerList, array(
	'name' => 'player',
));
echo $form->dropDownList($model, 'result', $resultList, array(
	'name' => 'result',
));
$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type' =>'primary', 'label'=>'查询'));
$this->endWidget();

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
		'highlight' => $model->player,
		'headerHtmlOptions' => array('style' => 'width: 240px'),
		'htmlOptions' => array('style' => 'width: 240px'),
	),
	array(
		'class' => 'MatchAttandentsColumn',
		'header' => '夜魇',
		'name' => 'dire',
		'highlight' => $model->player,
		'headerHtmlOptions' => array('style' => 'width: 240px'),
		'htmlOptions' => array('style' => 'width: 240px'),
	),
	'extra',
);

$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider' => new CArrayDataProvider($matches, array('pagination' => false)),
	'columns' => $columns,
	'htmlOptions' => array('style' => 'table-layout: fixed'),
));

/** vim: set noet fdm=indent : */

