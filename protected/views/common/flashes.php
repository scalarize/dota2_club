<div id="messages">

<?php $this->widget('bootstrap.widgets.TbAlert', array(
	'block'=>false,
	'fade'=>true,
	'closeText'=>'&times;',
	'htmlOptions'=>array('id'=>'flash'),
)); 
?>
<script type="text/javascript">
	<!--
	var closeFlashAlert = function() {
		$("#flash").alert('close');
	}
	setTimeout("closeFlashAlert()", 3500);
	//-->
</script>
</div>
