const config = require('../../../../config');
let port = config.node_server.port;
let url = config.node_server.ip;

const server = require('http').createServer(handler);

const io = require('socket.io')(server);

server.listen(port, url);

function handler (req, res) {
		res.writeHead(200);
		res.end("true");
}

io.httpServer.on('listening', function () {
	console.log('server started.');
	console.log('server details: ', io.httpServer.address().valueOf());
});

io.on('connection', function (socket) {
	console.log('new connection :p');

	io.emit('server message', "new user online!");

//	socket.on();

	socket.on("message", function(data){
		io.emit("server message",  data.message)
	});

});
