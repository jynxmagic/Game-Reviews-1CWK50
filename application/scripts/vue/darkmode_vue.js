var app = new Vue({
	el: '#main',
	username: "",
	created()
	{
		this.username = $('#user_name').val();
		if(this.username != "")
		{
			this.setDarkMode();
		}
	},
	methods: {
		setDarkMode : function()
		{
			$.getJSON($('#base_url_input').val()+'/account/json/'+this.username, function(data, status){
				this.DarkMode = data.DarkMode;
				if(this.DarkMode == 1)
				{
					$('#main').addClass('bg-dark text-white');
				}
				else
				{
					$('#main').removeClass('bg-dark text-white');
				}
			});
		}
	}

});
