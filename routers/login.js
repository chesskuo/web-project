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
		res.sendfile('./public/login.html');
	})
	.post(function(req, res){
		if(req.body.account && req.body.password)
		{
			var query = "SELECT * FROM `user` WHERE username='" + req.body.account + "' AND password='" + req.body.password + "'";

			pool.query(query, function (error, results, fields) {
				if(results[0])
					res.send(results[0]);
				else
					res.redirect('back');
			});
		}
		else
			res.redirect('back');
	});

module.exports = router;
