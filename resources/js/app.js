require('./bootstrap');
var moment = require('moment');

$(document).ready(function() {
	var interval = setInterval(function() {
		$('#realtimeWatch').html(moment().format('HH:mm:ss'));
	}, 1000);
});
