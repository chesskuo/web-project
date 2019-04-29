var express = require('express');
var router = express.Router();

// POST object 
var bodyParser = require('body-parser');
router.use(bodyParser.json());
router.use(bodyParser.urlencoded({extended: true}));

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

// routing
router.route('/')
	.get(function(req, res){
		res.sendfile('./public/signup.html');
	})
	.post(function(req, res){
		if(req.body.username && req.body.password && req.body.name && req.body.email)
		{
			var data = {
				username: req.body.username,
				password: req.body.password,
				name: req.body.name,
				email: req.body.email
			}

			pool.query('INSERT INTO `user` SET ?', data, function (error, results, fields) {
				res.send(results);
			});
		}
		else
			res.redirect('back');
	});

module.exports = router;