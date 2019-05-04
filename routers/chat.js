var express = require('express');
var router = express.Router();


module.exports = function(io){
	router.route('/')
		.get(function(req, res){
			res.sendfile('./public/chat.html');
		})

	io.on('connect', function(socket){
		console.log('Connected!');

		socket.on('disconnect', function(){
			console.log('Disconnected!');
		});
	});

	return router;
};