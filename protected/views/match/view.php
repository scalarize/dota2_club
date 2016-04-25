<?php
$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
	'links' => array(
		'全部比赛' => '/match/',
		$model->match_id,
	),
));

$this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'match_id',
		'date',
		'duration',
		'winnerText',
	),
));

$columns = array(
	array(
		'class' => 'CLinkColumn',
		'header' => '选手',
		'urlExpression' => '"/player/" . $data->id',
		'labelExpression' => 'sprintf("<img class=\"match-avatars-img\" src=\"%s\" /> %s", $data->avatarUrl, $data->steamName)',
		'headerHtmlOptions' => array('style' => 'width: 180px'),
		'htmlOptions' => array('style' => 'width: 180px'),
	),
	array(
		'class' => 'CLinkColumn',
		'header' => '英雄',
		'urlExpression' => '"/hero/" . $data->match->hero->id',
		'labelExpression' => 'sprintf("<img class=\"match-avatars-img\" src=\"%s\" /> %s", $data->match->hero->avatarUrl, $data->match->hero->chinese_name)',
		'headerHtmlOptions' => array('style' => 'width: 150px'),
		'htmlOptions' => array('style' => 'width: 150px'),
	),
	array(
		'header' => 'KDA',
		'type' => 'raw',
		'value' => 'str_replace(" ", "&nbsp;", sprintf("%2d.%1d %2d/%2d/%2d", $data->match->kda, $data->match->kda * 10 % 10,
				$data->match->kills, $data->match->deaths, $data->match->assists))',
		'headerHtmlOptions' => array('style' => 'width: 160px'),
		'htmlOptions' => array('style' => 'width: 160px'),
	),
	array(
		'header' => '参战率',
		'value' => 'sprintf("%.1f%%", $data->match->participation * 100)',
		'headerHtmlOptions' => array('style' => 'width: 80px'),
		'htmlOptions' => array('style' => 'width: 80px'),
	),
	array(
		'header' => '伤害',
		'type' => 'raw',
		'value' => 'str_replace(" ", "&nbsp;", sprintf("%5d (%3d.%1d%%)",
				$data->match->damage, $data->match->damagePercentage, $data->match->damagePercentage * 10 % 10))',
		'headerHtmlOptions' => array('style' => 'width: 160px'),
		'htmlOptions' => array('style' => 'width: 160px'),
	),
	array(
		'header' => 'GPM',
		'value' => 'sprintf("%d", $data->match->gpm)',
		'headerHtmlOptions' => array('style' => 'width: 80px'),
		'htmlOptions' => array('style' => 'width: 80px'),
	),
	array(
		'header' => 'XPM',
		'value' => 'sprintf("%d", $data->match->xpm)',
		'headerHtmlOptions' => array('style' => 'width: 80px'),
		'htmlOptions' => array('style' => 'width: 80px'),
	),
	'extra',
);
?>

<h4>天辉</h4>
<h5>BANNED
<?php
	foreach ($model->banPicks['ban']['radiant'] as $bp) {
		printf('<a href="/hero/%d"><span class="bp bp-ban"><img class="match-avatars-img gray" src="%s" alter="%s" /></span></a>',
			$bp->hero->id, $bp->hero->avatarUrl, $bp->hero->chinese_name);
	}
?>
</h5>
<h5>PICKED
<?php
	foreach ($model->banPicks['pick']['radiant'] as $bp) {
		printf('<a href="/hero/%d"><span class="bp bp-pick"><img class="match-avatars-img" src="%s" alter="%s" /></span></a>',
			$bp->hero->id, $bp->hero->avatarUrl, $bp->hero->chinese_name);
	}
?>
</h5>
<hr />

<?php

$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider' => new CArrayDataProvider($model->attendants['radiant']),
	'columns' => $columns,
	'itemsCssClass' => 'items table-condensed table-',
	'template' => '{items}',
));
?>

<h4>夜魇</h4>
<h5>BANNED
<?php
	foreach ($model->banPicks['ban']['dire'] as $bp) {
		printf('<a href="/hero/%d"><span class="bp bp-ban"><img class="match-avatars-img gray" src="%s" alter="%s" /></span></a>',
			$bp->hero->id, $bp->hero->avatarUrl, $bp->hero->chinese_name);
	}
?>
</h5>
<h5>PICKED
<?php
	foreach ($model->banPicks['pick']['dire'] as $bp) {
		printf('<a href="/hero/%d"><span class="bp bp-pick"><img class="match-avatars-img" src="%s" alter="%s" /></span></a>',
			$bp->hero->id, $bp->hero->avatarUrl, $bp->hero->chinese_name);
	}
?>
</h5>

<?php

$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider' => new CArrayDataProvider($model->attendants['dire']),
	'columns' => $columns,
	'htmlOptions' => array('style' => 'table-layout: fixed'),
	'template' => '{items}',
));

/** vim: set noet fdm=indent: */

