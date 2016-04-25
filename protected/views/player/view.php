<?php

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
	'links' => array(
		'全部选手' => '/player/',
		$model->name,
	),
));

?>
<div>
<div class="pull-left span9">
<?php

$this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		'name',
		'steamName',
		'form',
		'rank_score',
		'currentRank',
		'score',
		'attendance',
		'win',
		'kda',
		'gpm',
		'xpm',
	),
));

?>

</div>
<div class="pull-right span2">
<img src="<?php echo $model->fullAvatarUrl; ?>" class="match-avatars-img-large" />
</div>
</div>

<div class="clearfix"></div>

<?php

$params = $_GET;
$items = array();
foreach (array('matches' => '比赛', 'teammates' => '队友', 'opponents' => '对手', 'heroes' => '英雄') as $tab => $label) {
	$params['tab'] = $tab;
	$items []= array(
		'label' => $label,
		'url' => $this->createUrl('/player/view', $params),
		'active' => $model->tab == $tab,
	);
}

$this->widget('bootstrap.widgets.TbMenu', array(
	'type' => 'tabs',
	'stacked' => false,
	'items' => $items,
));

$this->renderPartial('view_' . $model->tab, array(
	'model' => $model,
));

/** vim: set noet fdm=indent : */

