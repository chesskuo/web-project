var express = require('express');
var app = express();

var login = require('./routers/login.js');
var signup = require('./routers/signup.js');



// main

app.use(express.static('public'));

app.use('/login', login);
app.use('/signup', signup);

app.use(function(req, res){
	res.status(404).sendfile('public/404.html');
});



// server start
app.listen(8888, function(){
	console.log('Listen on http://localhost:8888 ...');
});