/* *
 * Jquery plugin: dateRange, 一个基于datepicker的选择时间段的弹框 jQuery plugin
 * 
 * liuwenbo@domob.cn 2015-08-05
 */
;(function($){
	$.subscribe('click_daterange_show',__showSelector);
	$.subscribe('click_daterange_hide',__hideSelector);
	$.subscribe('click_daterange_select',__selectDates);
	$.subscribe('click_daterange_quick_range',__quickRange);
	var ENVOBJ = ENVOBJ || (window.ENVOBJ = {});
/*
	增加或减少天数。
*/
function dateDays(date, days){
	return new Date((new Date(date)).valueOf() + days*24*3600*1000);
}
	function __showSelector(target){
		var $t=$(target), 
			$dateRange=$('#dateRange'),
			scroll = $(window).scrollTop()+$(window).height(),
			tPos = $t.offset()
			;
		$dateRange.addClass('dateRange_expanded');
		ENVOBJ.plugin.dateRange['serving'] = $t;

		tPos.width = $t.width();
		tPos.height = $t.height();
		if($t.is('button, input')){
			tPos.height = $t.parent().height();
			tPos.width = $t.parent().width();
		}

		if(scroll<(tPos.top+$dateRange.height()+tPos.height) && $dateRange.height()<tPos.top-$(window).scrollTop()){
			$dateRange.css("top", tPos.top - $dateRange.height() - 6); //up
		}else{
			$dateRange.css("top", tPos.top + tPos.height + 6); //down
		}
		if(document.body.clientWidth/2>tPos.left){
			$dateRange.css("left", tPos.left); //left
		}else{
			$dateRange.css("left", tPos.left - $dateRange.width() +tPos.width); //right
		}
		ENVOBJ.plugin.dateRange['start'].datepicker('option', 'minDate', $t.data('minDate')||null);
		ENVOBJ.plugin.dateRange['start'].datepicker('option', 'maxDate', $t.data('maxDate')||null);
		ENVOBJ.plugin.dateRange['end'].datepicker('option', 'maxDate', $t.data('maxDate')||null);

		__setDates($t.data('rangeStart'), $t.data('rangeEnd'));
		$(window).trigger('resize');
	}
	function __hideSelector(){
		$('#dateRange').removeClass('dateRange_expanded');
		__setDates(new Date(), new Date());
	}
	function __selectDates(){
		var startDate = $('#dateRange-date-start').val(),
			endDate = $('#dateRange-date-end').val(),
			$serving = ENVOBJ.plugin.dateRange['serving'],
			onSelect = $serving.data('onSelect')
			;
		console.log('select:', startDate, endDate);
		$serving.data({
			'rangeStart':startDate,
			'rangeEnd':endDate
		}).val(startDate + $serving.data('separator') + endDate).change();

		if(typeof onSelect == "function"){
			onSelect.call($serving, startDate, endDate);
		}
		__hideSelector();
	}
	function __setDates(start, end){
		console.log('set:', start, end);
		if(start){
			ENVOBJ.plugin.dateRange['start'].datepicker("setDate", start)
			ENVOBJ.plugin.dateRange['end']
				.datepicker('option', 'minDate', ENVOBJ.plugin.dateRange['start'].datepicker('getDate'))
				.datepicker("setDate", new Date());
		}
		if(end){
			ENVOBJ.plugin.dateRange['end'].datepicker("setDate", end)
		}
		$('#dateRange-date-start-text span').html($('#dateRange-date-start').val());
		$('#dateRange-date-end-text span').html($('#dateRange-date-end').val());
	}
	function __dateWhenZero(date){
		var date = new Date(date);
		date.setHours(0);
		return date;
	}
	function __quickRange (target, e) {
		var $t=$(e.target),
			range = ENVOBJ.plugin.dateRange['quickRanges'][$t.data('range')];

		if(range)
			__setDates(range.start, range.end);
	}
	/*
		{
			'today': {text:"今天", start: today, end: today}
		}
	*/
	function __buildQuickRanges (ranges) {
		var tmpHTML=[];
		for (var key in ranges) {
			if(ranges.hasOwnProperty(key))
				tmpHTML.push('<li><a href="javascript:void(0)" data-range="'+key+'">'+ranges[key].text+'</a></li>')
		};
		return tmpHTML.join('')
	}

	$.fn.extend({
		dateRange:function(setting){ 
			var today = __dateWhenZero(new Date()),
				setting = $.extend({
					"minDate": undefined,
					"maxDate": undefined,
					// "quickRanges": ['today', 'yesterday', '7days', '30days', 'thisMonth', 'lastMonth'],
					"quickRanges": {
						'today': {text:"今天", start: today, end: today},
						'yesterday': {text:"昨天", start: dateDays(today, -1), end: dateDays(today, -1)},
						'7days': {text:"近7天", start: dateDays(today, -6), end: today},
						'30days': {text:"近30天", start: dateDays(today, -29), end: today},
						'thisMonth': {text:"本月", start: new Date((new Date()).setDate(1)), end: today},
						'lastMonth': {text:"上个月", start: new Date(today.getFullYear(), today.getMonth()-1, 1), end: new Date((new Date()).setDate(0))}
					},
					"initRange":{
						"start": dateDays(new Date(), -1),
						"end": new Date()
					},
					"separator": ' ~ ',
					"onSelect": function(){}
				}, setting),
				dateRangeInputs = this;
			console.log(setting);

			if(setting.minDate)setting.minDate=__dateWhenZero(setting.minDate);
			if(setting.maxDate)setting.maxDate=__dateWhenZero(setting.maxDate);
			setting.initRange.start=__dateWhenZero(setting.initRange.start);
			setting.initRange.end=__dateWhenZero(setting.initRange.end);

			function initSelector(){
				var tmpHTML=[
					'<div id="dateRange" class="modal">',
						'<div class="modal-dialog daterange-selector">',
							'<input type="hidden" id="dateRange-date-start">',
							'<input type="hidden" id="dateRange-date-end">',
							'<div class="modal-header">',
								'<ul class="ac ac_daterange_quick_range">',
									__buildQuickRanges(setting.quickRanges),
								'</ul>',
							'</div>',
							'<div class="modal-content">',
								'<div class="modal-body">',
									'<div class="pikers row-fluid">',
										'<div class="picker span6">',
											'<h4 id="dateRange-date-start-text">开始日期：<span>2015-08-07</span></h4>',
											'<div id="dateRange-date-start-selector"></div>',
										'</div>',
										'<div class="picker span6">',
											'<h4 id="dateRange-date-end-text">结束日期：<span>2015-08-07</span></h4>',
											'<div id="dateRange-date-end-selector"></div>',
										'</div>',
									'</div>',
								'</div>',
								'<div class="modal-footer">',
									'<button class="btn btn-primary ac ac_daterange_select">确定</button>',
									'<button class="btn btn-default ac ac_daterange_hide">取消</button>',
								'</div>',
							'</div>',
						'</div>',
					'</div>'
				].join("\n");

				$(document.body).append(tmpHTML);
				//时间
				var $startDateTextBox = $('#dateRange-date-start-selector');
				var $endDateTextBox = $('#dateRange-date-end-selector');
				$startDateTextBox.datepicker({
					inline: true,
					altField: $('#dateRange-date-start'),
					onSelect: function (selectedDateTime){
						$endDateTextBox.datepicker('option', 'minDate', $startDateTextBox.datepicker('getDate'));
						$('#dateRange-date-start-text span').html($('#dateRange-date-start').val());
						$('#dateRange-date-end-text span').html($('#dateRange-date-end').val());
					}
				});
				$endDateTextBox.datepicker({
					inline: true, 
					altField: $('#dateRange-date-end'),
					onSelect: function (selectedDateTime){
						$('#dateRange-date-end-text span').html($('#dateRange-date-end').val());
					}
				});
				$startDateTextBox.datepicker('option', 'maxDate', setting.initRange.start || new Date());
				$endDateTextBox.datepicker('option', 'minDate', $startDateTextBox.datepicker('getDate'));
				$('#dateRange-date-start-text span').html($('#dateRange-date-start').val());
				$('#dateRange-date-end-text span').html($('#dateRange-date-end').val());
				ENVOBJ.plugin = ENVOBJ.plugin || {};
				ENVOBJ.plugin.dateRange = ENVOBJ.plugin.dateRange || {};
				ENVOBJ.plugin.dateRange['start'] = $startDateTextBox;
				ENVOBJ.plugin.dateRange['end'] = $endDateTextBox;
				ENVOBJ.plugin.dateRange['quickRanges'] = setting.quickRanges;

				if(setting.initRange.start||setting.initRange.end){
					dateRangeInputs.each(function(){
						ENVOBJ.plugin.dateRange['serving'] = $(this);
						ENVOBJ.plugin.dateRange['start'].datepicker('setDate', setting.initRange.start || new Date());
						ENVOBJ.plugin.dateRange['end'].datepicker('setDate', setting.initRange.end || new Date());
						$.publish('click_daterange_select');
					});
				}
			}
			
			if(!$('#dateRange').length){
				setTimeout(initSelector, 0);
			}
			return this.each(function(){
				var $this=$(this);

				$this.addClass('ac ac_daterange_show').data({
					'rangeStart': setting.initRange.start,
					'rangeEnd': setting.initRange.end,
					'minDate':setting.minDate,
					'maxDate':setting.maxDate,
					'separator':setting.separator,
					'onSelect':setting.onSelect
				});
			});
		}
	});
})(jQuery);