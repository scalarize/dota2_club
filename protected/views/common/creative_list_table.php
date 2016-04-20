<?php
function filterStats(){
	if(array_key_exists('ListCreativeModel',$_GET)){
		if(array_key_exists('cycle',$_GET['ListCreativeModel'])){
			return 1;
		}else{
			return 0;
		}
	}else{
		return 0;
	}
}
?>
<style>
/*创意筛选和排序*/
.filter_item{
    float:left;
    width:350px;
}
.filter_item .control-label{
    width:100px;
    }
.filter_item .controls{
    margin-left:110px;
}
.icon-eye-open{
	cursor:pointer;
}
/*统计的箭头右移*/
.stat .caret{
	margin-left:50px;
}
.popover-content,.popover{
	max-width: 900px;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
    if(<?php echo filterStats();?> == 1){
        $(".sortForm").show();
        $(".toggle").html("-收起");
    };

    var CACHE={};
    $(document).on("mouseenter",'[data-toggle="popover"]',function(event){
        var o = $(this), cid = o.attr('cid');
        if (CACHE[cid]) {
            console && console.log(cid + ' already triggered preview, skip');
            return;
        }
 
        console && console.log('loading cid preview ' + cid);
        $(".popover").css("display","none");//清空所有弹出框
        o.popover({
            placement:'top',
            trigger: 'hover',
            html:true,
            content:'loading...',
            delay: { hide: 1000 ,show: 1}
        });
        o.popover('show');

        $.get('/rtb/creative/preview/' + cid, function(d) {
            o.data('popover').destroy();
            $(".popover").css("display","none");//清空所有弹出框
            console && console.log('got cid preview content ' + cid);
            CACHE[cid] = d;
            o.on('hover', function(e) {
                $(".popover").css("display","none");//清空所有弹出框
            });
            o.popover({
                trigger: 'hover',
                placement: 'top',
                html: true,
                content: CACHE[cid],
                delay: {hide: 1000 ,show: 1}
            });
            o.popover('show');
            var video = o.data('popover').tip().find('video');
            if (video && video[0]) $(video[0]).play();
        });
    });
});
function setAr(){
	location.hash="cat";
}
</script>
<div>
<a name="cat" id="cat"></a>
<?php
if (Yii::app()->user->checkAccess('task_rw_dsp_ad')) {
	$runDisabled = $model->status == 'running' ? true : false;
	$stopDisabled = $model->status == 'paused' ? true : false;
	$this->widget('bootstrap.widgets.TbButtonGroup', array(
		'buttonType' => 'button',
		'buttons' => array(
			array(
				'label' => '暂停',
				'type' => 'info',
				'url' => '#',
				'htmlOptions' => array('id' => 'stop', 'disabled' => $stopDisabled),
			),
			array(
				'label' => '运行',
				'type' => 'success',
				'url' => '#',
				'htmlOptions' => array('id' => 'run', 'disabled' => $runDisabled),
			),
		),
	));

	if ($model->strategy != NULL) {
		if ($model->strategy->checkVisible()) {
			$this->widget('bootstrap.widgets.TbButton', array(
				'label'=>'新建创意',
				'type'=>'success',
				'url'=>'/rtb/creative/create/strategy_id/'.$model->strategy->id,
				'htmlOptions'=>array('class'=>'pull-right'),
			));
			$this->widget('bootstrap.widgets.TbButton', array(
				'label' => '批量创建创意',
				'type' => 'success',
				'url' => '/rtb/creative/multiCreate/strategy_id/' . $model->strategy->id,
				'htmlOptions'	=> array('class' => 'pull-right'),
			));
			$this->widget('bootstrap.widgets.TbButton', array(
				'label' => '创建程序化创意',
				'type' => 'success',
				'url' => '/rtb/creative/programmaticCreate/strategy_id/' . $model->strategy->id,
				'htmlOptions'	=> array('class' => 'pull-right'),
			));
		}
		//这里要求如果是view页面，就不再显示查看推广组信息的按钮了
		if(!strstr($_SERVER['REQUEST_URI'],'view')){
			$this->widget('bootstrap.widgets.TbButton', array(
				'label'=>'查看推广组信息',
				'type'=>'success',
				'url'=>'/rtb/strategy/view/id/'.$model->strategy->id,
				'htmlOptions'=>array('class'=>'pull-right'),
			));
		}
?>
<?php $cdt = array('win'=>'WIN', 'imp'=>'展现','clk'=>'点击','ctr'=>'CTR','ctwr'=>'CTWR', 'act'=>'激活','cpa'=>'A单价','actrate'=>'激活率');?>
<div>
<div style="float:right;margin-top:20px;">
<span>排序:</span>
<?php foreach($cdt as $key=>$value):?>

	<form method="get" style="display:inline;">
<?php
$params = $_GET;
unset($params['ListCreativeModel']['sort'],$params['ListCreativeModel']['statData']);
foreach($params as $key1=>$value1){
	if(is_array($value1)){
		foreach($params[$key1] as $key2=>$value2){
			echo '<input type="hidden" name="'.$key1.'['.$key2.']" value="'.$value2.'">';
		}
	}else{
		echo '<input type="hidden" name="'.$key1.'" value="'.$value1.'">';
	}
}
?>
<?php if($_GET['ListCreativeModel']['statData'] == $key):?>
	<?php if($_GET['ListCreativeModel']['sort'] == 2):?>
		<input name="ListCreativeModel[sort]" value="1" type="hidden">
	<?php else:?>
		<input name="ListCreativeModel[sort]" value="2" type="hidden">
	<?php endif;?>
<?php else:?>
	<input name="ListCreativeModel[sort]" value="1" type="hidden">
<?php endif;?>
<button name="ListCreativeModel[statData]" value="<?php echo $key?>" type="submit" style="border:1px solid #ccc;background-color:#fff;outline:none;" onclick="setAr();"><?php echo $value;?>
<?php if($_GET['ListCreativeModel']['statData'] == $key):?>
	<?php if($_GET['ListCreativeModel']['sort'] == 2):?>
		<i class="caret" style="margin-top:8px;border-top:none;border-bottom:4px solid #000000;"></i>
	<?php else:?>
		<i class="caret" style="margin-top:8px;"></i>
	<?php endif;?>
<?php endif;?>
</button>
</form>
<?php endforeach;?>
</div>
</div>
<?php
Yii::app()->params['visible'] = 'hide';   
	}}?>

<?php
$columns = array(
	array(
		'class' => 'CCheckBoxColumn',
		'selectableRows' => 2,
		'value' => '$data["id"]',
		'id' => 'id',
	),
	array(
		'class' => 'CLinkColumn',
		'header' => '创意名称',
	'labelExpression' => '$data->name."<BR/>ID: ".$data->id',
		'urlExpression' => '"/rtb/creative/view/" . $data->id',
	'htmlOptions' => array('style' => 'max-width: 200px; overflow: hidden'),
	),
	array(
		'name' => '运行状态',
		'class' => 'CCreativeStatusColumn',
	),
	array(
		'class' => 'CLinkColumn',
		'header' => '广告主账号',
		'labelExpression' => '$data->sponsor->email',
		'urlExpression' => '"/rtb/creative/list/uid/" . $data->sponsor_id',
		'linkHtmlOptions' => array('target' => '_blank'),
		'htmlOptions' => array('style' => 'max-width: 80px; overflow: hidden'),
	),
	array(
		'name' => '创意类型',
		'type' => 'raw',
		'value' => 'implode("<br />", array($data->displayTypeText, $data->adStandardText, $data->sourceTypeText))',
	),
	array(
		'name' => '各交易所审核状态',
		'class' => 'CreativeExchangeAuditStatusColumn',
		'htmlOptions' => array('style' => 'width:180px'),
	),
	array(
		'name' => '创意尺寸',
		'class' => 'CreativeSizeFilterColumn',
	),
	array(
		'name' => '今日统计摘要',
		'class' => 'CreativeUnitStatsSummaryColumn',
		'htmlOptions' => array('style' => 'width:200px'),
	),
	array(
		'class' => 'bootstrap.widgets.TbButtonColumn',
		'header' => '操作',
		'buttons' => array(
			'edit' => array(
				'label' => "编辑",
				'options'=>array('class'=>'label'),
				'url' => '"/rtb/creative/edit/" . $data->id',
				'visible' => '$data->checkVisible() && Yii::app()->user->checkAccess("task_rw_dsp_ad")',
			),
			'copy' => array(
				'label' => "复制",
				'options'=>array('class'=>'label'),
				'url' => '"/rtb/creative/copy?fromPage=list&id=" . $data->id',
				'visible' => '$data->checkVisible() && Yii::app()->user->checkAccess("task_rw_dsp_ad")',
			),
			'createByCopy' => array(
				'label' => "复制并新建创意",
				'options'=>array('class'=>'label'),
				'url' => '"/rtb/creative/createByCopy?strategy_id=$data->strategy_id&id=" . $data->id',
				'visible' => '$data->checkVisible() && Yii::app()->user->checkAccess("task_rw_dsp_ad")',
			),
		),
		'updateButtonImageUrl' => false,
		'template' => ' {createByCopy}',
		'htmlOptions' => array('class' => 'span2'),
	),
);
$this->widget('bootstrap.widgets.TbGridView', array(
	'type' => 'striped',
	'dataProvider' => $model->data,
	'columns' => $columns,
	'enableSorting' => false,
	'htmlOptions' => array('style'=>'word-break:break-word;margin-top:40px;'),
	'pager' => array(
		'cssFile' => Yii::app()->baseUrl.'/css/pager.css',
		'header' => '',
		'firstPageLabel' => '首页',
		'lastPageLabel' => '尾页',
		'prevPageLabel' => '上一页',
		'nextPageLabel' => '下一页',
	),
	'pagerCssClass' => 'pager',
	'summaryText' => '{count}条信息，共{pages}页',
	'enableHistory' =>true,
	'beforeAjaxUpdate' => 'js:function(){$(".spinner").css("display","block")}',
	'afterAjaxUpdate' => 'js:function(){$(".spinner").css("display","none");$("td a[rel=tooltip]").each(function(){if($(this).children(\'i\').length == 0) {if(!$(this).hasClass("disable_button")) {$(this).addClass("list_button");$(".list_hidden_button").hide();}}})}',
	'emptyText' => '无数据',
));
?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">提示</h4>
	  </div>
	  <div class="modal-body">
		<span id="modalContent"></span>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
		<button type="button" class="btn btn-primary" id="submit">提交</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
(function($){
	$(document).ready(function(){
		registerOperation('run', '/rtb/creative/resume', '恢复');
		registerOperation('stop', '/rtb/creative/pause', '暂停');
	});
})(jQuery);
</script>
<?php
	$this->renderPartial("../common/spinner" );
?>
