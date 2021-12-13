var http = require('http');
var mysql = require('mysql');

var printer = {};
var billroll = {};
var others = {};

//create a server object:
http.createServer(function (req, res) {
  
  if(req.url == '/')
  {
    con.connect(function(err) {
      if (err) throw err;
      con.query("SELECT * FROM printers", function (err, result, fields) {
        if (err) throw err;
        printer = result;
        console.log(result);
      });
    });
    res.write(JSON.stringify(printer));
    res.statusCode= 200;
        
  }
  
  res.end(); //end the response
}).listen(3000); //the server object listens on port 8080

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "total_billing_system",
});




