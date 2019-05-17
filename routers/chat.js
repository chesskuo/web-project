var express = require('express');
var router = express.Router();

// MySQL connect
var mysql = require('mysql');
var pool  = mysql.createPool({
	connectionLimit : 5,
	host            : '140.136.150.68',
	port            : '33066',
	user            : 'root',
	password        : '880323',
	database        : 'chess'
});

// session
var session = require('express-session')
var MySQLStore = require('express-mysql-session')(session);
var sessionStore = new MySQLStore({}, pool);

router.use(session({
	name: 'user',
	secret: 'chesskuo',
	store: sessionStore,
	resave: false,
	saveUninitialized: false,
	cookie: {maxAge: 24*60*60*1000}
}));



// route
module.exports = function(io){
	router.route('/')
		.get(function(req, res){
			if(!req.session.name)
				res.redirect('login');
			else
				res.sendfile('./public/chat.html');
		})

	io.on('connect', function(socket){
		// console.log('Connected!');

		socket.on('disconnect', function(){
			// console.log('Disconnected!');
		});
	});

	return router;
};