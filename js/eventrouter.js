;
$(document).ready(function(){
	var __acPatten=/ac_[A-z]+/g;
	$(document.body).click(function(e) {
		var target = e.target || e.srcElement || e.originalTarget,
		actions = __getActions(target.className),
		$closestAC,
		key = 0;
		
		if (!actions.length && ($closestAC = $(target).closest('.ac')) && $closestAC.length){
			target = $closestAC[0];
			actions = __getActions(target.className);
		}
		//frist item in actions[] is not useable.we send the other ones as event name.
		while (actions[key]){
			$.publish('click_' + actions[key++], target, e);
		}
		
		$.publish('click_body', target);
	}).on("change", function(e){
		var target = e.target || e.srcElement || e.originalTarget, nodeName = String.prototype.toUpperCase.call(target.nodeName);

		if(nodeName=="INPUT"||nodeName=="TEXTAREA"||nodeName=="BUTTON"||nodeName=="SELECT"){
			var actions = __getActions(target.className), key = 0;
			while (actions[key]){
				$.publish('change_' + actions[key++], target, e, e.which, e.ctrlKey, e.shiftKey, e.altKey);
			}
		}
	});
	function __getActions(actions){
		var tmp=actions.match(__acPatten);
		if(tmp&&tmp.length)
			return tmp.join(',').replace(/ac_/g,'').split(',');
		else
			return [];
	}
});

