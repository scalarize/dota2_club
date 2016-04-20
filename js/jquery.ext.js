$.domob = $.domob || {};

$.domob.checkAndExtendDomobWidgets = function() {
	if ($.domob.extended) return true;
	if ($.ui && $.ui.autocomplete) {
		$.widget('ui.autocomplete', $.ui.autocomplete, {
			'_renderItem' : function(ul, item) {
				var li = this._super(ul, item);
				if (this.options.htmlLabel) {
					var a = $(li.find('a')[0]);
					a.html(a.text());
				}
				return li;
			}
		});
	}
	$.domob.extended = true;
	return true;
};

$(document).ready(function(e) {
	$.domob.checkAndExtendDomobWidgets();
});

