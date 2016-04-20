<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/plugin/bootSideMenu/BootSideMenu.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/plugin/bootSideMenu/BootSideMenu.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/debug.css');
?>
<div class="debug_sidebar">
	<div class="debug_sidebar_container">
	<div class="debug_title"><?php $time = Yii::getLogger()->getExecutionTime(); echo '总计执行时间：'.number_format($time, 3)."s";?></div>
	<?php 
		foreach(Debug::spent() as $key => $cost){
			if($cost<50) {
				$class = "cost_time_success";
			}else if($cost >= 50 && $cost <= 100){
				$class = "cost_time_warning";
			}else{
				$class = "cost_time_error";
			}
			echo "<div class=\"debug_siderbar_unit $class debug_time_cost\"><font color=pink>$cost</font> | ".array_shift(explode("_", $key));
			echo"</div>";
		}
		foreach(Debug::getDebugInfo() as $key => $info){
			echo "<div class=\"debug_siderbar_unit debug_info\">".array_shift(explode("_", $key))."<br><pre class=debug_pre>".CVarDumper::dumpAsString($info);
			echo"</pre></div>";
		}
	?>

	<div class="debug_foot">这里将会显示一些模块的耗时信息<br>绿色：<50ms<br>黄色：<100ms<br>红色：>100ms<br><br>如果你也想监控某一个底层的定时，<br>请在代码块开始的时候增加Debug::start();<br>在代码返回之前加上Debug::stop();<br>或者使用 Debug::setDebugInfo($message)<br>如果你还需要更多信息，请看rtb.debug.log文件</div>
</div>
</div>
<script>
$('.debug_sidebar').BootSideMenu({
side:"right",
autoClose:true
});
</script>
