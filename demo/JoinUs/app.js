var express = require('express');
var mysql = require('mysql');
var bodyParser = require("body-parser");
var app = express();

app.set("view engine", "ejs");
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static(__dirname + "/public"));

var connection = mysql.createConnection({
    // 填写数据库连接信息
    host: '',
    user: '',
    password: '',
    database: ''
});

app.get("/", function (req, res) {
    var q = "SELECT COUNT(*) AS count FROM users";
    connection.query(q, function (err, results) {
        if (err) throw err;
        var count = results[0].count;
        res.render("home", { count: count, warning: null });
    });
});

app.post("/register", function (req, res) {
    connection.query('SELECT email FROM users WHERE email = ?', req.body.email, function (err, results) {
        if (err) throw err;
        if (results.length === 0) {
            var person = {
                email: req.body.email
            };
            connection.query('INSERT INTO users SET ?', person, function (err, result) {
                if (err) throw err;
                res.redirect("/");
            });
        } else {
            var q = "SELECT COUNT(*) AS count FROM users";
            connection.query(q, function (err, results) {
                if (err) throw err;
                var count = results[0].count;
                res.render("home", { count: count, warning: "Email already registered" });
            });
        }
    });
});

app.listen(8080, function () {
    console.log("Server running on 8080!");
});