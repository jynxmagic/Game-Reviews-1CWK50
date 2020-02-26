var app = new Vue({
	el: "#chat",
	data: {
		code: "",
		socket: ""
	},

	created(){
		this.checkServerStatus();
	},

	methods: {

		checkServerStatus: function() {
			let self = this;
			$.get('/checkServerStatus', function (data, status) {
				if(data == "false")
				{
					self.code = 500;
				}
				else
				{
					self.code = 200;
					//server is online. lets open a websocket to it
					self.openConnection();

				}
			});

		},

		openConnection: function()
		{
			this.socket = io.connect('http://100.70.62.26:1111/');

			this.socket.on('server message', function(data){
				console.log("server message recieved");
				$('#chatbox').append(data+"<br>");
			});


			console.log('connected.');
		},

		sendMessage: function()
		{
			let message = $('#message');
			console.log(message.val());
			this.socket.emit('message', {message: message.val()});
			message.val("");
		}
	}
});
