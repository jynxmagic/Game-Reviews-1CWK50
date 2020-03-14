var app = new Vue({
	el: "#chat", //div to target
	data: {
		//define variables
		code: "",
		socket: "",
		reason: "",
		node_url: $('#node_host').val() //initialize this variable as the value of a hidden input in html, containing the node url
	},

	created(){
		this.checkServerStatus(); //ensure the server is online
	},

	methods: {

		checkServerStatus: function() {
			let self = this; //see review_vue.js
			$.get($('#base_url_input').val()+'/checkServerStatus', function (data, status) { //call controller

				if(data !== "true") //server returns true on http requests if is online
				{
					self.code = 500;
					self.reason = "server offline."
				}
				else
				{
					self.code = 200;
					//server is online. lets open a websocket to it. we don't want to open a websocket if the server is offline. waste of data and processing power.
					self.openConnection();

				}
			});

		},

		openConnection: function()
		{
			this.socket = io.connect(this.node_url); //connect to server

			this.socket.on('basic_message', function(data){ //normal user messages appear different to server messages
				console.log(data);
				$('#chatbox').append("<p class='row'><i>"+data.user+":</i>" +data.message+"</p>"); //tell users this was a server message
			});

			this.socket.on('server_message', function(data){ //when we have a global event defined as "server message", write it to the chatbox
				$('#chatbox').append("<p class='row'><b>"+"Server Message: "+"</b>"+data+"</p>"); //tell users this was a server message
			});
		},

		sendMessage: function()
		{
			let message = $('#message'); //get the message value from the input
			let username = $('#user_name');
			this.socket.emit('client_message_send', {user: username.val(),message: message.val()}); //send the message data with the event name to node
			message.val(""); //clear the message
		}
	}
});
