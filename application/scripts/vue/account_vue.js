var app = new Vue({
	el: '#app', //div to target
	data: {
		username: "",
		account_base_route: "",
		account_json_controller_route: "",
		account_update_isadmin_controller_route: "",
		data : {

		}
	},
	created(){
		this.username = $('#username').val();
		this.account_base_route = $('#base_url_input').val()+'/account'; //done this way to stop multiple jquery calls to find value of base_url.
		this.account_json_controller_route = this.account_base_route+'/json/'+this.username;
		this.account_update_isadmin_controller_route = this.account_base_route+'/update/isadmin/';

		this.loadPageData();
	},
	methods: {
		loadPageData : function(){
			let self = this;
			$.getJSON(this.account_json_controller_route, function(data, status){
				if(status == "success")
				{
					self.data = data;
				}
			})
		},
		updateIsAdmin : function(){
			let self = this;
			let is_admin = $('#customSwitch1').is(':checked');
			console.log(self.data);
			$.get(this.account_update_isadmin_controller_route+self.username+'/'+is_admin, function(data, status)
			{
				if(status == "success")
				{
					self.data.isAdmin = is_admin;
				}
			})
			console.log(self.data);
		}
	}
})
