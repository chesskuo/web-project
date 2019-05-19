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




let onlinecount = 0;
var nickname;

// route
module.exports = function(io){
	router.route('/')
		.get(function(req, res){
			if(!req.session.name)
				res.redirect('login');
			else
			{
				nickname = req.session.name;
				res.sendfile('./public/chat.html');
			}
		})

		// socket
		io.on('connection', (socket) => {
	
			onlinecount++;
			io.emit("online" , "Online Users :" + onlinecount);
			
		
			socket.on("greet", () => {
				socket.emit("greet","Online Users: " + onlinecount);
			});
		
			
			socket.on("send",(msg) => {
				//if(Object.keys(msg).length < 2) return;
				io.emit("nickname",nickname);
				io.emit("msg",msg);
			});
		
			socket.on('disconnect', () => {
				onlinecount = (onlinecount < 0) ? 0 : onlinecount -= 1;
				io.emit("online","Online Users: " + onlinecount);
			});
		});

	return router;
};