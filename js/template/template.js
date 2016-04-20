;
(function($){


$(document).ready(function(){
	var attrIndex = 0;
	var sizeIndex = 0;
	$('body').on('click', '.add_customAttrs', function (e) {
		var $t = $(e.target).closest('.controls');
		attrIndex = $t.find('.remove_customAttrs').length > attrIndex ? $t.find('.remove_customAttrs').length : attrIndex;
		$(e.target).closest('p').before([
			'<p>',
				'<input type="text" placeholder="全小写属性标识" name="NGTemplateRecord[customAttrs]['+attrIndex+'][attr]" value="" />',
				'<input type="text" placeholder="显示名称" name="NGTemplateRecord[customAttrs]['+attrIndex+'][label]" value="" />',
				'<input type="text" placeholder="预览值" name="NGTemplateRecord[customAttrs]['+attrIndex+'][val]" value="" />',
				'<button class="btn remove_customAttrs" type="button"><i class="icon-minus"></i></button>',
			'</p>'].join(' '));
		attrIndex++;
	}).on('click', '.remove_customAttrs', function (e) {
		$(e.target).closest('p').remove();
	});
	
	function toggleSizeField($checkbox) {
		if ($checkbox.attr("checked") == "checked") {
			$('#template_sizes_div').hide();
		} else {
			$('#template_sizes_div').show();
		}
	}
	toggleSizeField($('#template_adaptive'));
	$('#template_adaptive').click(function(e){
		toggleSizeField($(this));
	});

	function removeSelectedSize($button) {
			var index = $button.attr("index");
			$button.remove();
			$('#size_'+index+'_width').remove();
			$('#size_'+index+'_height').remove();
	}

	$('.add_template_size').click(function(e){
		var $t = $(e.target).closest('.controls');
		sizeIndex = $t.find('.selected').length > sizeIndex ? $t.find('.selected').length : sizeIndex;
		var tmpHtml = [];
		var width = $('#size_width').val();
		var height = $('#size_height').val();
		tmpHtml.push('<button type="button" class="selected" index="'+sizeIndex+'">'+width+'*'+height+'<span  class=" pull-right" style="color:red">&times;</span></button>');
		tmpHtml.push('<input type="hidden" id="size_'+sizeIndex+'_width" name="sizes['+sizeIndex+'][width]" value="'+width+'">');
		tmpHtml.push('<input type="hidden" id="size_'+sizeIndex+'_height" name="sizes['+sizeIndex+'][height]" value="'+height+'">');
		$('#supported_sizes').closest('div').append(tmpHtml.join(''));
		sizeIndex++;

		$('.selected').click(function(e){
			removeSelectedSize($(this));
		});
	});
	$('.selected').click(function(e){
		removeSelectedSize($(this));
	});


});
})(jQuery);
