////PLEASE CHANGE BASE URL AND PORT AS REQUIRED. UR IPV4 ADDRESS ///////////
let port = 1111;
let url = '100.70.61.182';


const server = require('http').createServer(handler);

const io = require('socket.io')(server);

server.listen(port, url);

function handler (req, res) {
		res.writeHead(200);
		res.end("Server online.");
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
