<?php

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
	'links' => array(
		'出场英雄' => '/hero/',
		$model->chinese_name,
	),
));

?>
<div>
<div class="pull-left span9">
<?php

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

?>

</div>
<div class="pull-right span2">
<img src="<?php echo $model->avatarUrl; ?>" class="hero-avatars-img-large" />
</div>
</div>

<div class="clearfix"></div>

<?php
$columns = array(
	array(
		'class' => 'CLinkColumn',
		'header' => 'id',
		'urlExpression' => '"/match/" . $data->info->id',
		'labelExpression' => '$data->info->match_id',
		'headerHtmlOptions' => array('style' => 'width: 100px'),
		'htmlOptions' => array('style' => 'width: 100px'),
	),
	array(
		'header' => '日期',
		'name' => 'info.date',
		'headerHtmlOptions' => array('style' => 'width: 150px'),
		'htmlOptions' => array('style' => 'width: 150px'),
	),
	array(
		'header' => '胜方',
		'value' => '$data->info->winnerText',
		'headerHtmlOptions' => array('style' => 'width: 70px'),
		'htmlOptions' => array('style' => 'width: 70px'),
	),
	array(
		'header' => '用时',
		'value' => '$data->info->duration',
		'headerHtmlOptions' => array('style' => 'width: 80px'),
		'htmlOptions' => array('style' => 'width: 80px'),
	),
	array(
		'class' => 'CLinkColumn',
		'header' => '使用者',
		'urlExpression' => '"/player/" . $data->player->id',
		'labelExpression' => 'sprintf("<img class=\"player-avatars-img\" src=\"%s\" /> %s", $data->player->avatarUrl, $data->player->steamName)',
		'headerHtmlOptions' => array('style' => 'width: 180px'),
		'htmlOptions' => array('style' => 'width: 180px'),
	),
	array(
		'header' => '战果',
		'value' => '$data->win > 0 ? "胜利" : "失败"',
		'headerHtmlOptions' => array('style' => 'width: 70px'),
		'htmlOptions' => array('style' => 'width: 70px'),
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
		'headerHtmlOptions' => array('style' => 'width: 70px'),
		'htmlOptions' => array('style' => 'width: 70px'),
	),
	array(
		'header' => 'XPM',
		'value' => 'sprintf("%d", $data->xpm)',
		'headerHtmlOptions' => array('style' => 'width: 70px'),
		'htmlOptions' => array('style' => 'width: 70px'),
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
