;
$(function() {
	var __acPatten=/ac_[A-z]+/g;
	$(document.body).click(function(e) {
		//permission denied to access property 'className' from a non-chrome context(ff3.5 bug). so we try.
		try {
			var target = e.target || e.srcElement || e.originalTarget,
			actions = __getActions(target.className),
			key = 0;
			
			if (!actions.length){
				// http://jsperf.com/match-a-tag-name
				if('_abuttonABUTTON'.indexOf(target.parentNode.nodeName)>0) {
					target = target.parentNode;
					actions = __getActions(target.className);
				}else if ($(target.parentNode).closest('.ac').length) {
					target = $(target.parentNode).closest('.ac')[0];
					actions = __getActions(target.className);
				}
			}
			
			//frist item in actions[] is not useable.we send the other ones as event name.
			while (actions[key]){
				$.publish('click_' + actions[key++], target, e);
			}
			
			$.publish('click_body', target);
		} catch(e) {
			return false;
		}
	});
	function __getActions(actions){
		var tmp=actions.match(__acPatten);
		if(tmp&&tmp.length)
			return tmp.join(',').replace('ac_','').split(',');
		else
			return [];
	}
});

