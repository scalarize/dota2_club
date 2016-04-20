/*
 * Publish Message
 * $.publish("message", data1, data2, data3, ...);
 *
 * Subscribe Message
 * $.subscribe("message", function(data1, data2, data3, ..., message){ }, fetchCache);
 *
 * When you subscribe a message, you can also get "message" with last parameter.
 * And, you can use "fetchCache" to determine whether to get messages which are
 * fired before subscribing or not. By defaut, subscribe with fetch cached messages always.
 * 
 * You can also use linked style like below to pub/sub multiple messages.
 * $.publish().subscribe.publish()
 *
 * You can do multiple messages subscribing, if you don't care about "data" parameters.
 * $.subscribe("message1 message2", function(){ });
 *
 */

;(function($) {

// cache objec for publish-subscribe sequence.
var cache = {};

$.publish = function() {
	var message = arguments[0], args = [], i = 1;

	// construct the args array, and append message as the last element.
	while( i < arguments.length ) {
		args.push(arguments[i++]);
	}
	args.push(message);

	// store message to cache
	if (!cache[message]) {
		cache[message] = [];
	}
	cache[message].push(args);

	// trigger the message event.
	$(window).trigger(message, args);

	return $;
};


$.subscribe = function() {
	var messages = $.trim(arguments[0]).replace(/\s+/," "),
		arrMsg = messages.split(" "),
		callback = arguments[1], 
		fetchCache = (typeof arguments[2] == "undefined") ? true : arguments[2];

	// fetch message from cache
	if (fetchCache) {
		for (var i = 0; i < arrMsg.length; i++) {
			var message = arrMsg[i];
			if (cache[message]) {
				for (var j = 0; j < cache[message].length; j++) {
					callback.apply(window, cache[message][j]);
				}
			}
		}
	}

	// bind the message event.
	$(window).bind(messages, function() {
		var args = [], i = 1;

		while( i < arguments.length ) {
			args.push(arguments[i++]);
		}

		callback.apply(this, args);
	});

	return $;
};
})(jQuery);
