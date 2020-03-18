var app = new Vue({
	el: '#app', //div to target
	data: {
		//define variable
		username: "",
		account_base_route: "",
		account_json_controller_route: "",
		account_update_isadmin_controller_route: "",
		account_update_darkmode_controller_route: "",
		data : {
				//data variable is an obj (json)
		}
	},
	created(){
		//on vue initialized
		this.username = $('#username').val();
		this.account_base_route = $('#base_url_input').val()+'/account'; //done this way to stop multiple jquery calls to find value of base_url.

		this.account_json_controller_route = this.account_base_route+'/json/'+this.username;// generate account json route
		this.account_update_isadmin_controller_route = this.account_base_route+'/update/isadmin/'; //generate isadmin route
		this.account_update_darkmode_controller_route = this.account_base_route+'/update/darkmode/'; //generate isadmin route
		this.loadPageData();
	},
	methods: {
		/**
		 * gets a json of all user data and sets the vue data variable to this
		 */
		loadPageData : function(){
			let self = this;
			$.getJSON(this.account_json_controller_route, function(data, status){
				if(status == "success")
				{
					self.data = data;
				}
			})
		},
		/**
		 * updates isAdmin to true/false
		 */
		updateIsAdmin : function(){
			let self = this;
			let is_admin = $('#customSwitch1').is(':checked');
			$.get(this.account_update_isadmin_controller_route+self.username+'/'+is_admin, function(data, status)
			{
				if(status == "success")
				{
					self.data.isAdmin = is_admin;
				}
			});
		},

		/**
		 * updates dark mode to true/false
		 */
		updateDarkMode : function(){
			let self = this;
			let dark_mode = $('#customSwitch2').is(':checked');
			$.get(this.account_update_darkmode_controller_route+self.username+'/'+dark_mode, function(data, status)
			{
				if(status == "success")
				{
					self.data.darkmode = dark_mode;
					if(dark_mode == 1)
					{
						$('#main').addClass('bg-dark text-white');
					}
					else
					{
						$('#main').removeClass('bg-dark text-white')
					}
				}
			});
		}
	}
})
