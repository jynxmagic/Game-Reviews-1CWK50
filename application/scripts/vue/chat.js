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

		/**
		 * Calls codeigniter to check if node server is online. opens the connection to node if so
		 */
		checkServerStatus: function() {
			let self = this; //see review_vue.js
			$.get($('#base_url_input').val()+'/checkServerStatus', function (data, status) { //GET request to controller route

				if(data !== "true") //node returns true on http requests if is online
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


		/**
		 * uses socket.io library to open a socket connection to node.
		 */
		openConnection: function()
		{
			this.socket = io.connect(this.node_url); //connect to server

			this.socket.on('basic_message', function(data){ //normal user messages appear different to server messages
				if(data.room == $('#selected_room').find(':selected').val()) //initial chat messages are from all rooms, add this to only append the messages of the room we are in
				{
					if (data.is_admin == 0 || data.is_admin == false)  //tell users this was a non-admin message
					{
						$('#chatbox').append("<p class='row'><i>" + data.user + ":</i>" + data.message + "</p>"); //jquery to append
					} else {
						//admin messages
						$('#chatbox').append("<p class='row'><b>" + data.user + ":</b>" + data.message + "</p>"); //admin users appear bold, along with server messages
					}
				}
			});

			this.socket.on('server_message', function(data){ //when we have a global event defined as "server message", write it to the chatbox
				$('#chatbox').append("<p class='row'><b>"+"Server Message: "+"</b>"+data+"</p>"); //tell users this was a server message
			});
		},

		/**
		 * Sends a chat message to node
		 */
		sendMessage: function()
		{
			let message = $('#message'); //get the message value from the input
			let username = $('#user_name');
			let room = $('#selected_room').find(':selected').val();
			this.socket.emit('client_message_send', {user: username.val(),message: message.val(), room: room}); //send the message data with the event name to node
			message.val(""); //clear the message
		},

		/**
		 * emits "change_room" event to node
		 */
		changeRoom: function()
		{
			let room = $('#selected_room').find(':selected').val();
			$('#chatbox').empty();
			this.socket.emit('change_room', {room: room})
		}
	}
});
