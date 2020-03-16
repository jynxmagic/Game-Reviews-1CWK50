var app = new Vue({
	el: '#app', //div to target
	data: {
		username: "",
		is_admin: "",
		account_controller_route: "",
		data : {

		}
	},
	created(){
		this.username = $('#username').val();
		this.account_controller_route = $('#base_url_input').val()+'/account/json/'+this.username;
		this.loadPageData();
	},
	methods: {
		loadPageData : function(){
			let self = this;
			$.getJSON(this.account_controller_route, function(data, status){
				if(status == "success")
				{
					self.data = data;
					self.is_admin = data.isAdmin;
				}
			})
		}
	}
})
