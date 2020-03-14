const config = require('../../../../config.json'); //this can be used to load json files in node
let port = config.node_server.port; //get port from config
let url = 'localhost'; //server only runs on localhost

const server = require('http').createServer(handler); //require the http library and pass our handler as the callback function to this library. this is to handle http connections.

const io = require('socket.io')(server); //require socket.io library and pass our http server to it

server.listen(port, url);

function handler (req, res) { //http handler. basic http requests get this response
		res.writeHead(200);
		res.end("true");
}

io.httpServer.on('listening', function () { //server created event
	console.log('server started.');
	console.log('server details: ', io.httpServer.address().valueOf()); //show details of server
});

io.on('connection', function (socket) { //new connection
	console.log('new connection :p'); //this could be logged in a file, with user info

	io.emit('server_message', "new user online!"); //send this event to all broker participants


	global_chat_messages.forEach(
		function(data){
			console.log(data);
			socket.emit("basic_message", data)
		}
	);

//	socket.on();

	socket.on("client_message_send", function(data){ //when we receive this event, a user has sent us a message
		console.log(data);
		global_chat_messages.push(data);
		io.emit("basic_message",  data) //emit a new event to all clients and pass the message the user sent as data for this event
	});

});


let global_chat_messages = [];
