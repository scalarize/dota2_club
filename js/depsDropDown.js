/**
* 依赖联动jquery插件
* @author zhengjianbo@domob.cn
* @date 2015-05-25 17:26
*/
;(function ($, window, document, undefined) {
    'use strict';
	var pluginName = "depsDropDown",
		defaults = {
		baseUrl: '/rtb/sponsor/autoExTrade/exchange_id/'
	};

	function DepsDropDown(element, options) {
		this.element = $(element);
		this.settings = $.extend({}, defaults, options);
		this._name = pluginName;
		this.init();
	}

	$.extend(DepsDropDown.prototype, {
		init: function() {
			var selectName = this.element.data('model')+'[exchange_trade_ids]['+this.settings['exchange_id']+']';
			this.element.html('<select class="first-level"></select><select class="second-level" disabled="true" name="'+
				selectName+'"></select>');
			var secondVal = this.element.data('value');
			var emptyVal = secondVal==""?true:false;
			var vals=null;
			if(!emptyVal){
				vals = secondVal.split('>');
			}else{
				vals = [null, null];
			}
			this.getOptions(this.settings['baseUrl']+
			this.settings['exchange_id'], 
			this.element.find('.first-level'), vals[0]);
			var that = this;
			this.element.find('.first-level').change(function(){
				that.element.find('.second-level').prop('disabled', false);
				var pid = that.element.find('.first-level').val();
				var second = that.settings['baseUrl']+
				that.settings['exchange_id']+'/level/2/parent_id/'+pid;
				that.getOptions(second, that.element.find('.second-level'),null);
			});
			if(!emptyVal){
				this.element.find('.second-level').prop('disabled', false);
				var second = this.settings['baseUrl']+
				this.settings['exchange_id']+'/level/2/parent_id/'+vals[0];
				this.getOptions(second, this.element.find('.second-level'),vals[1]);
			}
		},
		getOptions: function(url,ele,val) {
			$.getJSON(url, function(data){
				var opts = data['children'].map(function(d){
					if(!!val && val==d['value']){
						return '<option value="'+d['value']+'" selected="true">'+d['label']+'</option>';
					}
					return '<option value="'+d['value']+'">'+d['label']+'</option>';
				});
				var f = '<option value="">'+data['label']+'</option>';
				ele.html(f+opts.join(""));
			});
		}
	});

	$.fn[pluginName] = function(options) {
		this.each(function(){
			if(!$.data(this, "plugin_"+pluginName)) {
				$.data(this, "plugin_"+pluginName, new DepsDropDown(this,options));
			}
		});
		return this;
	};

}(jQuery, window, document));
