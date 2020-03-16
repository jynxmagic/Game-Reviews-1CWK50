/** SERVER CONFIG **/
const config = require('../../../../config.json'); //this can be used to load json files in node, rather than loading a json library to parse a file
let node_port = config.node_server.port; //get port from config
let url = 'localhost'; //server only runs on localhost

const server = require('http').createServer(handler); //require the http library and pass our handler as the callback function to this library. this is to handle http connections.
const io = require('socket.io')(server); //require socket.io library and pass our http server to it

server.listen(node_port, url);

//we will use MySQL to determine if a user is an administrator. This way the account information will be taken from that which is updated in CodeIgniter (node and mysql ).
mysql_driver = require('mysql');

mysql_connection = mysql_driver.createConnection({
	host: config.mysql.host,
	user: config.mysql.username,
	password: config.mysql.password,
	database: config.mysql.database
});

/** SERVER CONFIG END **/

mysql_connection.connect();

function handler (req, res) { //http handler. basic http requests get this response
		res.writeHead(200);
		res.end("true"); // we send true to http requests to show that the server is online
}

io.httpServer.on('listening', function () { //server created event
	console.log('server started.');
	console.log('server details: ', io.httpServer.address().valueOf()); //show details of server
});

io.on('connection', function (socket) { //new connection

	io.emit('server_message', "new user online!"); //send this event to all broker participants


	//when a new user connects, send them all messages we have
	global_chat_messages.forEach(
		function(data){
			socket.emit("basic_message", data) //socket.emit ensures we only send this data to the newly connected user, not all users
		}
	);

	socket.on("client_message_send", function(data){ //when we receive this event, a user has sent us a message

		//to determine whether our user is an admin https://github.com/mysqljs/mysql#introduction

		mysql_connection.query("SELECT isAdmin FROM Users WHERE USERNAME = '"+escape(data.user)+"';", function(error, results, fields){ //ensure username is escaped in query
			//callback function for connection complete
			if(error) throw error;

			data.is_admin = results[0].isAdmin; //there should only be 1 result as username is a unique value

			global_chat_messages.push(data); //store all sent messages here

			io.emit("basic_message",  data) //emit a new event to all clients and pass the message the user sent as data for this event
		});


		console.log(global_chat_messages);

	});

});


let global_chat_messages = []; //assoc array to hold chat messages
